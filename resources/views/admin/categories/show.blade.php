@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> الرئيسية - تفاصيل القسم</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                            <li class="breadcrumb-item active">تفاصيل القسم</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <!-- You can replace 'category' with the appropriate variable containing category details -->
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/no-image.png') }}" class="card-img-top img-fluid mx-auto d-block w-25" alt="{{ $category->name }}">
                        <div class="card-body text-center">
                            <h2 class="text-center">{{ $category->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
