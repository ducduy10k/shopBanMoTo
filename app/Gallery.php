<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    public $timestamps = false;
    // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
    protected $fillable = [
           'gallery_name','gallery_image','product_id '   
        ];
 
    protected $primaryKey = ' gallery_id';
 	protected $table = 'tbl_gallery';
}
