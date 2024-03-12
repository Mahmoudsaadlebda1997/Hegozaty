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
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">الغرف</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Room Details Start -->
    <div class="container-xxl py-5">
        <div class="container text-center">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">تفاصيل الغرفة</h6>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="p-4 mt-3">
                            <div class="d-flex justify-content-center mb-3">
                                <h5 class="mb-0">{{ $room->name }}</h5>
                            </div>
                            <div class="d-flex justify-content-center mb-3">
                                <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{ $room->capacity }} سرير - </small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>1 حمام</small>
                                <small><i class="fa fa-wifi text-primary me-2"></i>Available</small>
                            </div>
                            <p class="text-body mb-3">  الوصف - {{ $room->description }}  </p>
                            <p class="text-body mb-3">EGP  السعر -  {{ $room->price }} </p>
                            <p class="text-body mb-3"> الغرف المتاحه - {{ $room->available_count }}</p>
                            <p class="text-body mb-3"> المساحه - {{ $room->area }} </p>
                            <p class="text-body mb-3"> الفندق - {{ $room->hotel->name }}    </p>

                            <!-- Button to open the media modal -->
                            <button class="btn btn-sm btn-primary rounded py-2 px-4 mediaButton"
                                    data-bs-toggle="modal" data-bs-target="#mediaModal_{{ $room->id }}">عرض الصور والفيديوهات
                            </button>

                            <!-- The modal structure for room media -->
                            <div class="modal fade" id="mediaModal_{{ $room->id }}" tabindex="-1"
                                 aria-labelledby="mediaModalLabel_{{ $room->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mediaModalLabel_{{ $room->id }}">صور وفيديوهات الغرفة</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body max-height-50">
                                            <!-- Bootstrap Carousel for images -->
                                            <div id="mediaCarousel" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($room->media as $key => $media)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset(Storage::url($media->image)) }}" class="d-block w-100 h-100" alt="Room Image">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#mediaCarousel" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#mediaCarousel" role="button" data-slide="next">
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
            </div>
        </div>
    </div>
    <!-- Room Details End -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
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
