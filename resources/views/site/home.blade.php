@extends('site.layout')
@section('content')



    <!-- Header Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
            <div class="col-lg-3 bg-dark d-none d-lg-block">
                <a href="/" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h4 class="m-0 text-primary text-uppercase">Mansoura Booking</h4>
                </a>
            </div>
            <div class="col-lg-9">
                <div class="row gx-0 bg-white d-none d-lg-flex">
                    <div class="col-lg-7 px-5 text-start">
                        <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                            <i class="fa fa-envelope text-primary me-2"></i>
                            <p class="mb-0">info@example.com</p>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center py-2">
                            <i class="fa fa-phone-alt text-primary me-2"></i>
                            <p class="mb-0">+012 345 6789</p>
                        </div>
                    </div>
                    <div class="col-lg-5 px-5 text-end">
                        <div class="d-inline-flex align-items-center py-2">
                            <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                            <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                            <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                            <a class="" href=""><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0" style="margin-left: 40%">
                    <a href="/" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 text-primary text-uppercase">Mansoura Booking</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                            data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="#" class="nav-item nav-link active">الرئيسية</a>
                            <a href="#about" class="nav-item nav-link">من نحن</a>
                            <a href="#hotels" class="nav-item nav-link">الفنادق</a>
                        @auth
                            <a href="{{ route('myReservations') }}" class="nav-item nav-link">حجوزاتي</a>
                                <a href="{{ route('logoutUser') }}" class="nav-item nav-link">تسجيل الخروج</a>
                            @endauth
                            @guest
                                <a href="{{ route('loginUser') }}" class="nav-item nav-link">تسجيل الدخول</a>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('site/img/carousel-1.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">المعيشة
                                الفاخرة</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">اكتشف فندقًا فاخرًا ذو علامة
                                تجارية</h1>
                            <a href="#hotels"
                               class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft text-bold">فنادقنا</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('site/img/carousel-2.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">الحياه
                                المرفهه</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">اكتشف فندقًا مرفه ذو علامة
                                مشهوره</h1>
                            <a href="#hotels"
                               class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft text-bold">فنادقنا</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">السابق</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">التالي</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="section-title text-start text-primary text-uppercase">من نحن</h6>
                    <h1 class="mb-4">اهلا بك في <span class="text-primary text-uppercase">Mansoura Booking</span></h1>
                    <p class="mb-4">نقدم لك افضل فنادق المنصورة وحجز افضل الغرف بكل سهولة بافضل واشمل الخدمات</p>
                    <div class="row g-3 pb-4">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">854</h2>
                                    <p class="mb-0">غرفة</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                    <p class="mb-0">طاقم</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">4512</h2>
                                    <p class="mb-0">عميل</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s"
                                 src="{{ asset('site/img/about-1.jpg') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s"
                                 src="{{ asset('site/img/about-2.jpg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s"
                                 src="{{ asset('site/img/about-3.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s"
                                 src="{{ asset('site/img/about-2.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Hotels Start -->
    <div class="container-xxl py-5" id="hotels">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">فنادقنا</h6>
                <h1 class="mb-5">اكتشف <span class="text-primary text-uppercase">الفنادق</span></h1>
            </div>
            <div class="row g-4">
                @foreach($hotels as $hotel)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->name }}">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $hotel->name }}</h5>
                                    <div class="ps-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $hotel->rating)
                                                <small class="fa fa-star text-primary"></small>
                                            @else
                                                <small class="far fa-star text-primary"></small>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-body mb-3">{{ $hotel->description }}</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ route('hotel.details', ['hotel' => $hotel->id]) }}">التفاصيل</a>
                                    <button class="btn btn-sm btn-primary rounded py-2 px-4" data-bs-toggle="modal" data-bs-target="#ratingModal" data-hotel-id="{{ $hotel->id }}">قيم الفندق</button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Modal for Rating and Comment -->
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">التقييم و التعليق</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm">
                        @csrf
                        <div class="mb-3">
                            <label for="rating">التقييم</label>
                            <select class="form-select" id="rating" name="rating">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment">التعليق</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <input type="hidden" id="hotelId" name="hotelId">
                        <input type="hidden" id="userId" name="userId" value="{{ auth()->id() }}">
                        <button type="button" class="btn btn-primary" id="saveRating">احفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Hotels End -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle the click event of the Rate button
            $('.btn-primary[data-bs-target="#ratingModal"]').on('click', function () {
                var hotelId = $(this).data('hotel-id');
                $('#hotelId').val(hotelId);
            });

            // Handle the click event of the Save button inside the modal
            $('#saveRating').on('click', function () {
                // Include CSRF token in the headers
                var headers = {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                };

                var formData = $('#ratingForm').serialize();

                $.ajax({
                    url: '{{ route("save.rating") }}', // Replace with your route for saving ratings
                    type: 'POST',
                    data: formData,
                    headers: headers, // Include CSRF token in the headers
                    success: function (response) {
                        // Handle success (e.g., close modal, show a message)
                        $('#ratingModal').modal('hide');
                        location.reload(); // Corrected line
                    },
                    error: function (error) {
                        // Handle error (e.g., show an error message)
                        alert('هناك مشكله في التقييم.');
                    }
                });
            });
        });
    </script>

@endsection


