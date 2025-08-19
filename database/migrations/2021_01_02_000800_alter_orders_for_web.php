<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrdersForWeb extends Migration
{
    public function up(){
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders','channel')) {
                $table->string('channel')->default('pos');
            }
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();
        });
    }
    public function down(){
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders','channel')) $table->dropColumn('channel');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
}
