<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\{Product, Order, OrderItem, Payment, Customer, StockMovement};
use Midtrans\Snap;
use Midtrans\Config;

class OrderController extends Controller
{
    public function pos(){
        $products = Product::where('active',1)->orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view('orders.pos', compact('products','customers'));
    }

    public function searchProducts(Request $request){
        $term = $request->q;
        $rows = DB::table('products as p')
        ->join('categories as c','c.id','=','p.category_id')
        ->select('p.id','p.name','c.name as category','p.price','p.stock')
        ->where(function($q) use($term){
            $q->where('p.name','like',"%$term%");
        })->where('p.active',1)->limit(20)->get();
        return response()->json($rows);
    }

    public function store(Request $request){
        $request->validate([
            'items'=>'required|array','paid'=>'required|numeric','method'=>'required'
        ]);

        return DB::transaction(function() use ($request){
            $user = Auth::user();
            $invoice = 'INV-'.now()->format('Ymd-His').rand(100,999);

            $subtotal = 0;
            foreach($request->items as $it){
                $subtotal += ($it['price'] * $it['qty']);
            }
            $discount = (float)($request->discount ?? 0);
            $tax = (float)($request->tax ?? 0);
            $total = max(0, $subtotal - $discount + $tax);

            $order = Order::create([
                'invoice'=>$invoice,
                'customer_id'=>$request->customer_id,
                'user_id'=>$user->id,
                'subtotal'=>$subtotal,
                'discount'=>$discount,
                'tax'=>$tax,
                'total'=>$total,
                'status'=>'paid'
            ]);

            foreach($request->items as $it){
                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$it['id'],
                    'qty'=>$it['qty'],
                    'price'=>$it['price'],
                    'total'=>$it['price']*$it['qty']
                ]);
                Product::where('id',$it['id'])->decrement('stock', $it['qty']);
                StockMovement::create(['product_id'=>$it['id'],'qty'=>-$it['qty'],'type'=>'out','note'=>'Sale '.$invoice]);
            }

            $change = max(0, $request->paid - $total);
            Payment::create(['order_id'=>$order->id,'method'=>$request->method,'paid'=>$request->paid,'change'=>$change]);

            return response()->json(['message'=>'Transaksi tersimpan','invoice'=>$invoice,'change'=>$change,'order_id'=>$order->id]);
        });
    }

    public function datatable(Request $request){
        if($request->ajax()){
            $rows = DB::table('orders as o')
            ->leftJoin('customers as c','c.id','=','o.customer_id')
            ->join('users as u','u.id','=','o.user_id')
            ->select('o.id','o.invoice','c.name as customer','u.name as cashier','o.total','o.created_at')
            ->orderByDesc('o.id')->get();
            return response()->json(['data'=>$rows]);
        }
        abort(404);
    }

    public function show(Request $request, $id){
        $order = DB::table('orders as o')
        ->leftJoin('customers as c','c.id','=','o.customer_id')
        ->join('users as u','u.id','=','o.user_id')
        ->select('o.*','c.name as customer','u.name as cashier')
        ->where('o.id',$id)->first();
        $items = DB::table('order_items as oi')
        ->join('products as p','p.id','=','oi.product_id')
        ->select('p.name','oi.qty','oi.price','oi.total')
        ->where('oi.order_id',$id)->get();
        return response()->json(['order'=>$order,'items'=>$items]);
    }

    public function confirm(Request $request, $id){
        $request->validate(['paid'=>'required|numeric','method'=>'required']);
        return \DB::transaction(function() use ($id,$request){
            $order = \App\Models\Order::findOrFail($id);
            if($order->status === 'paid'){ return response()->json(['message'=>'Sudah dibayar'], 422); }
            $items = \App\Models\OrderItem::where('order_id',$order->id)->get();
            foreach($items as $it){
                \App\Models\Product::where('id',$it->product_id)->decrement('stock', $it->qty);
                \App\Models\StockMovement::create(['product_id'=>$it->product_id,'qty'=>-$it->qty,'type'=>'out','note'=>'Confirm '.$order->invoice]);
            }
            $order->status='paid'; $order->save();
            \App\Models\Payment::create(['order_id'=>$order->id,'method'=>$request->method,'paid'=>$request->paid,'change'=>max(0,$request->paid - $order->total)]);
            return response()->json(['message'=>'Pesanan dikonfirmasi']);
        });
    }

    public function paymen(Request $request)
    {
        $request->validate([
            'items'=>'required|array','paid'=>'required|numeric','method'=>'required'
        ]);

        return DB::transaction(function() use ($request){
            $user = Auth::user();
            $invoice = 'INV-'.now()->format('Ymd-His').rand(100,999);

            $subtotal = 0;
            foreach($request->items as $it){
                $subtotal += ($it['price'] * $it['qty']);
            }
            $discount = (float)($request->discount ?? 0);
            $tax = (float)($request->tax ?? 0);
            $total = max(0, $subtotal - $discount + $tax);

            $order = Order::create([
                'invoice'=>$invoice,
                'customer_id'=>$request->customer_id,
                'user_id'=>$user->id,
                'subtotal'=>$subtotal,
                'discount'=>$discount,
                'tax'=>$tax,
                'total'=>$total,
                'status'=>'paid'
            ]);


            foreach($request->items as $it){
                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$it['id'],
                    'qty'=>$it['qty'],
                    'price'=>$it['price'],
                    'total'=>$it['price']*$it['qty']
                ]);
                Product::where('id',$it['id'])->decrement('stock', $it['qty']);
                StockMovement::create(['product_id'=>$it['id'],'qty'=>-$it['qty'],'type'=>'out','note'=>'Sale '.$invoice]);
            }

            $change = max(0, $request->paid - $total);
            Payment::create(['order_id'=>$order->id,'method'=>$request->method,'paid'=>$request->paid,'change'=>$change]);

            $data = Order::select('orders.*', 'customers.name as customer_name', 'customers.email as customer_email')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->where('orders.id', $order->id)
            ->first();

            if($request->method === 'qris'){

            // Konfigurasi Midtrans
                Config::$serverKey = config('midtrans.server_key');
                Config::$isProduction = config('midtrans.is_production');
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => 'ORDER-' . $data->id . '-' . time(),
                'gross_amount' => $data->total, // total harga
            ],
            'customer_details' => [
                'first_name' => $data->customer_name ?? 'Guest',
                'email'      => $data->customer_email ?? 'guest@mail.com',
            ],
            'enabled_payments' => ["gopay", "ovo", "qris"], // <= aktifkan OVO/QRIS
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
    'invoice'    => $data->id // kalau perlu tampilkan invoice juga
]);

    }
});


    }
}
