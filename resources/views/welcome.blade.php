<x-guest-layout>

@php
    $appName = "Xquisite Creations";
@endphp


{{-- =========================
   HERO SECTION
========================= --}}
<section class="bg-[#0B1C2D] text-white">
    <div class="max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-16 items-center">

        <div>
            <h1 class="text-5xl md:text-6xl font-semibold leading-tight tracking-tight mb-6">
                Business Software.<br>
                Built & Operated by {{ $appName }}.
            </h1>

            <p class="text-gray-300 text-lg leading-relaxed mb-10">
                We design, deploy, and manage intelligent SaaS platforms 
                that power modern businesses — from operational systems 
                to automation-driven enterprise tools.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/platforms') }}"
                   class="px-8 py-4 bg-white text-[#0B1C2D] rounded-full font-medium hover:opacity-90 transition">
                    Explore Platforms
                </a>

                <a href="#consultation"
                   class="px-8 py-4 border border-gray-500 rounded-full hover:bg-white hover:text-[#0B1C2D] transition">
                    Book Consultation
                </a>
            </div>

            <p class="mt-6 text-sm text-gray-400">
                Founded by Xoliswa Masuku
            </p>
        </div>

        {{-- Optional image placeholder --}}
        <div class="hidden md:block">
            <div class="bg-white/5 border border-white/10 rounded-3xl p-16 text-center">
                <p class="text-gray-400">
                    Replace with system dashboard preview or brand visual
                </p>
            </div>
        </div>

    </div>
</section>



{{-- =========================
   WHAT WE BUILD
========================= --}}
<section class="bg-white text-gray-900">
    <div class="max-w-7xl mx-auto px-6 py-28">

        <div class="max-w-3xl mb-20">
            <h2 class="text-4xl font-semibold mb-6 tracking-tight">
                What We Deliver
            </h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                Structured digital systems designed to improve efficiency,
                increase visibility, and support long-term business growth.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-16">

            <div>
                <h3 class="text-xl font-semibold mb-4">
                    Digital Infrastructure
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    Enterprise-grade websites, e-commerce platforms,
                    and secure web applications built for scalability.
                </p>
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-4">
                    Operational Systems
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    ERP solutions, loan management systems,
                    inventory platforms, and custom-built software.
                </p>
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-4">
                    Intelligence & Automation
                </h3>
                <p class="text-gray-600 leading-relaxed">
                    Real-time dashboards, performance reporting,
                    AI-powered workflows, and business automation tools.
                </p>
            </div>

        </div>
    </div>
</section>



{{-- =========================
   OUR SAAS PLATFORMS
========================= --}}
<section class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 py-28">

        <div class="max-w-3xl mb-20">
            <h2 class="text-4xl font-semibold mb-6 tracking-tight">
                Our SaaS Platforms
            </h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                Hosted and managed under the Xquisite Creations ecosystem.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-10">

            {{-- Example Platform Card --}}
            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="text-xl font-semibold mb-4">
                    Property Management Platform
                </h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Multi-tenant system for managing properties,
                    tenants, revenue, and operational reporting.
                </p>
                <a href="#"
                   class="text-[#0B1C2D] font-medium border-b border-[#0B1C2D] pb-1 hover:opacity-70 transition">
                    Access Platform
                </a>
            </div>

            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="text-xl font-semibold mb-4">
                    Business Automation Suite
                </h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Custom ERP, inventory, and workflow automation
                    tools designed for structured growth.
                </p>
                <a href="#"
                   class="text-[#0B1C2D] font-medium border-b border-[#0B1C2D] pb-1 hover:opacity-70 transition">
                    Access Platform
                </a>
            </div>

            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100 hover:shadow-md transition">
                <h3 class="text-xl font-semibold mb-4">
                    Analytics & Reporting
                </h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Executive dashboards and AI-driven reporting
                    built for data-backed decision making.
                </p>
                <a href="#"
                   class="text-[#0B1C2D] font-medium border-b border-[#0B1C2D] pb-1 hover:opacity-70 transition">
                    Access Platform
                </a>
            </div>

        </div>
    </div>
</section>



{{-- =========================
   FOUNDER SECTION
========================= --}}
<section class="bg-white">
    <div class="max-w-6xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-16 items-center">

        <div>
            <h2 class="text-3xl font-semibold mb-6 tracking-tight">
                Leadership
            </h2>

            <h3 class="text-2xl font-medium mb-4">
                Xoliswa Masuku
            </h3>

            <p class="text-gray-600 leading-relaxed">
                Founder and systems architect behind Xquisite Creations.
                Focused on engineering scalable business platforms that
                simplify complex operations and improve financial visibility.
            </p>
        </div>

        <div class="bg-gray-100 rounded-3xl p-16 text-center">
            <p class="text-gray-400">
                Replace with professional founder portrait
            </p>
        </div>

    </div>
</section>



{{-- =========================
   CONSULTATION CTA
========================= --}}
<section id="consultation" class="bg-[#0B1C2D] text-white">
    <div class="max-w-4xl mx-auto px-6 py-28 text-center">

        <h2 class="text-4xl font-semibold mb-8 tracking-tight">
            Ready to Implement Smarter Systems?
        </h2>

        <p class="text-gray-300 mb-12 text-lg">
            Schedule a consultation and explore how our platforms
            can support your business operations.
        </p>

        <div class="space-y-4">
            <p class="text-xl font-medium">
                067 401 7419
            </p>
            <p class="text-gray-400">
                bester12@outlook.com
            </p>
        </div>

    </div>
</section>


{{-- =========================
   FOOTER
========================= --}}
<footer class="bg-black text-gray-400 text-sm">
    <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row justify-between">
        <p>
            © {{ date('Y') }} Xquisite Creations. All rights reserved.
        </p>
        <p>
            Hosted & Managed by Xquisite Creations
        </p>
    </div>
</footer>


</x-guest-layout>