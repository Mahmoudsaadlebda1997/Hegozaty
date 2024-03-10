@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> الرئيسية - المتبرعين</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">المتبرعين</li>
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
                        <h3 class="card-title" style="float: right">قائمة المتبرعين</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الفصيلة</th>
                                <th>الموبايل</th>
                                <th>ميعاد اخر تبرع</th>
                                <th>العمر</th>
                                <th>التبرع بالمال</th>
                                <th>الاجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($donors as $donor)
                                <tr>
                                    <td>{{ $donor->name }}</td>
                                    <td>{{ $donor->blood_type }}</td>
                                    <td>{{ $donor->phone }}</td>
                                    <td>{{ Carbon\Carbon::parse($donor->last_donation)->format('Y-m-d') }}</td>
                                    <td>{{ $donor->age }}</td>
                                    <td>
                                        @if($donor->money_donation)
                                            <span class="bg-success text-white px-2 py-1 rounded">نعم</span>
                                        @else
                                            <span class="bg-danger text-white px-2 py-1 rounded"> لا</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('donors.edit', $donor->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                        <form action="{{ route('donors.destroy', $donor->id) }}" method="post"
                                              style="display: inline-block;">
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
