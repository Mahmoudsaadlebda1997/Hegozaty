<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Rules\SiteTypeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('site.home', compact('products'));
    }

    // عرض صفحة تسجيل الدخول المستخدم
    public function showUserLoginForm()
    {
        return view('site.login');
    }

    // Login function
    public function loginUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => ['required', 'email', new SiteTypeEmail],
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
//        dd($credentials);
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended(route('mainSite'))->with('success', 'تم تسجيل الدخول بنجاح');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'بيانات خاطئة'])->withInput($request->only('email'));
    }

    // Log the user out
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/loginUser')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    // عرض صفحة تسجيل الدخول للمستخدم
    public function showRegistrationForm()
    {
        return view('site.register');
    }

    public function storeUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|unique:users,phone_number',
            'role' => 'required',
        ]);
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
        ]);
        return redirect()->route('mainSite')->with('success', 'تم تسجيل العضوية بنجاح.');
    }

    public function showDetails(Product $product)
    {
        $rates = Rate::where('product_id', $product->id)->get();
        return view('site.details', compact('product', 'rates'));
    }


    public function showRoomDetails($id)
    {
        $product = Product::findOrFail($id);

        return view('site.details', compact('product'));
    }

    public function myOrders()
    {
        $orders = auth()->user()->orders()->paginate(5);
        return view('site.orders', compact('orders'));
    }

    public function destroyOrder($id)
    {
        $order = Order::find($id);

        // Check if the reservation belongs to the authenticated user
        if (auth()->user()->id === $order->user_id) {
            $order->delete();
        }

        return redirect()->route('myOrders')->with('success', 'تم الغاء الاوردر');
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;
        $product = [
            "name" => $request->name,
            "quantity" => 1,
            "price" => $request->price,
        ];

        // If product already exists in cart, increment the quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = $product;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cartCount' => count($cart),
        ]);
    }

    public function indexCart()
    {
        $cartItems = session()->get('cart', []);
        return view('site.cart.index', compact('cartItems'));
    }
    // Remove an Item from the Cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'تم مسح المنتج بنجاح.');
    }

//    Create Order
    public function createOrder(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('cart.index')->withErrors(['message' => 'يرجي تسجيل الدخول لاتمام عمليه الشراء.']);
        }

        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->withErrors(['message' => 'سله مشترياتك فارغه.']);
        }

        // Create the order
        $order = Order::create([
            'total_price' => array_sum(array_column($cartItems, 'price')) * array_sum(array_column($cartItems, 'quantity')),
            'status' => 'pending',
            'pay_type' => $request->pay_type,
            'user_id' => $user->id,
        ]);

        // Add order items
        foreach ($cartItems as $id => $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
            ]);
        }

        // Clear the cart
        $request->session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'تم عمل الاوردر بنجاح سيتم التواصل معك قريبا ');
    }
}
