@extends('site.layout')

@section('content')
    <!-- Page Header Start -->
    @include('admin.layouts.message')

    <div class="container-fluid page-header mb-5 p-0"
         style="background-image: url({{ asset('site/img/carousel-1.jpg') }});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">بنك الدلتا</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="/">الرئيسية </li>
                        <li class="breadcrumb-item text-white active" aria-current="page"> / بنك الدلتا </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container mb-5" dir="rtl">
        <div class="row session-title mt-3 mb-4">
            <h2 class="text-center text-primary">بنك الدلتا</h2>
        </div>

        @if(count($reservations) > 0)
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الخدمة</th>
                        <th scope="col">تاريخ الحجز</th>
                        <th scope="col">الحالة</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <th scope="row">{{ $reservation->id }}</th>
                            <td>{{ $reservation->service->name ?? 'غير متوفر' }}
                                @if($reservation->service->service_type === 'phone_banking')
                                    {{ __('(خدمة هاتفية مصرفية)') }}
                                @elseif($reservation->service->service_type === 'branch')
                                    {{ __('(من الفرع)') }}
                                @else
                                    {{ __('(غير محدد)') }}
                                @endif</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('Y-m-d h:i A') }}</td>
                            <td>
                                @if($reservation->status === 'pending')
                                    <span class="badge bg-warning text-dark">في الانتظار</span>
                                @elseif($reservation->status === 'paid')
                                    <span class="badge bg-info text-white">مدفوع</span>
                                @elseif($reservation->status === 'delivered')
                                    <span class="badge bg-success">تم التسليم</span>
                                @elseif($reservation->status === 'cancelled')
                                    <span class="badge bg-danger">ملغي</span>
                                @endif
                            </td>
                            <td>
                                @if($reservation->status !== 'cancelled' && $reservation->status !== 'delivered')
                                    <form action="{{ route('destroyReservation', $reservation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('هل أنت متأكد من إلغاء الحجز؟')">
                                            إلغاء
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">لا يوجد إجراء</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="text-center justify-content-center m-3">
                {{ $reservations->links('pagination::bootstrap-4') }}
            </div>
        @else
            <p class="text-center text-secondary">ليس لديك حجوزات.</p>
        @endif
    </div>
@endsection
