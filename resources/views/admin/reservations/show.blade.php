@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - تفاصيل الحجز</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reservations.index') }}">قائمة الحجوزات</a></li>
                        <li class="breadcrumb-item active">تفاصيل الحجز</li>
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
                        <h3 class="card-title" style="float: right">تفاصيل الحجز #{{ $reservation->id }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>تفاصيل العميل</h5>
                                <p><strong>اسم العميل:</strong> {{ $reservation->user->name ?? 'غير معروف' }}</p>
                                <p><strong>البريد الإلكتروني:</strong> {{ $reservation->user->email ?? 'غير متوفر' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>تفاصيل الحجز</h5>
                                <p><strong>تاريخ الحجز:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('Y-m-d h:i a') }}</p>
                                <p><strong>الحالة:</strong>
                                    @if($reservation->status === 'pending')
                                        <span class="badge badge-warning">قيد الانتظار</span>
                                    @elseif($reservation->status === 'accepted')
                                        <span class="badge badge-success">تم الانتهاء  </span>
                                    @elseif($reservation->status === 'cancelled')
                                        <span class="badge badge-danger">تم الإلغاء</span>
                                    @else
                                        <span class="badge badge-secondary">غير معروف</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <h5>تفاصيل الخدمة</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الخدمة</th>
                                <th>الوصف</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $reservation->service->id ?? '-' }}</td>
                                <td>{{ $reservation->service->name ?? 'غير معروف' }}</td>
                                <td>{{ $reservation->service->description ?? 'لا يوجد وصف' }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <a href="{{ route('reservations.index') }}" class="btn btn-primary">رجوع إلى قائمة الحجوزات</a>
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
