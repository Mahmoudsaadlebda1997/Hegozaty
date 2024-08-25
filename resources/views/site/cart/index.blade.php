@extends('site.layout')

@section('content')
    <div class="container" dir="rtl">
        <h2 class="text-right">سلة المشتريات</h2>
        @if(count($cartItems) > 0)
            <table class="table text-right">
                <thead>
                <tr>
                    <th>اسم المنتج</th>
                    <th>العدد</th>
                    <th>السعر</th>
                    <th>السعر الإجمالي</th>
                    <th>الإجراء</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ $item['price'] }}</td>
                        <td>${{ $item['price'] * $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">مسح</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h4 class="text-right">المجموع: ${{ array_sum(array_column($cartItems, 'price')) }}</h4>
            @auth
                <form action="{{ route('order.create') }}" method="POST" dir="rtl">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fs-5 d-block text-right">طريقة الدفع</label>
                        <div class="form-check mb-2 text-right">
                            <input class="form-check-input" type="radio" name="pay_type" id="cash_on_delivery" value="cash_on_delivery" style="transform: scale(1.2);" required>
                            <label class="form-check-label mr-4 fs-6" for="cash_on_delivery">
                                دفع عند الاستلام
                            </label>
                        </div>
                        <div class="form-check mb-2 text-right">
                            <input class="form-check-input" type="radio" name="pay_type" id="vodafone_cash" value="vodafone_cash" style="transform: scale(1.2);" required>
                            <label class="form-check-label mr-4 fs-6" for="vodafone_cash">
                                فودافون كاش
                            </label>
                        </div>
                        <div class="form-check mb-2 text-right">
                            <input class="form-check-input" type="radio" name="pay_type" id="instapay" value="instapay" style="transform: scale(1.2);" required>
                            <label class="form-check-label mr-4 fs-6" for="instapay">
                                انستا باي
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary fs-5 d-block mx-auto">إجراء الطلب</button>
                </form>
            @else
                <p class="text-center fs-3">يرجى تسجيل الدخول لإجراء الطلب.</p>
            @endauth
        @else
            <p class="text-center fs-3">سلة مشترياتك فارغة.</p>
        @endif
    </div>
@endsection
