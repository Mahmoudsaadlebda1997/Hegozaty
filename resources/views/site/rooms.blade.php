@extends('site.layout')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
         style="background-image: url({{ asset('site/img/carousel-1.jpg') }});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">الغرف</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item text-white active" aria-current="page">الغرف</li>
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->



    <!-- Room Start -->
    <div class="container-xxl py-5" dir="rtl">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">غرفنا</h6>
                <h1 class="mb-5">اكتشف <span class="text-primary text-uppercase">الغرف</span></h1>
            </div>
            <div class="row g-4">
                @forelse($hotel->rooms as $room)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset(Storage::url($room->media[0]->image)) }}" alt="">
                                <small
                                    class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">
                                    EGP {{ $room->price }}
                                    / الليلة</small>
                            </div>
                            <div class="p-4 mt-3">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">{{ $room->name }}</h5>

                                    <h5 class="mb-0">{{ $room->area }} م </h5>

                                </div>
                                <div class="d-flex mb-3" style="margin-right: 20%">
                                    <small><i class="fa fa-bed text-primary me-2"></i> {{ $room->capacity }} سرير
                                    </small>
                                    <small class="border-end me-3"><i class="fa fa-bath text-primary me-2"></i> 1
                                        حمام</small>
                                    <small class="border-end me-3"><i class="fa fa-wifi text-primary me-2"></i>
                                        متاح</small>
                                </div>
                                <p class="text-body mb-3 text-center">{{ $room->description }}</p>
                                <div class="d-flex justify-content-between">
{{--                                    <a class="btn btn-sm btn-success rounded py-2 px-4"--}}
{{--                                       href="{{ route('room.details', ['id' => $room->id]) }}">التفاصيل</a>--}}

                                    <button class="btn btn-sm btn-primary rounded py-2 px-4 mediaButton"
                                            data-bs-toggle="modal" data-bs-target="#mediaModal_{{ $room->id }}"> تصفح
                                        الغرفة
                                    </button>

                                    <!-- Add this button where you want to trigger the modal -->
                                    @if($room->available_count > 1)
                                        <a class="btn btn-sm btn-dark targetButton rounded py-2 px-4" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#bookingModal" data-room-id="{{ $room->id }}">احجز الان</a>
                                    @endif
                                    <!-- The modal structure -->
                                    <div class="modal fade" id="bookingModal" tabindex="-1"
                                         aria-labelledby="bookingModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="bookingModalLabel">احجز الغرفة</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Your booking form goes here -->
                                                    <form id="bookingForm">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="check_in" class="form-label ">تاريخ
                                                                        الوصول</label>
                                                                    <input type="date" class="form-control"
                                                                           id="check_in" name="check_in" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="check_out" class="form-label">تاريخ
                                                                        المغادرة</label>
                                                                    <input type="date" class="form-control"
                                                                           id="check_out" name="check_out" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 d-flex justify-content-between">
                                                            <label for="" class="form-label">EGP{{$room->price}} - السعر
                                                                في اليوم</label>
                                                            <label for="modalTitle" id="modalTitle" class="form-label">EGP
                                                                0 - السعر الكلي</label>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cardholder_name" class="form-label">اسم صاحب
                                                                الكارت</label>
                                                            <input type="text" class="form-control" id="cardholder_name"
                                                                   required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="card_number" class="form-label">رقم
                                                                الكارت</label>
                                                            <input type="text" class="form-control" id="card_number"
                                                                   required>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="expiryMonth" class="form-label">تاريخ
                                                                        انتهاء الصلاحية - الشهر</label>
                                                                    <input type="text" class="form-control"
                                                                           id="expiryMonth" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="expiryYear" class="form-label">تاريخ
                                                                        انتهاء الصلاحية - السنة</label>
                                                                    <input type="text" class="form-control"
                                                                           id="expiryYear">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="payment_status" value="visa">
                                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                        <input type="hidden" name="room_id" id="selectedRoomId"
                                                               value="">
                                                        <button type="submit" class="btn btn-primary">حجز الغرفة
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3 class="text-center">لا يوجد غرف متاحة</h3>
                @endforelse

                <!-- The modal structure for room media -->
                <div class="modal fade" id="mediaModal_{{ $room->id }}" tabindex="-1"
                     aria-labelledby="mediaModalLabel_{{ $room->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediaModalLabel_{{ $room->id }}">
                                    تفاصيل الغرفة
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body max-height-50">
                                <!-- Bootstrap Carousel for images -->
                                <div id="mediaCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($room->media as $key => $media)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <img src="{{ asset(Storage::url($media->image)) }}"
                                                     class="d-block w-100 h-100" alt="Room Image">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#mediaCarousel" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#mediaCarousel" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End of media modal -->
            </div>
        </div>
    </div>
    <!-- Room End -->
    <!-- Testimonial Start -->
    <div class="container-xxl testimonial mt-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s"
         style="margin-bottom: 90px;">
        <div class="container">
            <div class="owl-carousel testimonial-carousel py-5">
                @foreach($rates as $rate)
                    <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                        <p>{{ $rate->comment }}</p>
                        <div class="d-flex align-items-center flex-row-reverse">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('admin/logo/user.avif') }}"
                                 style="width: 45px; height: 45px;">
                            <div class="pe-3">
                                <h6 class="fw-bold mb-1">{{ $rate->user->name }}</h6>
                                <small>مستخدم مميز</small>
                            </div>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary position-absolute start-0 bottom-0 ms-4 mb-n1"></i>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection


@section('custom-script')
    <script>
        // JavaScript to capture the selected room ID
        $('.targetButton').on('click', function () {
            var roomId = $(this).data('room-id');
            console.log(roomId);
            $('#selectedRoomId').val(roomId);
        });

        // JavaScript to handle form submission
        $('#bookingForm').submit(function (event) {
            event.preventDefault();

            // Ajax request to handle form submission
            $.ajax({
                type: 'POST',
                url: '{{ route('booking.store') }}', // Replace with your actual route
                data: $(this).serialize(),
                success: function (response) {
                    // Handle success (e.g., show a success message, close the modal, etc.)
                    $('#bookingModal').modal('hide');
                },
                error: function (error) {
                    // Handle error (e.g., show an error message)
                    console.log(error);
                }
            });
        });

        // Function to calculate the total price and update the modal title
        function updateTotalPrice() {
            var checkInDate = new Date(document.getElementById('check_in').value);
            var checkOutDate = new Date(document.getElementById('check_out').value);

            // Calculate the difference in days
            var timeDifference = checkOutDate.getTime() - checkInDate.getTime();
            var daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

            // Get the room price
            var roomPrice = {{ $room->price ?? 0 }};

            // Calculate the total price
            var totalPrice = daysDifference * roomPrice;

            // Update the modal title
            document.getElementById('modalTitle').innerText = `EGP${totalPrice} - السعر الكلي`;
        }

        // Attach the function to the change event of the check-out input
        document.getElementById('check_out').addEventListener('change', updateTotalPrice);
    </script>

    <script>
        // JavaScript to capture the selected room ID
        $('.targetButton').on('click', function () {
            var roomId = $(this).data('room-id');
            console.log(roomId);
            $('#selectedRoomId').val(roomId);
        });

        // JavaScript to handle form submission
        $('#bookingForm').submit(function (event) {
            event.preventDefault();

            // Ajax request to handle form submission
            $.ajax({
                type: 'POST',
                url: '{{ route('booking.store') }}', // Replace with your actual route
                data: $(this).serialize(),
                success: function (response) {
                    // Handle success (e.g., show a success message, close the modal, etc.)
                    $('#bookingModal').modal('hide');
                },
                error: function (error) {
                    // Handle error (e.g., show an error message)
                    console.log(error);
                }
            });
        });


        // JavaScript to handle media modal
        function openMediaModal(roomId) {
            $('#mediaModal_' + roomId).modal('show');
        }

        // Attach the function to the click event of the room media button
        $('.mediaButton').on('click', function () {
            var roomId = $(this).data('room-id');
            openMediaModal(roomId);
        });
    </script>
@endsection
