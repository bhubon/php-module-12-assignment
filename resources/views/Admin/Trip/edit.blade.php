@extends('Admin.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </span>Edit Trip
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
        <div class="col-md-8 offset-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">Edit Trip</p>
                    <form class="forms-sample" method="POST" action="{{ route('trip.update', $trip->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="start_location">Start Location</label>
                            <select name="start_location" id="start_location" class="form-control text-dark">
                                <option default>Select Location</option>
                                @foreach ($locations as $location)
                                    <option @if ($trip->from_location_id == $location->id) selected @endif value="{{ $location->id }}">
                                        {{ $location->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="end_location">Start Location</label>
                            <select name="end_location" id="end_location" class="form-control text-dark">
                                @foreach ($locations as $location)
                                    <option @if ($trip->to_location_id == $location->id) selected @endif value="{{ $location->id }}">
                                        {{ $location->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date &amp; Time</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                placeholder="Start Date" value="{{ date('Y-m-d\TH:i', strtotime($trip->departure_date)) }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date &amp; Time</label>
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                placeholder="End Date" value="{{ date('Y-m-d\TH:i', strtotime($trip->return_date)) }}">
                        </div>
                        <div class="form-group">
                            <label for="price_per_seat">Price Per Seat</label>
                            <input type="number" class="form-control" id="price_per_seat" name="price_per_seat"
                                placeholder="Price per seat" value="{{$trip->price_per_seat}}">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
