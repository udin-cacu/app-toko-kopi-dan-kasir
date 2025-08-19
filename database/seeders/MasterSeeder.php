<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category; use App\Models\Product;

class MasterSeeder extends Seeder
{
    public function run(){
        $cat = Category::firstOrCreate(['name'=>'Coffee']);
        $cat2 = Category::firstOrCreate(['name'=>'Non-Coffee']);

        Product::updateOrCreate(['name'=>'Espresso'],[
            'category_id' => $cat->id,
            'price' => 15000, 'stock'=>100, 'active'=>true
        ]);
        Product::updateOrCreate(['name'=>'Americano'],[
            'category_id' => $cat->id,
            'price' => 18000, 'stock'=>100, 'active'=>true
        ]);
        Product::updateOrCreate(['name'=>'Matcha Latte'],[
            'category_id' => $cat2->id,
            'price' => 22000, 'stock'=>80, 'active'=>true
        ]);
    }
}
