@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - تعديل الغرفة</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">تعديل الغرفة</li>
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
                <form role="form" method='post' action="{{ route('rooms.update', $room->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                            <label for="name">اسم الغرفة</label>
                            <input type="text" required name="name" value="{{ old('name', $room->name) }}"
                                   class="form-control"/>
                        </div>

                        <!-- Hotel ID -->
                        <div class="form-group">
                            <label for="hotel_id">الفندق</label>
                            <select name="hotel_id" class="form-control" required>
                                <option value="" selected disabled>اختر الفندق</option>
                                @foreach($hotels as $hotel)
                                    <option
                                        value="{{ $hotel->id }}" {{ old('hotel_id', $room->hotel_id) == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">السعر</label>
                            <input type="text" required name="price" value="{{ old('price', $room->price) }}"
                                   class="form-control"/>
                        </div>

                        <!-- Capacity -->
                        <div class="form-group">
                            <label for="capacity">السعة</label>
                            <input type="text" required name="capacity" value="{{ old('capacity', $room->capacity) }}"
                                   class="form-control"/>
                        </div>

                        <!-- Available Count -->
                        <div class="form-group">
                            <label for="available_count">العدد المتاح</label>
                            <input type="text" required name="available_count"
                                   value="{{ old('available_count', $room->available_count) }}" class="form-control"/>
                        </div>

                        <!-- Area -->
                        <div class="form-group">
                            <label for="area">مساحة الغرفة</label>
                            <input type="text" required name="area" value="{{ old('area', $room->area) }}"
                                   class="form-control"/>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">الوصف</label>
                            <textarea name="description"
                                      class="form-control">{{ old('description', $room->description) }}</textarea>
                        </div>

                        <!-- Media Type -->
                        <div class="form-group">
                            <label>نوع الوسائط</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="image" id="imageRadio"
                                       checked>
                                <label class="form-check-label" for="imageRadio">صورة</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" value="video" id="videoRadio">
                                <label class="form-check-label" for="videoRadio">فيديو</label>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="exampleInputFile">صور الغرفة</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="images[]"
                                           multiple>
                                    <label class="custom-file-label" for="exampleInputFile"></label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">تحديث الغرفة</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
