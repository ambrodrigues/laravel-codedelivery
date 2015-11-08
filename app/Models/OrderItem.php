<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class OrderIten extends Model
{
   protected $fillable = [
     'product_id',
       'order_id',
      'price',
      'qtd'
   ];

   public function order(){
      return $this->belongsTo(Order::class);
   }

   public function product(){
      return $this->belongsTo(Product::class);
   }
}
