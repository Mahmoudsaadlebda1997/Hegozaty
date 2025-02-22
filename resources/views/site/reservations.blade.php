@extends('site.layout')

@section('content')
    <!-- Page Header Start -->
    @include('admin.layouts.message')

    <div class="container-fluid page-header mb-5 p-0"
         style="background-image: url({{ asset('site/img/carousel-1.jpg') }});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">حجوزاتي</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item text-white active" aria-current="page">حجوزاتي</li>
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container mb-5" dir="rtl">
        <div class="row session-title mt-3 mb-4">
            <h2 class="text-center">حجوزاتي</h2>
        </div>

        @if(count($reservations) > 0)
            <table class="table table-striped table-bordered text-center">
                <thead>
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
                        <td>{{ $reservation->service->name ?? 'غير متوفر' }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('Y-m-d h:i a') }}</td>
                        <td>
                            @if($reservation->status === 'pending')
                                <span class="badge bg-warning text-dark">في الانتظار</span>
                            @elseif($reservation->status === 'done')
                                <span class="badge bg-success">تم الانتهاء </span>
                            @elseif($reservation->status === 'cancelled')
                                <span class="badge bg-danger">ملغي</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('destroyReservation', $reservation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من إلغاء الحجز؟')">إلغاء</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center justify-content-center m-3">
                {{ $reservations->links() }}
            </div>
        @else
            <p class="text-center">ليس لديك حجوزات.</p>
        @endif
    </div>
@endsection
