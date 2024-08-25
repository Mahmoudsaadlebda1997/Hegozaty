@extends('site.layout')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('site/img/about3.jpeg') }}" alt="Electronics Image 1">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">الأجهزة الإلكترونية</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">استكشف أحدث الأجهزة الإلكترونية</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('site/img/about5.jpeg') }}" alt="Electronics Image 2">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">أفضل العروض</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">احصل على أفضل العروض على الأجهزة الإلكترونية</h1>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">السابق</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
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
                    <h1 class="mb-4">اهلا بك في <span class="text-primary text-uppercase">Point E-Commerce</span></h1>
                    <p class="mb-4">نقدم لك أفضل تجربة تسوق عبر الإنترنت مع مجموعة واسعة من المنتجات والخدمات عالية الجودة. اكتشف الآن وكن جزءًا من تجربة تسوق مميزة وسهلة.</p>
                    <div class="row g-3 pb-4">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-boxes fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">5000</h2>
                                    <p class="mb-0">منتج</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">3000</h2>
                                    <p class="mb-0">عملاء</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-truck fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1500</h2>
                                    <p class="mb-0">شحنة</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s"
                                 src="{{ asset('site/img/about4.png') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s"
                                 src="{{ asset('site/img/about5.jpeg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s"
                                 src="{{ asset('site/img/about2.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s"
                                 src="{{ asset('site/img/about3.jpeg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Products Start -->
    <div class="container-xxl py-5" id="products" dir="rtl">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">منتجاتنا</h6>
                <h1 class="mb-5">اكتشف <span class="text-primary text-uppercase">المنتجات</span></h1>
            </div>
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 + $loop->index * 0.1 }}s">
                        <div class="product-item shadow rounded overflow-hidden text-center">
                            <div class="image-wrapper d-flex justify-content-center align-items-center">
                                @isset($product->media()->first()->image)
                                <img class="img-fluid" src="{{ asset('storage/' . $product->media()->first()->image) ?? null }}" alt="{{ $product->name }}" style="max-width: 100%; height: 200px; object-fit: cover;">
                           @endisset
                            </div>
                            <div class="p-4 mt-2">
                                <div class=" align-items-center">
                                    <h5 class="mb-0">{{ $product->name }}</h5>
                                </div>
                                    <span class="text-primary fs-5">${{ $product->price }}</span>
                                <p class="text-body mb-3">{{ $product->description }}</p>
                                <div class="d-flex justify-content-center" style="gap: 10px;">
                                    <button class="btn btn-primary add-to-cart-btn"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->price }}"
                                            style="margin-right: 10px;">
                                        إضافة إلى السلة
                                    </button>
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ route('product.details', ['product' => $product->id]) }}">
                                        التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Products End -->

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
            document.addEventListener('DOMContentLoaded', function() {
                function showSuccessToast() {
                    var toastEl = document.getElementById('success-toast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }

                document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.dataset.id;
                        const productName = this.dataset.name;
                        const productPrice = this.dataset.price;

                        fetch('/cart/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                id: productId,
                                name: productName,
                                price: productPrice
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update the cart count in the navbar
                                    document.querySelector('.cart-count').textContent = data.cartCount;

                                    // Optionally, show a success message
                                    showSuccessToast();
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('حدث خطأ أثناء إضافة المنتج إلى السلة.');
                            });
                    });
                });
            });

















            // Handle the click event of the Rate button
            $('.btn-success[data-bs-target="#ratingModal"]').on('click', function () {
                var hotelId = $(this).data('hotel-id'); // Update this line
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
                        location.reload();
                    },
                    error: function (error) {
                        // Handle error (e.g., show an error message)
                        alert('هناك مشكله في التقييم.');
                    }
                });
        });
    </script>

@endsection


