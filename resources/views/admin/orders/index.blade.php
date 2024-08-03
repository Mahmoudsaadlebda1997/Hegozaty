@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> الرئيسية - قائمة الاوردرات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">قائمة الاوردرات</li>
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
                        <h3 class="card-title" style="float: right">قائمة الاوردرات</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم العميل</th>
                                <th>اسامي المنتجات</th>
                                <th>تاريخ الحجز</th>
                                <th>الحالة</th>
                                <th>الاجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        @foreach($order->products as $product)
                                            <div>{{ $product->name }}</div>
                                        @endforeach
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d h:i a') }}</td>
                                    <td>
                                        @if($order->status === 'pending')
                                            <span class="badge badge-warning">قيد الانتظار</span>
                                        @elseif($order->status === 'accepted')
                                            <span class="badge badge-success">تم القبول</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge badge-danger">تم الإلغاء</span>
                                        @elseif($order->status === 'paid')
                                            <span class="badge badge-danger">تم الدفع</span>
                                        @else
                                            <span class="badge badge-secondary">غير معروف</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('orders.update-status', $order->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="form-control">
                                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                                <option value="accepted" {{ $order->status === 'accepted' ? 'selected' : '' }}>تم القبول</option>
                                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>تم الإلغاء</option>
                                                <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>تم الدفع</option>
                                            </select>
                                        </form>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center justify-content-center m-3">
                            {{ $orders->links() }}
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
