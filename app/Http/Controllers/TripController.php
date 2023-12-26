<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with(['fromLocation', 'toLocation'])->orderBy('created_at', 'DESC')->paginate(5);
        $locations = Location::orderBy('name', 'ASC')->get();
        return view('Admin.Trip.index', ['trips' => $trips, 'locations' => $locations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_location' => 'required|numeric',
            'end_location' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price_per_seat' => 'required',
        ]);

        $trip = Trip::create([
            'from_location_id' => $request->start_location,
            'to_location_id' => $request->end_location,
            'departure_date' => $request->start_date,
            'return_date' => $request->end_date,
            'price_per_seat' => $request->price_per_seat,
        ]);
        if ($trip) {
            return redirect()->back()->with('success', 'Trip successfully created');
        } else {
            return redirect()->back()->with('error', 'Something wen\'t wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $trip = Trip::with(['fromLocation', 'toLocation'])->findOrFail($id);
        $locations = Location::orderBy('name', 'ASC')->get();
        return view('Admin.Trip.Edit', ['trip' => $trip, 'locations' => $locations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'start_location' => 'required|numeric',
            'end_location' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price_per_seat' => 'required',
        ]);

        $updated = $trip->update([
            'from_location_id' => $request->start_location,
            'to_location_id' => $request->end_location,
            'departure_date' => $request->start_date,
            'return_date' => $request->end_date,
            'price_per_seat' => $request->price_per_seat,
        ]);
        if ($updated) {
            return redirect()->route('trip.index')->with('success', 'Trip successfully updated');
        } else {
            return redirect()->back()->with('error', 'Something wen\'t wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $deleted = $trip->delete();
        if ($deleted) {
            return redirect()->route('trip.index')->with('success', 'Trip successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Something wen\'t wrong!');
        }
    }
}
