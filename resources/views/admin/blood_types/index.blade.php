@extends('admin.layouts.app')
@section('content')
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
    @include('admin.layouts.message')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">فصائل الدم</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>العدد</th>
                                <th>حالة الفصيلة</th>
                                <th>الاجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blood_types as $type)
                                <tr>

                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->count }}</td>
                                    <td>
                                        @if($type->count > 5)
                                            <span class="bg-success text-white px-2 py-1 rounded">متاح</span>
                                        @elseif($type->count <= 5 && $type->count > 0)
                                            <span class="bg-warning text-white px-2 py-1 rounded">اقترب من الانتهاء</span>
                                        @else
                                            <span class="bg-danger text-white px-2 py-1 rounded"> انتهى</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('blood_types.edit', $type->id) }}"
                                           class="btn btn-warning btn-sm">تعديل</a>
                                        <form action="{{ route('blood_types.destroy', $type->id) }}" method="post"
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
@endsection
