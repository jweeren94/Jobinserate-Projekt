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
    public function indexMyJoblistings(Request $request)
    {
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
    public function show(JobListing $jobListing)
    {
        //
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
    public function update(UpdateJobListingRequest $request, JobListing $jobListing)
    {
        //
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
