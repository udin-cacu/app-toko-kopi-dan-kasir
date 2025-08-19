<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(){
        User::updateOrCreate(
            ['email' => 'admin@kopi.test'],
            ['name' => 'Admin Kopi','password' => Hash::make('password'),'role' => 'admin']
        );
        User::updateOrCreate(
            ['email' => 'kasir@kopi.test'],
            ['name' => 'Kasir Kopi','password' => Hash::make('password'),'role' => 'kasir']
        );
    }
}
