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
                        <li class="breadcrumb-item active"> المستخدمين</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <form role="form" method='post' action="{{ route('users.update', $user->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاسم</label>
                            <input type="text" class="form-control" name="name" id="exampleInputText1"
                                   placeholder="ادخل الاسم" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الالكتروني</label>
                            <input type="email" class="form-control" name="email" id="exampleInputText1"
                                   placeholder="ادخل البريد الالكتروني" value="{{ $user->email }}">
                        </div>

                        <div>
                            <label for="phone"> الموبايل </label>
                            <input type="text" class="form-control" name="phone" id="exampleInputText1"
                                   placeholder="ادخل الموبايل" value="{{ $user->phone }}">
                        </div>

                        <div class="form-group">
                            <label for="password"> كلمة المرور </label>
                            <input type="password" class="form-control" name="password" id="exampleInputText1"
                                   placeholder="ادخل كلمة المرور">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">تأكيد</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
