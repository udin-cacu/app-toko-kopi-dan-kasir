<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\Order; 
use App\Models\OrderItem; 
use App\Models\Product; 
use Illuminate\Support\Facades\DB;
use Auth;

class StaffOrderController extends Controller
{
    public function index() { 
        // $orders = Order::where('channel','web')->orderByDesc('created_at')->get(); 

        $orders = Order::where('status','=','pending')->orderByDesc('created_at')->get(); 

        return view('staff.orders.index', compact('orders')); 
    }

    public function confirm(Request $r, $id){


        return DB::transaction(function() use ($r,$id){
            $user = Auth::user();

            $order = Order::with('items')->findOrFail($id);

            if($order->status === 'paid') 

                return response()->json(['message'=>'Sudah dibayar'],422);
            foreach($order->items as $it){ 
                Product::where('id',$it->product_id)->decrement('stock',$it->qty); 
            }

            $order->user_id = $user->id;

            $order->status = 'paid'; $order->save();
            return response()->json(['message'=>'Pesanan dikonfirmasi']);
        });
    }
}
