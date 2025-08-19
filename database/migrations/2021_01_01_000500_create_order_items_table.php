<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up(){
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('qty');
            $table->decimal('price', 12,2);
            $table->decimal('total', 12,2);
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('order_items'); }
}
