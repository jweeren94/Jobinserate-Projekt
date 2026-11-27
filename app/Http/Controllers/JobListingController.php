<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Http\Requests\StoreJobListingRequest;
use App\Http\Requests\UpdateJobListingRequest;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request){
        $jobListings = JobListing::with('company')
            ->where('is_published', true)
            ->whereDate('expires_at', '>=', today())
            ->when($request->filled('location'), function ($query) use ($request) {
                $query->where('location', 'like', '%' . $request->location . '%');
            })
            ->when($request->filled('employment_type'), function ($query) use ($request) {
                $query->where('employment_type', $request->employment_type);
            })
            ->latest()
            ->get();

        return view('welcome', compact('jobListings'));
    }


    public function indexMyJoblistings(Request $request){
        $company = $request->user()->company;

        if (!$company) {
            abort(403);
        }

        $jobListings = $company->jobListings;

        return view('myJoblistings', compact('jobListings'));
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
    public function createJobListing(Request $request)
    {
        $company = $request->user()->company;

        if (!$company) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:Fulltime,Parttime',
            'expires_at' => 'required|date|after:today',
        ]);

        $company->jobListings()->create([
            ...$validated,
            'is_published' => false,
        ]);

        return redirect('/myJoblistings');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $jobListing){
        if (!$jobListing->is_published || $jobListing->expires_at < today()) {
            abort(404);
        }

        $jobListing->load('company');

        return view('jobListingDetails', compact('jobListing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $jobListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $jobListing){
        // Prüfen, ob die Stellenanzeige dem eingeloggten Unternehmen gehört
        if ($request->user()->company->id !== $jobListing->company_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|in:Fulltime,Parttime',
            'expires_at' => 'required|date|after:today',
        ]);

        $jobListing->update($validated);

        return redirect('/myJoblistings');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $jobListing)
    {
        //
    }

    public function togglePublish(Request $request, JobListing $jobListing)
    {
        $company = $request->user()->company;

        if (!$company) {
            abort(403);
        }

        $jobListing = $company->jobListings()->findOrFail($jobListing->id);

        $jobListing->is_published = !$jobListing->is_published;
        $jobListing->save();

        return redirect('/myJoblistings');
    }
}
