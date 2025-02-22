@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - إضافة الخدمات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">إضافة الخدمات</li>
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
                <form role="form" method="post" action="{{ route('services.store') }}" enctype="multipart/form-data">
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

                    <!-- Service Name -->
                        <div class="form-group">
                            <label for="name">اسم الخدمة</label>
                            <input type="text" required name="name" value="{{ old('name') }}" class="form-control"/>
                        </div>

                        <!-- Service Description -->
                        <div class="form-group">
                            <label for="description">وصف الخدمة</label>
                            <textarea required name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>

                        <!-- Service Type -->
                        <div class="form-group">
                            <label for="service_type">نوع الخدمة</label>
                            <select name="service_type" class="form-control" required>
                                <option value="phone_banking" {{ old('service_type') == 'phone_banking' ? 'selected' : '' }}>خدمة هاتفية مصرفية</option>
                                <option value="branch" {{ old('service_type') == 'branch' ? 'selected' : '' }}>من الفرع</option>
                            </select>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="exampleInputFile">صورة الخدمة</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                    <label class="custom-file-label" for="exampleInputFile"></label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">إنشاء الخدمة</button>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
@endsection
