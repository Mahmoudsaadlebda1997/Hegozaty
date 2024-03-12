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

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-left ">Mansoura Booking  إنشاء حساب جديد لموقع </div>
                        <div class="card-body">

                            <form action="{{ route('register') }}" method="POST" style="direction: rtl;">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">الاسم</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="name" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">البريد الإلكتروني</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email" class="form-control" name="email" required>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone" class="form-control" name="phone" required>
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">رقم المرور</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <input type="hidden" name="role" value="user">

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">تسجيل المستخدم</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
