<?php

namespace App\Http\Controllers;

use App\Models\SeatAllocation;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locations = Location::orderBy('name', 'ASC')->get();

        $filteredTrips = [];

        $startLocation = $request->input('start_location');
        $destination = $request->input('destination');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Perform the search using Eloquent
        if ($request->method() == 'GET' && ($request->filled('start_location'))) {
            $trips = Trip::query();

            if ($request->input('start_location')) {
                $startLocation = $request->input('start_location');
                $trips->where('from_location_id', $startLocation);
            }

            if ($request->input('destination')) {
                $destination = $request->input('destination');
                $trips->where('to_location_id', $destination);
            }

            if ($request->input('from_date')) {
                $fromDate = Carbon::parse($request->input('from_date'))->format('Y-m-d');
                $trips->whereDate('departure_date', '>=', $fromDate);
            }

            if ($request->input('to_date')) {
                $toDate = Carbon::parse($request->input('to_date'))->format('Y-m-d');
                ;
                $trips->whereDate('return_date', '<=', $toDate);
            }

            $filteredTrips = $trips->get();
        }

        return view('Admin.Booking.index', ['locations' => $locations, 'trips' => $filteredTrips]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'seats' => 'required|array',
            'trip_id' => 'required',
        ]);

        $trip = Trip::findOrFail($request->trip_id);

        $total_seat = count($request->seats);

        $booking = Booking::create([
            'user_id' => Auth::user()->id,
            'trip_id' => $request->trip_id,
            'total' => $trip->price_per_seat * $total_seat,
        ]);

        foreach ($request->seats as $seatNumber) {
            $seat = new SeatAllocation(['seat_number' => $seatNumber, 'booking_id' => $booking->id, 'user_id' => Auth::user()->id]); // Assuming 'number' is the seat column in Seat model
            $booking->seats()->save($seat);
        }

        if ($booking) {
            return redirect()->route('allBookings')->with('success', 'Successfully Booked');
        } else {
            return redirect()->back()->with('error', 'Something wen\'t wrong!');
        }

    }


    public function trip_details(string $id)
    {
        $trip = Trip::with(['fromLocation', 'toLocation', 'bookings.seats'])->findOrFail($id);
        $locations = Location::orderBy('name', 'ASC')->get();

        $booked_seats = [];

        foreach ($trip->bookings as $_booking) {
            foreach ($_booking->seats as $seat) {
                array_push($booked_seats, $seat->seat_number);
            }
        }

        return view('Admin.Booking.details', ['trip' => $trip, 'locations' => $locations, 'booked_seats' => $booked_seats]);
    }

    public function allBookings()
    {
        $bookings = Booking::with(['trip', 'seats'])->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('Admin.Booking.allBookings', ['bookings' => $bookings]);
    }
}
