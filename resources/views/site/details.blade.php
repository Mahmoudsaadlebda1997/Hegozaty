@extends('site.layout')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
         style="background-image: url({{ asset('site/img/about3.jpeg') }});">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">المنتجات</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item text-white active" aria-current="page">المنتجات</li>
                        <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Details Start -->
    <div class="container-xxl py-5">
        <div class="container text-center">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">تفاصيل المنتج</h6>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item shadow rounded overflow-hidden">
                        <div class="p-4 mt-3">
                            <div class="d-flex justify-content-center mb-3">
                                <h5 class="mb-0">{{ $product->name }}</h5>
                            </div>
                            <div class="d-flex justify-content-center mb-3">
                                <small class="border-end me-3 pe-3"><i class="fa fa-tag text-primary me-2"></i>EGP {{ $product->price }}</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-cube text-primary me-2"></i>{{ $product->stock }} متوفر</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-tags text-primary me-2"></i>{{ $product->category->name }}</small>
                            </div>
                            <p class="text-body mb-3">{{ $product->description }}</p>
                            <p class="text-body mb-3">{{ $product->code }}: كود المنتج</p>
                            <p class="text-body mb-3">
                                حاله المنتج :
                                <span class="{{ $product->status == 'available' ? 'text-success' : 'text-danger' }}">
                                    {{ $product->status == 'available' ? 'متوفر' : 'غير متوفر' }}
                                </span>
                            </p>

                            <!-- Button to open the media modal -->
                            <button class="btn btn-sm btn-primary rounded py-2 px-4 mediaButton"
                                    data-bs-toggle="modal" data-bs-target="#mediaModal_{{ $product->id }}">تصفح صور المنتج
                            </button>

                        @if($product->status === 'available')
                            <!-- Add to Cart Button -->
                                <button class="btn btn-primary add-to-cart-btn"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}">
                                    إضافة إلى السلة
                                </button>
                        @endif

                        <!-- The modal structure for product media -->
                            <div class="modal fade" id="mediaModal_{{ $product->id }}" tabindex="-1"
                                 aria-labelledby="mediaModalLabel_{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mediaModalLabel_{{ $product->id }}">
                                                تفاصيل المنتج
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body max-height-50">
                                            <div id="mediaCarousel_{{ $product->id }}" class="carousel slide">
                                                <div class="carousel-inner">
                                                    @foreach($product->media as $key => $media)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset(Storage::url($media->image)) }}"
                                                                 class="d-block w-100 h-100" alt="Product Image">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#mediaCarousel_{{ $product->id }}" role="button"
                                                   data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#mediaCarousel_{{ $product->id }}" role="button"
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
            </div>
        </div>
    </div>
    <!-- Product Details End -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function showSuccessToast() {
                var toastEl = document.getElementById('success-toast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }

            // Add to Cart Button click event
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
                            } else {
                                alert('حدث خطأ أثناء إضافة المنتج إلى السلة.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('حدث خطأ أثناء إضافة المنتج إلى السلة.');
                        });
                });
            });

            // Open Media Modal
            document.querySelectorAll('.mediaButton').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    const modalId = `#mediaModal_${productId}`;
                    const modalEl = document.querySelector(modalId);
                    if (modalEl) {
                        const modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                });
            });
        });
    </script>
@endsection
