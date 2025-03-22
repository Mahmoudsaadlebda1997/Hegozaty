@extends('site.layout')

@section('content')

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #0d213f;
            color: #ffc107;
            text-align: right;
            font-weight: bold;
        }

        .form-group {
            text-align: right;
            margin-bottom: 1rem;
        }

        .checkbox {
            text-align: right;
        }

        .btn-primary {
            background-color: #0d213f;
            border-color: #0d213f;
            color: #ffc107;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0b1a30;
            border-color: #0b1a30;
            color: #ffc107;
        }

        /* Additional Styles */
        main {
            padding: 40px 0;
        }

        form {
            margin-top: 20px;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .login-form {
            margin: 5rem auto;
        }
    </style>

    @include('admin.layouts.message')

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg rounded">
                        <div class="card-header text-right">إنشاء حساب جديد في <strong>بنك الدلتا</strong></div>
                        <div class="card-body">

                            <form action="{{ route('register') }}" method="POST" style="direction: rtl;">
                            @csrf

                            <!-- Name -->
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">
                                        الاسم
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="name" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        البريد الإلكتروني
                                    </label>
                                    <div class="col-md-6">
                                        <input type="email" id="email" class="form-control" name="email" required>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">
                                        رقم الهاتف
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone" class="form-control" name="phone_number" required>
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">
                                        كلمة المرور
                                    </label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Hidden Role -->
                                <input type="hidden" name="role" value="user">

                                <!-- Submit Button -->
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            تسجيل المستخدم
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
