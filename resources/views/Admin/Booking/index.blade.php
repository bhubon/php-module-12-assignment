@extends('Admin.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </span>Book a trip
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">Book a trip</p>
                    <form method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_location">Start Location</label>
                                    <select name="start_location" id="start_location" class="form-control text-dark p-3">
                                        <option default>Select Location</option>
                                        @foreach ($locations as $location)
                                            <option @if (request()->start_location == $location->id) selected @endif
                                                value="{{ $location->id }}">
                                                {{ $location->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="destination">Destination</label>
                                    <select name="destination" id="destination" class="form-control text-dark p-3">
                                        <option default>Select Location</option>
                                        @foreach ($locations as $location)
                                            <option @if (request()->destination == $location->id) selected @endif
                                                value="{{ $location->id }}">
                                                {{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="from_date">Trip Date Range</label>
                                    <input type="datetime-local" class="form-control" id="from_date" name="from_date"
                                        placeholder="Start Date" value="{{ request('from_date') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="to_date">To</label>
                                    <input type="datetime-local" class="form-control" id="to_date" name="to_date"
                                        placeholder="Start Date" value="{{ request('to_date') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary mt-4" value="Search">
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="trips-list">
                        @if (count($trips) > 0)
                            <h4 class="card-title mt-4">Availabel Trips</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th>Trip Start</th>
                                        <th>Trip Will End</th>
                                        <th>Price Per Seat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trips as $trip)
                                        <tr>
                                            <td>{{ $trip->fromLocation->name }} To {{ $trip->toLocation->name }}</td>
                                            <td>
                                                <span class="d-block text-left">
                                                    {{ date('h:i A', strtotime($trip->departure_date)) }} <br>
                                                    {{ date('d, M Y', strtotime($trip->departure_date)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="d-block text-left">
                                                    {{ date('h:i A', strtotime($trip->return_date)) }} <br>
                                                    {{ date('d, M Y', strtotime($trip->return_date)) }}
                                                </span>
                                            </td>
                                            <td>${{ $trip->price_per_seat }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('trip.details', $trip->id) }}"
                                                        class="btn btn-success btn-xs mr-4">Book</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                            </div>
                        @elseif(isset(request()->start_location))
                            <h4 class="text-center mt-4">No Trip Found</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
