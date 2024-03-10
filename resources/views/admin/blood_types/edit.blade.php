@extends('admin.layouts.app')
@section('content')
    <!-- /.card-header -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - فصائل الدم</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">فصائل الدم</li>
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
                <form role="form" method='post' action="{{ route('blood_types.update',$blood_type->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">الاسم</label>
                            <input type="text" class="form-control" name="name" id="exampleInputText1"
                                   placeholder="ادخل الاسم" value="{{ $blood_type->name }}">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">العدد المتاح</label>
                            <input type="number" class="form-control" name="count" id="exampleInputText1"
                                   placeholder="ادخل العدد المتاح" value="{{ $blood_type->count }}">
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
