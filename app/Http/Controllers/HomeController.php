<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\products;
use App\Models\Cart;
use App\Models\Order;


use Session;
use Stripe;

class HomeController extends Controller
{
    //route the user to the website page
    public function index()
    {
        $products = products::paginate(10);
        return view('home.userpage', compact('products'));
    }

    //redirect user to the corresponding view due to his type
    public function redirect()
    {
        $userType = Auth::user()->usertype;

        if ($userType == '1')
        {
            return view('admin.home');
        }
        else
        {
            $products = products::paginate(10);
            return view('home.userpage', compact('products'));        }
    }

    //Display product details
    public function product_details($id){
        $product = products::find($id);
        return view('home.product_details', compact('product'));
    }

    //add products to cart
    public function add_cart(Request $request, $id){
        if(Auth::id()){

            $user = Auth::user();
            $product = products::find($id);
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;

            if($product->discount_price != null){
                $cart->price = $product->discount_price * $request->quantity;
            }
            else {
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image ;
            $cart->product_id = $product->id ;
            $cart->quantity = $request->quantity ;
            $cart->user_id = $user->id;

            $cart->save();

            return redirect()->back();
        }
        else {
            return redirect('login');
        }
    }

    //Show Cart's Products
    public function show_cart(){
        if(Auth::id())
        {
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=' ,$id)->get();
            return view('home.show_cart', compact('carts'));
        }
        else
        {
            return redirect('login');
        }
    }

    //Delete a product from the cart
    public function delete_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
        }

    //Send order to the db
    public function cash_order()
    {
        $user = Auth::user();
        $userID = $user->id;

        $Data = Cart::where('user_id', '=', $userID)->get();

        foreach($Data as $data)
        {
            $order = new Order;
            //User INFO
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            //Product INFO
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->amount = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            //Order Info
            $order->payment_status = 'Cash on Delivery';
            $order->delivery_status = 'Processing';

            $order->save();

            //Delete ordered products from cart table
            $cartID = $data->id;
            $cart = Cart::find($cartID);
            $cart->delete();

        }
        return redirect()->back()->with('msg', 'Thank you for your order!
        We have received your request and are processing it. ');
    }

    public function stripe ($tot_price)
    {
        return view('home.stripe', compact('tot_price'));
    }

    public function stripePost(Request $request, $tot_price)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $tot_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment."
        ]);
        $user = Auth::user();
        $userID = $user->id;

        $Data = Cart::where('user_id', '=', $userID)->get();

        foreach($Data as $data)
        {
            $order = new Order;
            //User INFO
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            //Product INFO
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->amount = $data->price;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            //Order Info
            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';

            $order->save();

            //Delete ordered products from cart table
            $cartID = $data->id;
            $cart = Cart::find($cartID);
            $cart->delete();
        }

        $request->session()->put('success', 'Payment successful!');
        return back();
    }
}
