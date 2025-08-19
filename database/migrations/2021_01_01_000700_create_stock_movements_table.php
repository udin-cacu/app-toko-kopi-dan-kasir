<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovementsTable extends Migration
{
    public function up(){
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->integer('qty');
            $table->string('type');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('stock_movements'); }
}
