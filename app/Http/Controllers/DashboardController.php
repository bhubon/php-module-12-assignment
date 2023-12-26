<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        if (auth()->user()->role == 'admin') {
            $data['total_trips'] = Trip::count();
            $data['total_booking'] = Booking::count();
            $data['total_sales'] = Booking::sum('total');
        } else {
            $data['total_booking'] = Booking::where('user_id', auth()->user()->id)->count();
            $data['total_purchase'] = Booking::where('user_id', auth()->user()->id)->sum('total');
        }
        return view('Admin.Dashboard.index', ['data' => $data]);
    }
}
