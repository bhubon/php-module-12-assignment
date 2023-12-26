<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::orderBy('id', 'DESC')->paginate(5);
        return view('Admin.Location.index', ['locations' => $locations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3'
        ]);

        $location = Location::create($validated);

        if ($location) {
            return redirect()->back()->with('success', 'Location Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Wen\'t wrong');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('Admin.Location.edit', ['location' => $location]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3'
        ]);

        $updated = $location->update($validated);

        if ($updated) {
            return redirect()->route('location.index')->with('success', 'Location Successfully Updated');
        } else {
            return redirect()->back()->with('error', 'Something Wen\'t wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $deleted = $location->delete();
        if ($deleted) {
            return redirect()->route('location.index')->with('success', 'Location Successfully Deleted');
        } else {
            return redirect()->back()->with('error', 'Something Wen\'t wrong');
        }
    }
}
