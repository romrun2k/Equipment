@extends('layouts.login')

@section('content')
    <div class="col-md-6 right-box p-5">
        <form id="form_login">
            @csrf
            <div class="row align-items-center">
                <div class="header-text mb-4 text-center">
                    <h2>Login</h2>
                </div>
                <span id="error-email" class="text-danger" style="display: none">*กรุณากรอกข้อมูล</span>
                <div class="input-group mb-3">
                    <input type="text" id="email" name="email" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Email address">
                </div>

                <span id="error-password" class="text-danger" style="display: none">*กรุณากรอกข้อมูล</span>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Password">
                </div>

                <div class="input-group mb-5 d-flex justify-content-between">
                    <div class="forgot">
                        <small><a href="{{ route('register_form') }}">Register</a></small>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <button type="button" class="btn btn-lg btn-primary w-100 fs-6" onclick="login()">Login</button>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('script')
    @include('auth.login.script')
@endsection
