<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    //
       //
       public $timestamps = false;
       // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
       protected $fillable = [
           'coupon_name',  'coupon_code',  'coupon_time','coupon_number', 'coupon_condition'
     ];
   
     protected $primaryKey = 'coupon_id';
      protected $table = 'tbl_coupon';
      
}
