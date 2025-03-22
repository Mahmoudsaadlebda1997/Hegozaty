@extends('site.layout')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('site/img/about3.jpeg') }}" alt="Hegozaty System">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h1 class="display-3 text-white mb-4 animated slideInDown">مرحبا بك في نظام بنك الدلتا</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Hegozaty Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-4">عن <span class="text-primary text-uppercase">بنك الدلتا</span></h1>
                    <p class="mb-4">
                        نظام بنك الدلتا هو الحل الأمثل لإدارة وحجز الخدمات المصرفية بسهولة وأمان.
                        يقدم تجربة سلسة للمستخدمين لحجز مواعيدهم دون عناء.
                    </p>
                </div>
                <div class="col-lg-6 text-center">
                    <img class="img-fluid rounded w-75" src="{{ asset('site/img/about4.webp') }}">
                </div>
            </div>
        </div>
    </div>
    <!-- About Hegozaty End -->

    <!-- Our Services Start -->
    <div class="container-xxl py-5" id="services">
        <div class="container">
            <div class="text-center">
                <h1 class="mb-5">خدماتنا</h1>
            </div>
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="service-item p-3 border rounded shadow-sm text-center transition-all duration-300 hover:shadow-lg">
                            <!-- Service Image -->
                            <div class="overflow-hidden rounded">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="img-fluid w-100" style="height: 180px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('site/img/default-service.png') }}" alt="{{ $service->name }}" class="img-fluid w-100" style="height: 180px; object-fit: cover;">
                                @endif
                            </div>

                            <!-- Service Info -->
                            <div class="mt-3">
                                <h5 class="fw-bold">{{ $service->name }}</h5>

                                @if($service->service_type === 'phone_banking')
                                    <span class="badge bg-primary">خدمة هاتفية مصرفية</span>
                                @elseif($service->service_type === 'branch')
                                    <span class="badge bg-success">خدمة من الفرع</span>
                                @else
                                    <span class="badge bg-secondary">غير محدد</span>
                                @endif

                                <p class="text-muted small mb-0">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Our Services End -->

    <!-- Reservation Form Start -->
    @auth
        <div class="container-xxl py-5" id="reservation">
            <div class="container">
                <div class="text-center">
                    <h1 class="mb-5">احجز موعدك الآن</h1>
                </div>
                <form method="POST" action="{{ route('reservation.create') }}" id="reservation-form">
                    @csrf
                    <div class="row g-3">
                        <!-- Service -->
                        <div class="col-md-6">
                            <label for="service_id" class="form-label">اختر الخدمة</label>
                            <select name="service_id" id="service_id" class="form-control" required>
                                <option value="">اختر الخدمة</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-type="{{ $service->service_type }}">
                                        {{ $service->name }}
                                        @if($service->service_type === 'phone_banking')
                                            {{ __('(خدمة هاتفية مصرفية)') }}
                                        @elseif($service->service_type === 'branch')
                                            {{ __('(من الفرع)') }}
                                        @else
                                            {{ __('(غير محدد)') }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- User (Hidden) -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <!-- Day Selection -->
                        <div class="col-md-6" id="day-selection" style="display: none;">
                            <label for="day_out" class="form-label">اختر اليوم</label>
                            <input type="date" id="day_out" name="reservation_date" class="form-control">
                        </div>

                        <!-- Success Message -->
                        <div class="col-md-12" id="success-message" style="display: none;">
                            <div class="alert alert-success">
                                ✅ تم إرسال الحجز بنجاح. سيتم الاتصال بك قريبًا.
                                <button type="button" class="btn-close float-end" onclick="hideSuccessMessage()"></button>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div class="col-md-12" id="error-message" style="display: none;">
                            <div class="alert alert-danger">
                                ❌ حدث خطأ أثناء تقديم الحجز. حاول مرة أخرى.
                                <button type="button" class="btn-close float-end" onclick="hideErrorMessage()"></button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 text-center" id="submitButton">
                            <button type="submit" class="btn btn-primary px-5 py-2">إرسال الحجز</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <!-- If not authenticated, show a message -->
        <div class="container-xxl py-5">
            <div class="container text-center">
                <p style="color: #000; font-size: 18px;">
                    يرجى
                    <a href="{{ route('loginUser') }}" style="color: #ff8c00; text-decoration: none; font-weight: bold;">
                        تسجيل الدخول
                    </a>
                    لإجراء حجز.
                </p>
            </div>
        </div>

    @endauth
    <!-- Reservation Form End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 بنك الدلتا. جميع الحقوق محفوظة.</p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const isAuth = @json(auth()->check()); // Pass auth status from backend
            const serviceSelect = document.getElementById('service_id');
            const daySelection = document.getElementById('day-selection');
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            const submitButton = document.getElementById('submitButton');
            const form = document.getElementById('reservation-form');
            const dayOutInput = daySelection.querySelector('input');

            // ✅ Only run the script if user is authenticated
            if (isAuth) {
                // ✅ Show day selection only for branch services
                serviceSelect.addEventListener('change', () => {
                    const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                    const serviceType = selectedOption.getAttribute('data-type');

                    daySelection.style.display = (serviceType === 'branch') ? 'block' : 'none';

                    // ✅ Reset value when switching service type
                    if (serviceType !== 'branch') {
                        dayOutInput.value = '';
                    }
                });

                // ✅ Disable Friday and Saturday in date picker
                dayOutInput.addEventListener('input', (e) => {
                    const day = new Date(e.target.value).getDay();
                    if (day === 5 || day === 6) {
                        dayOutInput.setCustomValidity('الحجز غير متاح يوم الجمعة أو السبت.');
                        dayOutInput.reportValidity();
                    } else {
                        dayOutInput.setCustomValidity('');
                    }
                });

                // ✅ Form submit using AJAX
                form.addEventListener('submit', async (e) => {
                    e.preventDefault(); // Prevent page reload

                    const formData = new FormData(form);
                    const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                    const serviceType = selectedOption.getAttribute('data-type');

                    // ✅ Validation for branch service requiring day selection
                    if (serviceType === 'branch' && !dayOutInput.value) {
                        alert('الرجاء اختيار اليوم للخدمة من الفرع.');
                        return;
                    }

                    try {
                        submitButton.disabled = true;
                        submitButton.innerHTML = 'جاري الإرسال...';

                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        });

                        if (response.ok) {
                            successMessage.style.display = 'block';
                            errorMessage.style.display = 'none';
                            submitButton.style.display = 'none';
                            // ✅ Reset form after successful submission
                            form.reset();
                            daySelection.style.display = 'none';
                        } else {
                            const errorData = await response.json();
                            showError(errorData.message || 'حدث خطأ أثناء تقديم الحجز.');
                        }
                    } catch (error) {
                        showError('حدث خطأ أثناء تقديم الحجز.');
                    } finally {
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'إرسال الحجز';
                    }
                });

                // ✅ Hide success message
                window.hideSuccessMessage = () => {
                    successMessage.style.display = 'none';
                };

                // ✅ Hide error message
                window.hideErrorMessage = () => {
                    errorMessage.style.display = 'none';
                };

                // ✅ Show error message
                function showError(message) {
                    errorMessage.querySelector('.alert-danger').innerHTML = `❌ ${message}`;
                    errorMessage.style.display = 'block';
                    successMessage.style.display = 'none';
                }
            }
        });
    </script>



@endsection
