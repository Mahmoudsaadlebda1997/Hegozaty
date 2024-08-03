@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - إضافة المنتج</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">إضافة المنتج</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- form start -->
                <form role="form" method='post' action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger text-center">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif

                    <!-- Room Name -->
                        <div class="form-group">
                            <label for="name">اسم المنتج</label>
                            <input type="text" required name="name" value="{{ old('name') }}" class="form-control"/>
                        </div>
                        <!-- Category ID -->
                        <div class="form-group">
                            <label for="category_id">القسم</label>
                            <select name="category_id" class="form-control" required>
                                <option value="" selected disabled>اختر القسم</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">السعر</label>
                            <input type="text" required name="price" value="{{ old('price') }}" class="form-control"/>
                        </div>

                        <!-- Code -->
                        <div class="form-group">
                            <label for="area">الكود</label>
                            <input type="text" required name="code" value="{{ old('code') }}" class="form-control"/>
                        </div>
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>
                            <!-- Media Type -->
                            <div class="form-group">
                                <label>نوع الوسائط</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" value="image" id="imageRadio" checked>
                                    <label class="form-check-label" for="imageRadio">صورة</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" value="video" id="videoRadio">
                                    <label class="form-check-label" for="videoRadio">فيديو</label>
                                </div>
                            </div>
                            <!-- Image Upload -->
                        <div class="form-group">
                            <label for="exampleInputFile">صور المنتج</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="images[]"
                                           multiple>
                                    <label class="custom-file-label" for="exampleInputFile"></label>
                                </div>
                            </div>
                        </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">الحالة</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" value="available" id="available" {{ old('status') == 'available' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="available">متوفر</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" value="out_of_stock" id="outOfStock" {{ old('status') == 'out_of_stock' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="outOfStock">غير متوفر</label>
                                </div>
                            </div>
                            <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">إنشاء المنتج</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
