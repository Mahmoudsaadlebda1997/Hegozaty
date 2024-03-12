@extends('site.layout')

@section('content') <!-- Page Header Start -->

@include('admin.layouts.message')

<div class="container-fluid page-header mb-5 p-0"
     style="background-image: url({{ asset('site/img/carousel-1.jpg') }});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">حجوازتي</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item text-white active" aria-current="page">حجوازتي</li>
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
                    <th scope="col">الغرفة</th>
                    <th scope="col">بداية الحجز</th>
                    <th scope="col">نهاية الحجز</th>
                    <th scope="col">الحالة</th>
                    <th scope="col">الاجراءات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <th scope="row">{{ $reservation->id }}</th>
                        <td>{{ $reservation->room->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d') }}</td>
                        <td>
                            @if($reservation->status === 'pending')
                                <span class="badge bg-warning text-dark">في الانتظار</span>
                            @elseif($reservation->status === 'accepted')
                                <span class="badge bg-success">مقبول</span>
                            @elseif($reservation->status === 'cancelled')
                                <span class="badge bg-danger">مرفوض</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('destroyReservation', $reservation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">الغاء</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>ليس لديك حجوزات.</p>
        @endif
    </div>
@endsection
