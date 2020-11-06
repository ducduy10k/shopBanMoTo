<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $timestamps = false;
    // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
    protected $fillable = [
        'customer_id',  'shipping_id',  'order_status'
  ];

  protected $primaryKey = 'order_id';
   protected $table = 'tbl_order';
}
