@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> الرئيسية - قائمة الفنادق</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">قائمة الفنادق</li>
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
                        <h3 class="card-title" style="float: right">قائمة الفنادق</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th>الاسم</th>
                                <th>الهاتف</th>
                                <th>التقييم</th>
                                <th>الاجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hotels as $hotel)
                                <tr>
                                    <td>{{ $hotel->id }}</td>
                                    <td>
                                        @if($hotel->image)
                                            <img src="{{ $hotel->image ? asset('storage/' . $hotel->image) : asset('images/no-image.png') }}" class="card-img-top img-fluid mx-auto d-block" style="max-width: 125px; max-height: 125px;" alt="{{ $hotel->name }}">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $hotel->phone }}</td>
                                    <td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $hotel->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </td>                                    <td>
                                        <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-info btn-sm">عرض</a>
                                        <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="post" style="display: inline-block;">
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
                            {{ $hotels->links() }}
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
