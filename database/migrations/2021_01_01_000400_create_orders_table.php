<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(){
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('subtotal', 12,2)->default(0);
            $table->decimal('discount', 12,2)->default(0);
            $table->decimal('tax', 12,2)->default(0);
            $table->decimal('total', 12,2)->default(0);
            $table->string('status')->default('paid');
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('orders'); }
}
