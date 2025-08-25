<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\{Product, Customer, Order, OrderItem, Category};

class ShopController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);

        return view('shop.home', compact('cart'));
    }

    public function about()
    {
        $cart = Session::get('cart', []);

        return view('shop.about', compact('cart'));
    }

    public function services()
    {
        $cart = Session::get('cart', []);

        return view('shop.services', compact('cart'));
    }

    public function menu(){
        $q = request('q');
        $products = Product::where('active',1)
        ->when($q, fn($r)=>$r->where('name','like',"%$q%"))
        ->orderBy('name')->get();
        $cart = Session::get('cart', []);
        return view('shop.menu', compact('products','cart','q'));
    }

    public function menu2(){
        $q = request('q');
        /*$products = Product::where('active',1)
        ->when($q, fn($r)=>$r->where('name','like',"%$q%"))
        ->orderBy('name')->get();*/

        $products = Product::all();
        
        $cart = Session::get('cart', []);

        $coffee = Category::where('id','=','1')->first();

        $noncoffee = Category::where('id','=','2')->first();

        $mineralwater = Category::where('id','=','3')->first();

        $es = Category::where('id','=','4')->first();

        return view('shop.menunew', compact('products','cart','q','coffee','noncoffee','mineralwater','es'));
    }

    public function categories(Request $request)
    {
        $menu = Product::where('category_id', $request->id)->get();

        return response()->json($menu);
    }

    public function cart(){
        $cart = Session::get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    public function cart2(){
        $cart = Session::get('cart', []);
        return view('shop.cartnew', compact('cart'));
    }

    public function addToCart(Request $request){
        $request->validate(['product_id'=>'required','qty'=>'nullable|integer|min:1']);
        $p = Product::findOrFail($request->product_id);
        $cart = Session::get('cart', []);
        $qty = max(1, (int)$request->qty ?: 1);
        if(isset($cart[$p->id])){ $cart[$p->id]['qty'] += $qty; }
        else { $cart[$p->id] = ['id'=>$p->id,'name'=>$p->name,'price'=>(float)$p->price,'qty'=>$qty]; }
        Session::put('cart', $cart);
        return response()->json(['message'=>'Ditambahkan','cart_count'=>array_sum(array_column($cart,'qty'))]);
    }

    public function updateCart(Request $request){
        $request->validate(['product_id'=>'required','qty'=>'required|integer|min:1']);
        $cart = Session::get('cart', []);
        if(isset($cart[$request->product_id])){
            $cart[$request->product_id]['qty'] = (int)$request->qty;
            Session::put('cart', $cart);
        }
        return response()->json(['message'=>'Keranjang diperbarui']);
    }

    public function removeFromCart(Request $request){
        $request->validate(['product_id'=>'required']);
        $cart = Session::get('cart', []);
        unset($cart[$request->product_id]);
        Session::put('cart', $cart);
        return response()->json(['message'=>'Item dihapus']);
    }

    public function checkout(){
        $cart = Session::get('cart', []);
        if (empty($cart)) { return redirect()->route('shop.menu')->with('error','Keranjang kosong'); }
        return view('shop.checkout', compact('cart'));
    }

    public function checkout2(){
        $cart = Session::get('cart', []);
        if (empty($cart)) { return redirect()->route('shop.menu')->with('error','Keranjang kosong'); }
        return view('shop.checkoutnew', compact('cart'));
    }

    public function processCheckout(Request $request){
        $request->validate(['name'=>'required','phone'=>'required']);
        $cart = Session::get('cart', []);
        if(empty($cart)){ return back()->with('error','Keranjang kosong'); }

        return DB::transaction(function() use ($request,$cart){
            $customer = Customer::firstOrCreate(['phone'=>$request->phone], ['name'=>$request->name, 'email'=>$request->email]);
            $invoice = 'WEB-'.now()->format('Ymd-His').rand(100,999);
            $subtotal = 0; foreach($cart as $it){ $subtotal += $it['price'] * $it['qty']; }
            $order = Order::create([
                'invoice'=>$invoice,
                'customer_id'=>$customer->id,
                'user_id'=>null,
                'subtotal'=>$subtotal,
                'discount'=>0,
                'tax'=>0,
                'total'=>$subtotal,
                'status'=>'pending',
                'channel'=>'web',
            ]);
            foreach($cart as $it){
                OrderItem::create(['order_id'=>$order->id,'product_id'=>$it['id'],'qty'=>$it['qty'],'price'=>$it['price'],'total'=>$it['price']*$it['qty']]);
            }
            Session::forget('cart');
            return redirect()->route('shop.success2', ['invoice'=>$invoice]);
        });
    }

    public function success(){
        $invoice = request('invoice');
        $order = Order::where('invoice', '=', $invoice)
        ->update([
            'channel'=> "web",
        ]);
        $order = Order::where('invoice',$invoice)->firstOrFail();
        return view('shop.success', compact('order'));
    }
    public function success2(){
        $invoice = request('invoice');
        $order = Order::where('invoice', '=', $invoice)
        ->update([
            'channel'=> "web",
        ]);
        $order = Order::where('invoice',$invoice)->firstOrFail();
        return view('shop.successnew', compact('order'));
    }
}
