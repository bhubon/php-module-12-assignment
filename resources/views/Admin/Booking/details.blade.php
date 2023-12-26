@extends('Admin.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </span>Trip Details
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
        <div class="col-lg-8 offset-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Trip Details</h4>
                    @if ($trip)
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Trip Id</td>
                                    <td>#{{ $trip->id }}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{ $trip->fromLocation->name }} To {{ $trip->toLocation->name }}</td>
                                </tr>
                                <tr>
                                    <td>Start Time</td>
                                    <td>
                                        <span class="d-block text-left">
                                            {{ date('h:i A', strtotime($trip->departure_date)) }} <br>
                                            {{ date('d, M Y', strtotime($trip->departure_date)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Edit Time</td>
                                    <td>
                                        <span class="d-block text-left">
                                            {{ date('h:i A', strtotime($trip->return_date)) }} <br>
                                            {{ date('d, M Y', strtotime($trip->return_date)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Price Per Seat</td>
                                    <td>
                                        <strong>${{ $trip->price_per_seat }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <div class="seat-plan mt-4">
                                <h6>Seat Plan</h6>
                                <hr>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show pb-0" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                                            @for ($seatNumber = 1; $seatNumber <= 36; $seatNumber++)
                                                <div style="margin: 5px 5px 0  5px; width: 90px;">
                                                    <input type="checkbox"
                                                        @if (in_array($seatNumber, $booked_seats)) checked disabled @endif
                                                        name="seats[]" value="{{ $seatNumber }}"
                                                        id="seat{{ $seatNumber }}">
                                                    <label for="seat{{ $seatNumber }}">Seat {{ $seatNumber }}</label>
                                                </div>

                                                @if ($seatNumber % 4 == 0)
                                        </div>
                                        <div
                                            style="display: flex; justify-content: space-between; flex-wrap: wrap; margin-top: 10px;">
                    @endif
                    @endfor
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                    <button class="btn btn-primary mt-4">Book Now</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@else
    <h4 class="text-center mt-4">No Trip Found</h4>
    @endif
    </div>
    </div>
    </div>
    </div>
@endsection
