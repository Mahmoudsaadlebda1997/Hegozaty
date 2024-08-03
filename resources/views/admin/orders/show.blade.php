@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> الرئيسية - تفاصيل الطلب</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">قائمة الاوردرات</a></li>
                        <li class="breadcrumb-item active">تفاصيل الطلب</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    @include('admin.layouts.message')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">تفاصيل الطلب #{{ $order->id }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>تفاصيل العميل</h5>
                                <p><strong>اسم العميل:</strong> {{ $order->user->name }}</p>
                                <p><strong>البريد الإلكتروني:</strong> {{ $order->user->email }}</p>
                                <!-- Add more user details if needed -->
                            </div>
                            <div class="col-md-6">
                                <h5>تفاصيل الطلب</h5>
                                <p><strong>تاريخ الطلب:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d h:i a') }}</p>
                                <p><strong>الحالة:</strong>
                                    @if($order->status === 'pending')
                                        <span class="badge badge-warning">قيد الانتظار</span>
                                    @elseif($order->status === 'accepted')
                                        <span class="badge badge-success">تم القبول</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge badge-danger">تم الإلغاء</span>
                                    @elseif($order->status === 'paid')
                                        <span class="badge badge-info">تم الدفع</span>
                                    @else
                                        <span class="badge badge-secondary">غير معروف</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <h5>تفاصيل المنتجات</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المنتج</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $product->price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <h6>السعر الكلي :{{ $order->total_price }}</h6>

                        <div class="mt-3">
                            <a href="{{ route('orders.index') }}" class="btn btn-primary">رجوع إلى قائمة الطلبات</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
