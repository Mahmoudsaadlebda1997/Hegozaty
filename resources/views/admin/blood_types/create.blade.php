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
                <form role="form" method='post' action="{{ route('blood_types.store') }}" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الفصيلة</label>
                            <input type="text" class="form-control" name="name" id="exampleInputText1"
                                   placeholder="ادخل الاسم">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">العدد المتاح</label>
                            <input type="number" class="form-control" name="count" id="exampleInputText1"
                                   placeholder="ادخل العدد المتاح">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">تأكيد</button>
                        </div>


                    </div>

                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
