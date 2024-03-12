@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> الرئيسية - قائمة الحجوزات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">قائمة الحجوزات</li>
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
                        <h3 class="card-title" style="float: right">قائمة الحجوزات</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الغرفة</th>
                                <th>تاريخ الحجز</th>
                                <th>تاريخ الوصول</th>
                                <th>تاريخ المغادرة</th>
                                <th>الحالة</th>
                                <th>الاجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->room->name }}</td>
                                    <td>{{ $reservation->created_at }}</td>
                                    <td>{{ $reservation->check_in }}</td>
                                    <td>{{ $reservation->check_out }}</td>
                                    <td>
                                        @if($reservation->status === 'pending')
                                            <span class="badge badge-warning">قيد الانتظار</span>
                                        @elseif($reservation->status === 'accepted')
                                            <span class="badge badge-success">تم القبول</span>
                                        @elseif($reservation->status === 'cancelled')
                                            <span class="badge badge-danger">تم الإلغاء</span>
                                        @else
                                            <span class="badge badge-secondary">غير معروف</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('reservations.update-status', $reservation->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="form-control">
                                                <option value="accepted" {{ $reservation->status === 'accepted' ? 'selected' : '' }}>تم القبول</option>
                                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>تم الإلغاء</option>
                                                <!-- Add more status options as needed -->
                                            </select>
                                        </form>
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
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
