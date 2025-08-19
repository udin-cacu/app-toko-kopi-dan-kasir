<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('categories as c')
                ->leftJoin('products as p','p.category_id','=','c.id')
                ->select('c.id','c.name', DB::raw('COUNT(p.id) as product_count'))
                ->groupBy('c.id','c.name')
                ->orderBy('c.id','desc')->get();
            return response()->json(['data'=>$data]);
        }
        return view('categories.index');
    }

    public function store(Request $request){
        $request->validate(['name'=>'required']);
        Category::create(['name'=>$request->name]);
        return response()->json(['message'=>'Kategori ditambahkan']);
    }

    public function edit(Request $request){
        $cat = Category::findOrFail($request->id);
        return response()->json($cat);
    }

    public function update(Request $request){
        $request->validate(['id'=>'required','name'=>'required']);
        Category::where('id',$request->id)->update(['name'=>$request->name]);
        return response()->json(['message'=>'Kategori diperbarui']);
    }

    public function destroy(Request $request){
        Category::where('id',$request->id)->delete();
        return response()->json(['message'=>'Kategori dihapus']);
    }
}
