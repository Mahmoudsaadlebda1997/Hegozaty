@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - قائمة المنتجات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">قائمة المنتجات</li>
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
                        <h3 class="card-title" style="float: right">قائمة المنتجات</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المنتج</th>
                                <th>القسم</th>
                                <th>السعر</th>
                                <th>الكود</th>
                                <th>الحالة</th>
                                <th>الإجراء المتخذ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category?->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->status == 'available' ? 'متوفر' : 'غير متوفر' }}</td>
                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">عرض</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline-block;">
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
                            {{ $products->links() }}
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
