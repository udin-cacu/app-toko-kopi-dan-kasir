<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up(){
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('method');
            $table->decimal('paid', 12,2);
            $table->decimal('change', 12,2)->default(0);
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('payments'); }
}
