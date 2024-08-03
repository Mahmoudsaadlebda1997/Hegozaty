@extends('admin.layouts.app')
@section('content')
    <!-- /.card-header -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - تعديل كود الخصم</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">تعديل كود الخصم</li>
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
                <form role="form" method='post' action="{{ route('promoCodes.update', $promoCode->id) }}">
                    @csrf
                    @method('PUT')
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

                    <!-- Promo Code -->
                        <div class="form-group">
                            <label for="code">كود الخصم</label>
                            <input type="text" required name="code" value="{{ old('code', $promoCode->code) }}" class="form-control"/>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group">
                            <label for="start_date">تاريخ البدء</label>
                            <input type="datetime-local" required name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($promoCode->start_date)->format('Y-m-d H:i:s')) }}" class="form-control"/>
                        </div>

                        <!-- End Date -->
                        <div class="form-group">
                            <label for="end_date">تاريخ الانتهاء</label>
                            <input type="datetime-local" required name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($promoCode->start_date)->format('Y-m-d H:i:s')) }}" class="form-control"/>
                        </div>

                        <!-- Discount Percentage -->
                        <div class="form-group">
                            <label for="discount_percentage">نسبة الخصم</label>
                            <input type="number" required name="discount_percentage" value="{{ old('discount_percentage', $promoCode->discount_percentage) }}" class="form-control" step="0.01" min="0" max="100"/>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">تحديث كود الخصم</button>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
