@extends('admin.layouts.app')
@section('content')
    <!-- /.card-header -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - اضافه الاقسام</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active"> اضافه الاقسام</li>
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
                <form role="form" method='post' action="{{ route('categories.store') }}" enctype="multipart/form-data">
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
                                <label for="name">اسم القسم</label>
                                <input type="text" required name="name" value="{{ old('name') }}" class="form-control"/>
                            </div>

                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="exampleInputFile">صورة القسم</label>
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
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">إنشاء القسم</button>

                    </div>

                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
