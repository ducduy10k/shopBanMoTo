<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public $timestamps = false;
    // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
    protected $fillable = [
          'name_city',  'type'   
        ];
 
    protected $primaryKey = 'matp';
 	protected $table = 'tbl_tinhthanhpho';
}
