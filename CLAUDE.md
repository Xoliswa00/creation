# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

**First-time setup:**
```bash
composer setup
```
This installs PHP and JS dependencies, copies `.env`, generates an app key, runs migrations, and builds assets.

**Run the full dev stack (server + queue + logs + Vite HMR):**
```bash
composer dev
```

**Run tests:**
```bash
composer test
# or a single test:
php artisan test --filter TestClassName
```

**Lint PHP (Laravel Pint):**
```bash
./vendor/bin/pint
```

**Build frontend assets:**
```bash
npm run build   # production
npm run dev     # Vite watch (also started by composer dev)
```

## Architecture

### Dual frontend

There are **two separate frontend stacks** that should not be confused:

| Stack | Entry point | Purpose |
|---|---|---|
| Laravel Blade + Livewire | `resources/views/` | Main app UI served by Laravel |
| React + shadcn/ui + Vite | `src/`, `index.html`, `vite.config.ts` | Standalone SPA (currently coexists, separate build) |

The Laravel app uses `vite.config.js` (laravel-vite-plugin, inputs `resources/css/app.css` and `resources/js/app.js`). The React SPA uses `vite.config.ts` (React plugin, alias `@` → `src/`). Both share the same repo but are independent build targets.

All shadcn/ui components live in `src/components/ui/`. Import them as `import { Button } from '@/components/ui/button'`.

### Multi-tenancy via global scope

Every model that holds company-owned data **must** extend `TenantModel` ([app/Models/TentantModel.php](app/Models/TentantModel.php)) instead of `Model`. `TenantModel` boots `CompanyScope` as a global Eloquent scope, which automatically appends `WHERE company_id = ?` to all queries based on the authenticated user's `company_id`.

- `platform_owner` role bypasses the scope and sees all companies' data.
- Users with no `company_id` receive no results (`WHERE 1 = 0`).

The `EnsureCompanyContext` middleware ([app/Http/Middleware/EnsureCompanyContext.php](app/Http/Middleware/EnsureCompanyContext.php)) can be applied to routes that require an active company context.

### User roles and company membership

Users belong to companies through the `company_users` pivot table (many-to-many). The active company is tracked on `users.current_company_id`. Roles are resolved from the pivot:

- `platform_owner` — sees all data across all companies; owns managed companies via `users.platform_owner_id`
- `system_admin` — system-level admin
- `admin` — company-level admin
- `client_user` — restricted portal access

Role check helpers on `User`: `isPlatformOwner()`, `isAdmin()`, `isSystemAdmin()`, `isClientUser()`.

`auth()->user()->managedCompanies->first()` is the pattern used throughout controllers to get the current platform owner's company. This is an area of active development — `current_company_id` vs `managedCompanies` usage is inconsistent.

### Quote builder

Quotes (`app/Http/Controllers/QuoteController.php`) accept a JSON `payload` field in the `store` request containing:
```json
{
  "products": [{ "product_id": 1, "base_price": 100, "items": [...] }],
  "custom": [{ "name": "Consulting", "quantity": 2, "unit_price": 500 }]
}
```
Each product can include child `product_items` — optional line items toggled by the user. VAT is hardcoded at **15%**. Items are bulk-inserted via `quote_items::insert()` then totals are calculated and patched onto the quote.

### Product pricing model

Products (`app/Models/product.php`) have a `product_price` relation supporting `pricing_type` values: `fixed`, `per_item`, `hourly`, `range`, `custom`. The first price record drives the quote builder UI.

### Client portal

Clients can be invited via a signed URL (`/client-portal/accept/{token}`). The invite is sent through `App\Mail\ClientPortalInvite`. Client portal routes are handled by `ClientPortalController`.

### Auth stack

Authentication uses **Laravel Jetstream** (UI scaffolding) + **Fortify** (auth backend) + **Sanctum** (API tokens). Two-factor auth is supported via `TwoFactorAuthenticatable`. The Jetstream team/organization features are repurposed — "teams" map to "companies" in this app's domain.

## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).
