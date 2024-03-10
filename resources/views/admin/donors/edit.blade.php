@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">الرئيسية - المتبرعين</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                        <li class="breadcrumb-item active">المتبرعين</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- form start -->
                <form role="form" method='post' action="{{ route('donors.update', $donor->id) }}"
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

                        <div class="form-group">
                            <label for="name">اسم المتبرع</label>
                            <input type="text" required name="name" value="{{ old('name',$donor->name) }}"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="doctor_name">رقم الموبايل</label>
                            <input type="text" name="phone" value="{{ old('phone',$donor->phone) }}"
                                   class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label for="department">فصيلة الدم</label>
                            <select name="blood_type" required class="form-control">
                                <option disabled selected>اختر فصيلة الدم</option>
                                @foreach($blood_types as $blood_type)
                                    <option value="{{ $blood_type->name }}"
                                            @if($blood_type->name == $donor->blood_type) selected @endif>
                                        {{ $blood_type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">الجنس</label>
                            <select name="gender" class="form-control">
                                <option value="ذكر" @if($donor->gender == 'ذكر') selected @endif>ذكر</option>
                                <option value="انثى" @if($donor->gender == 'انثى') selected @endif>انثى</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="age">العمر</label>
                            <input type="number" name="age" value="{{ old('age',$donor->age) }}" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <input type="text" name="address" value="{{ old('address',$donor->address) }}"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="last_donation">اخر ميعاد تبرع</label>
                            <input type="date" max="{{ today() }}" required name="last_donation"
                                   value="{{ old($donor->last_donation, date('Y-m-d')) }}"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="name">التبرع بالمال</label>
                            <select name="money_donation" class="form-control">
                                <option value="1" @if($donor->money_donation == 1) selected @endif>نعم</option>
                                <option value="0" @if($donor->money_donation == 0) selected @endif>لا</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
