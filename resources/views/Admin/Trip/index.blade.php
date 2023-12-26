@extends('Admin.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </span>Trips
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
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Trips</h4>
                    @if (count($trips) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Location</th>
                                    <th>Trip Start</th>
                                    <th>Trip End</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trips as $trip)
                                    <tr>
                                        <td>#{{ $trip->id }}</td>
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
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('trip.edit', $trip->id) }}"
                                                    class="btn btn-warning btn-xs mr-4">Edit</a> &nbsp; &nbsp;
                                                <form action="{{ route('trip.destroy', $trip->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure to delete?')"
                                                        class="btn btn-danger btn-xs ml-4">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $trips->links() }}
                        </div>
                    @else
                        <h4 class="text-center mt-4">No Trip Found</h4>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">Add Trip</p>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show pb-0" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="forms-sample" method="POST" action="{{ route('trip.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="start_location">Start Location</label>
                            <select name="start_location" id="start_location" class="form-control">
                                <option default>Select Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="end_location">Start Location</label>
                            <select name="end_location" id="end_location" class="form-control">
                                <option default>Select Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date & Time</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                placeholder="Start Date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date & Time</label>
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                placeholder="End Date">
                        </div>
                        <div class="form-group">
                            <label for="price_per_seat">Price Per Seat</label>
                            <input type="number" class="form-control" id="price_per_seat" name="price_per_seat"
                                placeholder="Price per seat">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
