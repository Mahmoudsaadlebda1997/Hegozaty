@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - المستخدمين</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">المستخدمين</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- form start -->
                <form role="form" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger text-center">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif

                    <!-- Name -->
                        <div class="form-group">
                            <label for="name">اسم المستخدم</label>
                            <input type="text" required class="form-control" name="name" placeholder="ادخل الاسم">
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" required class="form-control" name="email" placeholder="ادخل البريد الإلكتروني">
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">الموبايل</label>
                            <input type="text" required class="form-control" name="phone_number" placeholder="ادخل الموبايل">
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <input type="password" required class="form-control" name="password" placeholder="ادخل كلمة المرور">
                        </div>

                        <!-- Role Selection -->
                        <div class="form-group">
                            <label for="role">دور المستخدم</label>
                            <select name="role" class="form-control" required>
                                <option value="customer" selected>مستخدم عادي</option>
                                <option value="admin">مشرف</option>
                            </select>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="image">صورة المستخدم</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">اختر صورة</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary">تأكيد</button>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
@endsection
