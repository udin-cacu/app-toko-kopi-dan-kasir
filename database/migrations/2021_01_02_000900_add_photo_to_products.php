<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToProducts extends Migration
{
    public function up(){
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products','photo')) {
                $table->string('photo')->nullable()->after('name');
            }
        });
    }
    public function down(){
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products','photo')) $table->dropColumn('photo');
        });
    }
}
