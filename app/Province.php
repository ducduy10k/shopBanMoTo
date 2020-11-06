<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    public $timestamps = false;
    // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
    protected $fillable = [
          'name_quanhuyen',  'type','matp'   
        ];
 
    protected $primaryKey = 'maqh';
 	protected $table = 'tbl_quanhuyen';
}
