@extends('Admin.layout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </span>Location
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
                    <h4 class="card-title">All Location</h4>
                    @if (count($locations) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>#{{ $location->id }}</td>
                                        <td>{{ $location->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('location.edit', $location->id) }}"
                                                    class="btn btn-warning btn-xs mr-4">Edit</a> &nbsp; &nbsp;
                                                <form action="{{ route('location.destroy', $location->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-xs ml-4">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $locations->links() }}
                        </div>
                    @else
                        <h4 class="text-center mt-4">No Location Found</h4>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">Add Location</p>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show pb-0" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="forms-sample" method="POST" action="{{ route('location.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="location_name">Location</label>
                            <input type="text" class="form-control" id="location_name" name="name"
                                placeholder="Location">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
