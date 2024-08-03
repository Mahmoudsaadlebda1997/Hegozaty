@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - قائمة أكواد الخصم</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">قائمة أكواد الخصم</li>
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
                        <h3 class="card-title" style="float: right">قائمة أكواد الخصم</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الكود</th>
                                <th>تاريخ البدء</th>
                                <th>تاريخ الانتهاء</th>
                                <th>نسبة الخصم</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($promoCodes as $promoCode)
                                <tr>
                                    <td>{{ $promoCode->id }}</td>
                                    <td>{{ $promoCode->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($promoCode->start_date)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($promoCode->end_date)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $promoCode->discount_percentage }}%</td>
                                    <td>
                                        <a href="{{ route('promoCodes.show', $promoCode->id) }}" class="btn btn-info btn-sm">عرض</a>
                                        <a href="{{ route('promoCodes.edit', $promoCode->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                        <form action="{{ route('promoCodes.destroy', $promoCode->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center m-3">
                            {{ $promoCodes->links() }}
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
