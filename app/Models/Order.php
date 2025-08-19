<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model{
    use HasFactory; protected $fillable=['invoice','customer_id','user_id','subtotal','discount','tax','total','status'];
    public function items(){ return $this->hasMany(OrderItem::class); }
    public function customer(){ return $this->belongsTo(Customer::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
