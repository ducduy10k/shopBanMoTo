<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    //
    public $timestamps = false;
    // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
    protected $fillable = [
          'slide_title',  'slide_desc',  'slide_content','slide_image','slide_status','slide_time'
    ];
 
    protected $primaryKey = 'slide_id';
 	protected $table = 'tbl_slide_home';
 	
}
