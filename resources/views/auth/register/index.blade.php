
@extends('layouts.login')

@section('content')
    <div class="col-md-6 right-box p-5">
        <form id="form_register">
            @csrf
            <div class="row align-items-center">
                <div class="text-center">
                    <h2>Register</h2>
                </div>

                <span id="error-email" class="text-danger" style="display: none">*กรุณากรอกข้อมูล</span>
                <div class="input-group mb-3">
                    <input type="text" id="email" name="email" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Email address">
                </div>

                <span id="error-name" class="text-danger" style="display: none">*กรุณากรอกข้อมูล</span>
                <div class="input-group mb-3">
                    <input type="text" id="name" name="name" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Name">
                </div>

                <span id="error-password" class="text-danger" style="display: none">*กรุณากรอกข้อมูล</span>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Password">
                </div>

                <span id="error-confirm-password" class="text-danger" style="display: none">*กรุณากรอกข้อมูล</span>
                <span id="error-notmatch-password" class="text-danger" style="display: none">*password ไม่ตรงกัน</span>
                <div class="input-group mb-3">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Password">
                </div>

                <div id="display-error" class="text-danger" style="display: none"></div>

                <div class="input-group mb-3">
                    <button type="button" class="btn btn-lg btn-primary w-100 fs-6" onclick="register()">Register</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    @include('auth.register.script')
@endsection
