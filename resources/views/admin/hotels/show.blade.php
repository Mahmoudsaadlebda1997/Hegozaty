@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> الرئيسية - تفاصيل الفندق</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                            <li class="breadcrumb-item active">تفاصيل الفندق</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <!-- You can replace 'hotel' with the appropriate variable containing hotel details -->
                        <img src="{{ $hotel->image ? asset('storage/' . $hotel->image) : asset('images/no-image.png') }}" class="card-img-top img-fluid mx-auto d-block w-25" alt="{{ $hotel->name }}">
                        <div class="card-body text-center">
                            <h2 class="text-center">{{ $hotel->name }}</h2>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>الموقع</strong><br>{{ $hotel->location }}</li>
                            <li class="list-group-item"><strong>الوصف</strong><br>{{ $hotel->description }}</li>
                            <li class="list-group-item"><strong>رقم الهاتف</strong><br>{{ $hotel->phone }}</li>
                            <li class="list-group-item"><strong>التقييم</strong><br>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $hotel->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </li>
                            <li class="list-group-item"><strong>رقم الهاتف الثاني</strong><br>{{ $hotel->phone2 }}</li>
                            <li class="list-group-item"><strong>البريد الإلكتروني</strong><br>{{ $hotel->email }}</li>
                            <li class="list-group-item"><strong>الموقع الإلكتروني</strong><br>{{ $hotel->website }}</li>
                            <li class="list-group-item"><strong>صفحة الفيسبوك</strong><br>{{ $hotel->facebook }}</li>
                            <li class="list-group-item"><strong>صفحة الإنستجرام</strong><br>{{ $hotel->instagram }}</li>
                            <!-- Add more details as needed -->
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
