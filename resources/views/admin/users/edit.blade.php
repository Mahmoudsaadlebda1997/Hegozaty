@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - تعديل بيانات المستخدم</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">تعديل المستخدم</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <form role="form" method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="ادخل الاسم" value="{{ $user->name }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" class="form-control" name="email" placeholder="ادخل البريد الإلكتروني" value="{{ $user->email }}" required>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">الموبايل</label>
                            <input type="text" class="form-control" name="phone_number" placeholder="ادخل الموبايل" value="{{ $user->phone_number }}">
                        </div>

                        <!-- Password (Optional) -->
                        <div class="form-group">
                            <label for="password">كلمة المرور (اتركه فارغًا إذا لم ترغب في التغيير)</label>
                            <input type="password" class="form-control" name="password" placeholder="ادخل كلمة المرور الجديدة">
                        </div>

                        <!-- Role Selection -->
                        <div class="form-group">
                            <label for="role">دور المستخدم</label>
                            <select name="role" class="form-control" required>
                                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>مستخدم عادي</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مشرف</option>
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
                            @if($user->image)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="img-fluid rounded" style="max-width: 150px;">
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary">تحديث البيانات</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
