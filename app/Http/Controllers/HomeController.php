<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
    public function redirect(){
        $usertype = Auth::user()->usertype;

        if($usertype == '1'){
            return view('admin.home');
        }else{
            $data = product::paginate(3);

            $user=auth()->user();
            
            $cart=cart::where('phone',$user->phone)->get();

            $count=cart::where('phone',$user->phone)->count();
            
            return view('user.home', compact('data', 'count', 'cart'));
        }
    }

    public function index(){

        if(Auth::id()){
            return redirect('redirect');
        }else{
            $data = product::paginate(3);

            return view('user.home', compact('data'));
        }

    }

    public function search(Request $request){
        $search=$request->search;

        if($search==''){
            $data = product::paginate(3);
            $user=auth()->user();
            
            $cart=cart::where('phone',$user->phone)->get();

            $count=cart::where('phone',$user->phone)->count();
            return view('user.home', compact('data', 'count', 'cart'));            
        }

        $user=auth()->user();
            
        $cart=cart::where('phone',$user->phone)->get();

        $count=cart::where('phone',$user->phone)->count();

        $data=product::where('title','Like', '%'.$search.'%')->get();

        return view('user.home', compact('data', 'count', 'cart'));
    }

    public function product_detail($id){

        if(!Auth::id()){
            $product = product::find($id);
            return view('user.product_detail', compact('product'));
        }
        else{
            $product = product::find($id);
            $user=auth()->user();

            $cart=cart::where('phone',$user->phone)->get();

            $count=cart::where('phone',$user->phone)->count();

            return view('user.product_detail', compact('product' , 'count' , 'cart'));
        }
        

    }

    public function addcart(Request $request, $id){
        if(Auth::id()){
            $user = auth()->user();

            $product = product::find($id);

            $cart = new cart;

            $cart->name=$user->name;
            $cart->phone=$user->phone;
            $cart->address=$user->address;

            $cart->product_title=$product->title;
            $cart->price=$product->price;
            $cart->quantity=$request->quantity;

            $totalprice = (($cart->price=$product->price)*($cart->quantity=$request->quantity));

            $cart->totalprice=$totalprice;


            $cart->save();

            return redirect()->back()->with('message', 'Product Added Successfully');
        }
        else{
            return redirect('login');
        }
    }

    public function showcart(){
        $user=auth()->user();

        $cart=cart::where('phone',$user->phone)->get();

        $count=cart::where('phone',$user->phone)->count();

        return view('user.showcart', compact('count', 'cart'));
    }

    public function deletecart($id){
        $data = cart::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Product Revomed Successfully');
    }

    public function confirmorder(Request $request){
        $user=auth()->user();

        $name = $user->name; 
        $phone = $user->phone; 
        $address = $user->address; 

        foreach($request->productname as $key=>$productname){
            $order = new order;

            $order->product_name=$request->productname[$key];
            $order->price=$request->price[$key];
            $order->quantity=$request->quantity[$key];


            $totalprice = (($order->price=$request->price[$key])*($order->quantity=$request->quantity[$key]));

            $order->totalprice=$totalprice;



            $order->name = $name; 
            $order->phone = $phone; 
            $order->address = $address; 
            
            $order->status = 'not delivered'; 


            $order->save();

        }       
    
        DB::table('carts')->where('phone', $phone)->delete();
        return redirect('thankyou');
    
    
    }


    public function thankyou(){
        if(Auth::id()){
            $user=auth()->user();

            $cart=cart::where('phone',$user->phone)->get();

            $count=cart::where('phone',$user->phone)->count();

            return view('user.thankyou', compact('count' , 'cart'));
        }
        else{
            return redirect('login');
        }
        
    }

    public function myorders(){
        if(Auth::id()){
            $user=auth()->user();

            $cart=cart::where('phone',$user->phone)->get();

            $count=cart::where('phone',$user->phone)->count();

            $order=order::where('phone',$user->phone)->get();

            $orders=order::where('phone',$user->phone)->count();

            return view('user.myorders', compact('order' , 'count' , 'cart' , 'orders'));
        }
        else{
            return redirect('login');
        }

    }

    




}
