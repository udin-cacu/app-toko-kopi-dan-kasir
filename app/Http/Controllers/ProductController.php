<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('products as p')
            ->join('categories as c','c.id','=','p.category_id')
            ->select('p.id','p.name','c.name as category','p.price','p.stock','p.active','p.img')
            ->orderBy('p.id','desc')->get();
            return response()->json(['data'=>$data]);
        }
        return view('products.index');
    }

    public function store(Request $request){
        /*$request->validate([
            'category_id'=>'required',
            'name'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|integer',
            'img'=>'required'
        ]);
        Product::create($request->only(
            'category_id','name',
            'price',
            'img','img',
            'stock') + ['active'=>$request->boolean('active')]);
            return response()->json(['message'=>'Produk ditambahkan']);*/

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $user = Auth::user();

            $simpan = new Product();
            $simpan->name = $request->name;
            $simpan->category_id = $request->category_id;
            $simpan->price = $request->price;
            $simpan->stock = $request->stock;
            $simpan->img = $request->img;
            $simpan->save();
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

        public function upload(Request $request)
        {
            date_default_timezone_set('Asia/Jakarta');
            $user = Auth::user();

            $validation = Validator::make($request->all(), [
                'file' => 'required|mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,bmp',
            ]);

            if ($validation->passes()) {

                $file = $request->file('file');
                $filename = rand() . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('/assets2/images');
                $file->move($destinationPath, $filename);

                return response()->json([
                    'message' => 'Upload Anda Tersimpan',
                    'icon' => 'success',
                    'name' => $filename,
                    'status' => '1',
                ]);

            } else {

                return response()->json([
                    'message' => $validation->errors()->all(),
                    'icon' => 'error',
                    'status' => '0',
                ]);
            }
        }
    }
