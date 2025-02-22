@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - قائمة الخدمات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">قائمة الخدمات</li>
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
                        <h3 class="card-title" style="float: right">قائمة الخدمات</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th>الاسم</th>
                                <th>الوصف</th>
                                <th>نوع الخدمة</th>
                                <th>الإجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>
                                        @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top img-fluid mx-auto d-block" style="max-width: 125px; max-height: 125px;" alt="{{ $service->name }}">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" class="card-img-top img-fluid mx-auto d-block" style="max-width: 125px; max-height: 125px;" alt="No Image">
                                        @endif
                                    </td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ Str::limit($service->description, 50) }}</td>
                                    <td>
                                        @if($service->service_type === 'phone_banking')
                                            <span class="badge bg-primary">خدمة هاتفية مصرفية</span>
                                        @elseif($service->service_type === 'branch')
                                            <span class="badge bg-success">من الفرع</span>
                                        @else
                                            <span class="badge bg-secondary">غير محدد</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm">عرض</a>
                                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="post" style="display: inline-block;">
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
                            {{ $services->links() }}
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
