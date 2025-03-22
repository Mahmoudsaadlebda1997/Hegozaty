<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <title>بنك الدلتا</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('site/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('site/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('site/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Heebo', sans-serif;
            background-color: #f8f9fa;
        }

        /* Header Styling */
        .header {
            background-color: #0d213f;
            padding: 15px 0;
        }

        .header h4 {
            color: #ffc107;
            font-weight: 600;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #0d213f;
        }

        .navbar a {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
        }

        .navbar a:hover {
            color: #ffc107;
        }

        /* Footer Styling */
        .footer {
            background-color: #0d213f;
            color: #fff;
            padding: 40px 0;
        }

        .footer a {
            color: #ffc107;
        }

        .breadcrumb {
            background: none !important;
        }
    </style>
</head>

<body>

<!-- Spinner Start -->
<div id="spinner"
     class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->



<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4 shadow-sm" style="font-size: 1.25rem; height: 80px;">
    <div class="container">
        <!-- Logo -->
        <a href="/" class="navbar-brand d-flex align-items-center">
            <h4 class="m-0" style="color: #ffc107; font-size: 1.75rem; font-weight: 700;">بنك الدلتا</h4>
        </a>

        <!-- Toggler Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="/#" class="nav-item nav-link active px-4 fw-semibold" style="transition: color 0.3s ease;">الرئيسية</a>
                <a href="/#services" class="nav-item nav-link px-4 fw-semibold" style="transition: color 0.3s ease;">خدماتنا</a>
                <a href="/#about" class="nav-item nav-link px-4 fw-semibold" style="transition: color 0.3s ease;">من نحن</a>

                @auth
                    <a href="{{ route('myReservations') }}" class="nav-item nav-link px-4 text-white fw-semibold"
                       style="transition: color 0.3s ease;">بنك الدلتا</a>
                    <a href="{{ route('logoutUser') }}" class="nav-item nav-link px-4 text-danger fw-semibold"
                       style="transition: color 0.3s ease;">تسجيل الخروج</a>
                @endauth

            @guest
                    <a href="{{ route('loginUser') }}" class="nav-item nav-link px-4 fw-semibold"
                       style="transition: color 0.3s ease;">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="nav-item nav-link px-4 fw-semibold"
                       style="transition: color 0.3s ease;">تسجيل عضوية</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->



@yield('content')

<!-- Footer Start -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="text-uppercase mb-3 text-white">حول التطبيق</h5>
                <p>
                    تطبيق بنك الدلتا يقدم خدمات مصرفية متميزة وسريعة لعملائنا، مع ضمان الأمان وسهولة الاستخدام.
                </p>
            </div>
            <div class="col-lg-4 mb-4">
                <h5 class="text-uppercase mb-3 text-white">التواصل</h5>
                <p><i class="fa fa-map-marker-alt me-2"></i> القاهرة، مصر</p>
                <p><i class="fa fa-phone-alt me-2"></i> +20 100 000 0000</p>
                <p><i class="fa fa-envelope me-2"></i> info@hegozaty.com</p>
            </div>
            <div class="col-lg-4">
                <h5 class="text-uppercase mb-3 text-white">روابط سريعة</h5>
                <a href="/#about" class="btn btn-link">عن التطبيق</a>
                <a href="/#services" class="btn btn-link">خدماتنا</a>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="{{ asset('site/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('site/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('site/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('site/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('site/js/main.js') }}"></script>

@yield('custom-script')

</body>

</html>
