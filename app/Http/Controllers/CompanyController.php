<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Http\Requests\StorecompanyRequest;
use App\Http\Requests\UpdatecompanyRequest;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
   public function index()
    {
        return response()->json(auth()->user()->companies);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company = Company::create($validated);

        // Attach creator as owner
        $company->users()->attach(auth()->id(), [
            'role' => 'owner'
        ]);

        // Set as current company
        if (auth()->user()) {
            auth()->user()->update([
                'current_company_id' => $company->id
            ]);
       
        }

        return response()->json($company, 201);
    }

    public function show(Company $company)
    {
        $this->authorize('view', $company);
        return response()->json($company);
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company->update($validated);

        return response()->json($company);
    }

    public function switch(Company $company)
    {
        $this->authorize('view', $company);

        auth()->user()->update([
            'current_company_id' => $company->id
        ]);

        return response()->json([
            'message' => 'Company switched successfully'
        ]);
    }
}
