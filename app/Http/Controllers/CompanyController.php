<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){
        $company = $request->user()->company;

        if (!$company) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'city' => 'required|string|max:100',
            'website' => 'nullable|string|max:255',
            'contact_email' => 'required|email',
        ]);

        $company->update($validated);

        return redirect('/konto')
            ->with('success', 'Firmendaten wurden aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }


    public function createCompany(Request $request)
    {
        if ($request->user()->company()->exists()) {
            return redirect('/konto')
                ->with('error', 'Du hast bereits eine Firma registriert.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'city' => 'required|string|max:100',
            'website' => 'nullable|string|max:255',
            'contact_email' => 'required|email',
        ]);

        $request->user()->company()->create($validated);

        return redirect('/konto');
    }
}
