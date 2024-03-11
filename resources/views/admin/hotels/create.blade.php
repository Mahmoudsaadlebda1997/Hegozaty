@extends('admin.layouts.app')
@section('content')
    <!-- /.card-header -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - اضافه الفنادق</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active"> اضافه الفنادق</li>
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
                <form role="form" method='post' action="{{ route('hotels.store') }}" enctype="multipart/form-data">
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
                        <!-- Hotel Name -->
                            <div class="form-group">
                                <label for="name">اسم الفندق</label>
                                <input type="text" required name="name" value="{{ old('name') }}" class="form-control"/>
                            </div>

                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="exampleInputFile">صورة الفندق</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile"></label>
                                    </div>
                                    <div class="input-group-append">
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control" type="hidden" name="rating" value="0">

                            <!-- Location -->
                            <div class="form-group">
                                <label for="location">الموقع</label>
                                <input type="text" required name="location" value="{{ old('location') }}" class="form-control"/>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">الوصف</label>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <!-- Phone -->
                            <div class="form-group">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" required name="phone" value="{{ old('phone') }}" class="form-control"/>
                            </div>

                            <!-- Second Phone (nullable) -->
                            <div class="form-group">
                                <label for="phone2">رقم الهاتف الثاني (اختياري)</label>
                                <input type="text" name="phone2" value="{{ old('phone2') }}" class="form-control"/>
                            </div>

                            <!-- Email (nullable) -->
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني (اختياري)</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"/>
                            </div>

                            <!-- Website (nullable) -->
                            <div class="form-group">
                                <label for="website">الموقع الإلكتروني (اختياري)</label>
                                <input type="url" name="website" value="{{ old('website') }}" class="form-control"/>
                            </div>

                            <!-- Facebook Page (nullable) -->
                            <div class="form-group">
                                <label for="facebook">صفحة الفيسبوك (اختياري)</label>
                                <input type="url" name="facebook" value="{{ old('facebook') }}" class="form-control"/>
                            </div>

                            <!-- Instagram Page (nullable) -->
                            <div class="form-group">
                                <label for="instagram">صفحة الإنستجرام (اختياري)</label>
                                <input type="url" name="instagram" value="{{ old('instagram') }}" class="form-control"/>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">إنشاء الفندق</button>


                    </div>

                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
