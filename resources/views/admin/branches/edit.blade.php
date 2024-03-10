@extends('admin.layouts.app')
@section('content')
    <!-- /.card-header -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - الفرع</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الفرع</li>
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
                <form role="form" method='post' action="{{ route('branches.update',$branch->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الفرع</label>
                            <input type="text" class="form-control" name="name" id="exampleInputText1"
                                   placeholder="ادخل الاسم" value="{{ $branch->name }}">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </div>

                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
