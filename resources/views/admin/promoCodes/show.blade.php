@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">الرئيسية - تفاصيل كود الخصم</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">الرئيسية</a></li>
                            <li class="breadcrumb-item active">تفاصيل كود الخصم</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">تفاصيل كود الخصم</h3>
                        </div>
                        <div class="card-body">
                            <!-- Promo Code Details -->
                            <div class="row mb-3">
                                <div class="col-md-4 font-weight-bold">الكود:</div>
                                <div class="col-md-8">{{ $promoCode->code }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 font-weight-bold">تاريخ البدء:</div>
                                <div class="col-md-8">

                                    {{ \Carbon\Carbon::parse($promoCode->start_date)->format('Y-m-d H:i:s') }}

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 font-weight-bold">تاريخ الانتهاء:</div>
                                <div class="col-md-8">                                    {{ \Carbon\Carbon::parse($promoCode->end_date)->format('Y-m-d H:i:s') }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 font-weight-bold">نسبة الخصم:</div>
                                <div class="col-md-8">{{ $promoCode->discount_percentage }}%</div>
                            </div>

                            <!-- Actions -->
                            <div class="text-center">
                                <a href="{{ route('promoCodes.edit', $promoCode->id) }}" class="btn btn-warning">تعديل</a>
                                <a href="{{ route('promoCodes.index') }}" class="btn btn-primary">العودة إلى القائمة</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
