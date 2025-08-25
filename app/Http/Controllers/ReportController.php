<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales(Request $request){
        if($request->ajax()){
            $from = $request->from; $to = $request->to;
            $rows = DB::table('orders as o')
            ->leftJoin('customers as c','c.id','=','o.customer_id')
            ->join('users as u','u.id','=','o.user_id')
            ->select('o.invoice','c.name as customer','u.name as cashier','o.total','o.created_at','o.channel')
            ->when($from && $to, function($q) use ($from,$to){
                $q->whereBetween(DB::raw('DATE(o.created_at)'), [$from,$to]);
            })
            ->orderBy('o.created_at','desc')->get();
            return response()->json(['data'=>$rows]);
        }
        return view('reports.sales');
    }
}
