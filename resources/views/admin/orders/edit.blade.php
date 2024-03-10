@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - الطلبات </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active"> الطلبات </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('orders.update', $order->id) }}" method="post"
                          enctype="multipart/form-data" class="mx-auto">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">حالة الطلب:</label>
                                <select name="status" required class="form-control">
                                    <option value="accepted" {{ old('status', $order->status ?? '') == 'accepted' ? 'selected' : '' }}>مقبول</option>
                                    <option value="cancelled" {{ old('status', $order->status ?? '') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
