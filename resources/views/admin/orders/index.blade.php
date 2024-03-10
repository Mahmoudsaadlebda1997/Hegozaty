@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> الرئيسية - الطلبات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الطلبات</li>
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
                        <h3 class="card-title" style="float: right">قائمة الطلبات</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>اسم المستخدم</th>
                                <th>الفصيلة</th>
                                <th>الموبايل</th>
                                <th>الفرع</th>
                                <th>حالة الطلب</th>
                                <th>تاريخ الطلب</th>
                                <th>الاجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->blood_type->name }}</td>
                                    <td>{{ $order->user->phone }}</td>
                                    <td>{{ $order->branch->name }}</td>
                                    <td>
                                        @if($order->status == 'accepted')
                                            <span class="badge badge-success">مقبول</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge badge-danger">ملغي</span>
                                        @else
                                            <span class="badge badge-secondary">قيد الانتظار</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->locale('ar')->isoFormat('dddd, MMMM D, YYYY h:mm A') }}</td>
                                    <td>


                                        <a href="{{ route('orders.edit', $order->id) }}"
                                           class="btn btn-warning btn-sm">تعديل</a>

                                        <form action="{{ route('orders.destroy', $order->id) }}"
                                              method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('هل أنت متأكد؟')">حذف
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
