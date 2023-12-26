@extends('appLayout')

@section('section')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="../../assets/images/logo.svg">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show pb-0" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                                        placeholder="Password" name="password">
                                </div>
                                <div class="mt-3">
                                    <button
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN IN</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Don't have an account?
                                    <a href="{{ route('registerView') }}" class="text-primary">Create</a>
                                </div>
                            </form>
                            <div class="login-details mt-4">
                                <hr>
                                <h6>Login Details<small> (After DB SEED)</small></h6>
                                <p class="mb-0">Admin:</p>
                                <p class="mb-2">
                                    <span>Email: admin@gmail.com</span> &nbsp; <span>Pass: password</span>
                                </p>
                                <p class="mb-0">User:</p>
                                <p>
                                    <span>Email: user@gmail.com</span> &nbsp; <span>Pass: password</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
