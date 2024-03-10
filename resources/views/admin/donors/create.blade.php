@extends('admin.layouts.app')
@section('content')
    <!-- /.card-header -->

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
                        <li class="breadcrumb-item active"> المتبرعين</li>
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
                <form role="form" method='post' action="{{ route('donors.store') }}" enctype="multipart/form-data">
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


                        <div class="form-group">
                            <label for="name">اسم المتبرع</label>
                            <input type="text" required name="name" value="{{ old('name') }}" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="doctor_name">رقم الموبايل</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="department">فصيلة الدم</label>
                            <select name="blood_type" required class="form-control">
                                <option disabled selected>اختر فصيلة الدم</option>
                                @foreach($blood_types as $blood_type)
                                    <option value="{{ $blood_type->name }}">{{ $blood_type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">الجنس</label>
                            <select name="gender" class="form-control">
                                <option value="ذكر">ذكر</option>
                                <option value="انثى">انثى</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="age">العمر</label>
                            <input type="number" name="age" value="{{ old('age') }}" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="address">العنوان</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="last_donation">اخر ميعاد تبرع</label>
                            <input type="date" max="{{ today() }}" required name="last_donation"
                                   value="{{ old('last_donation') }}"
                                   class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="name">التبرع بالمال</label>
                            <select name="money_donation" class="form-control">
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">تأكيد</button>
                        </div>

                    </div>

                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </section>
    <!-- /.card -->
@endsection
