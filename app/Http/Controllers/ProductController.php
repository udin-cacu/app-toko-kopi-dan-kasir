<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('products as p')
                ->join('categories as c','c.id','=','p.category_id')
                ->select('p.id','p.name','c.name as category','p.price','p.stock','p.active')
                ->orderBy('p.id','desc')->get();
            return response()->json(['data'=>$data]);
        }
        return view('products.index');
    }

    public function store(Request $request){
        $request->validate([
            'category_id'=>'required','name'=>'required','price'=>'required|numeric','stock'=>'required|integer'
        ]);
        Product::create($request->only('category_id','name','price','stock') + ['active'=>$request->boolean('active')]);
        return response()->json(['message'=>'Produk ditambahkan']);
    }

    public function edit(Request $request){
        $p = Product::findOrFail($request->id);
        return response()->json($p);
    }

    public function update(Request $request){
        $request->validate(['id'=>'required','category_id'=>'required','name'=>'required','price'=>'required|numeric','stock'=>'required|integer']);
        Product::where('id',$request->id)->update($request->only('category_id','name','price','stock') + ['active'=>$request->boolean('active')]);
        return response()->json(['message'=>'Produk diperbarui']);
    }

    public function destroy(Request $request){
        Product::where('id',$request->id)->delete();
        return response()->json(['message'=>'Produk dihapus']);
    }
}
