@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">الرئيسية - تفاصيل الخدمة</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                            <li class="breadcrumb-item active">تفاصيل الخدمة</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <!-- Display service image -->
                        <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('images/no-image.png') }}"
                             class="card-img-top img-fluid mx-auto d-block w-25"
                             alt="{{ $service->name }}">

                        <div class="card-body text-center">
                            <h2 class="text-center">{{ $service->name }}</h2>
                            <p class="mt-3">{{ $service->description }}</p> <!-- Display service description -->

                            <p><strong>نوع الخدمة:</strong>
                                @if($service->service_type === 'phone_banking')
                                    <span class="badge bg-primary">خدمة هاتفية مصرفية</span>
                                @elseif($service->service_type === 'branch')
                                    <span class="badge bg-success">من الفرع</span>
                                @else
                                    <span class="badge bg-secondary">غير محدد</span>
                                @endif
                            </p>

                            <div class="mt-3">
                                <a href="{{ route('services.index') }}" class="btn btn-primary">رجوع إلى قائمة الخدمات</a>
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">تعديل الخدمة</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
