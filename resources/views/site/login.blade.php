@extends('site.layout')

@section('content')
    <style>
        .column {
            float: left;
            width: 50%;
            padding: 0 5px;
        }

        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #FEA116;
            color: #fff;
            text-align: right;
        }

        .form-group {
            text-align: right;
        }

        .checkbox {
            text-align: right;
        }

        .btn-primary {
            background-color: #FEA116;
            border-color: #FEA116;
        }

        .btn-primary:hover {
            background-color: #FEA116;
            border-color: #FEA116;
        }

        /* Additional Styles */
        main {
            padding:  40px 0;
        }

        form {
            margin-top: 20px;
        }

        .mt-3 {
            margin-top: 1rem;
        }

    </style>

    @include('admin.layouts.message')

    <main class="login-form m-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-right ">Point E-Commerce تسجيل الدخول لموقع</div>
                        <div class="card-body">

                            <form action="{{ route('loginUser') }}" method="POST" style="direction: rtl;">
                                @csrf
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">البريد
                                        الالكتروني</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" required
                                               autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">رقم
                                        المرور</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password"
                                               required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> تذكرني
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        تسجيل الدخول
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
