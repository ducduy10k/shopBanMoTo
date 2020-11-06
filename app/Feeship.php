<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    //
    public $timestamps = false;
    // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
    protected $fillable = [
          'fee_matp ',  'fee_maqh','fee_xaid','fee_feeship'   
        ];
 
    protected $primaryKey = 'fee_id ';
 	protected $table = 'tbl_feeship';
}
