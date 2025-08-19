<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $today = now()->toDateString();
        $sales = DB::table('orders')
            ->select(DB::raw('COALESCE(SUM(total),0) as total'))
            ->whereDate('created_at',$today)->first();
        $countOrders = DB::table('orders')->whereDate('created_at',$today)->count();
        $topProducts = DB::table('order_items as oi')
            ->join('products as p','p.id','=','oi.product_id')
            ->select('p.name', DB::raw('SUM(oi.qty) as qty'))
            ->groupBy('p.name')->orderByDesc('qty')->limit(5)->get();
        return view('dashboard.index', compact('sales','countOrders','topProducts'));
    }
}
