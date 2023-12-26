@extends('Admin.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </span>All Bookings
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-10 offset-1 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Bookings</h4>
                    @if (count($bookings) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Location</th>
                                    <th>Star Date</th>
                                    <th>End Date</th>
                                    <th>Seat Numbers</th>
                                    <th>Prie Per Seat</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->id }}</td>
                                        <td>{{ $booking->trip->fromLocation->name }} To
                                            {{ $booking->trip->toLocation->name }}</td>
                                        <td>
                                            <span class="d-block text-left">
                                                {{ date('h:i A', strtotime($booking->trip->departure_date)) }} <br>
                                                {{ date('d, M Y', strtotime($booking->trip->departure_date)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-block text-left">
                                                {{ date('h:i A', strtotime($booking->trip->return_date)) }} <br>
                                                {{ date('d, M Y', strtotime($booking->trip->return_date)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @foreach ($booking->seats as $seat)
                                                {{ $seat->seat_number }},
                                            @endforeach
                                        </td>
                                        <td>
                                            <strong>${{ $booking->trip->price_per_seat }}</strong>
                                        </td>
                                        <td>
                                            <strong>${{ $booking->total }}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="text-center mt-4">No Bookings Found</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
