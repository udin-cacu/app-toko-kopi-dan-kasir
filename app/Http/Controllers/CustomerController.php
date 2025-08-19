<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('customers')->select('id','name','phone','email')->orderBy('id','desc')->get();
            return response()->json(['data'=>$data]);
        }
        return view('customers.index');
    }

    public function store(Request $request){
        $request->validate(['name'=>'required']);
        Customer::create($request->only('name','phone','email'));
        return response()->json(['message'=>'Pelanggan ditambahkan']);
    }

    public function edit(Request $request){
        $c = Customer::findOrFail($request->id);
        return response()->json($c);
    }

    public function update(Request $request){
        $request->validate(['id'=>'required','name'=>'required']);
        Customer::where('id',$request->id)->update($request->only('name','phone','email'));
        return response()->json(['message'=>'Pelanggan diperbarui']);
    }

    public function destroy(Request $request){
        Customer::where('id',$request->id)->delete();
        return response()->json(['message'=>'Pelanggan dihapus']);
    }
}
