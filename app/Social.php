<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
   
    public $timestamps = false;
    // fill làm đầy , fillup lắp đầy , fillable có thể làm đầy 
    protected $fillable = [
          'provider_user_id',  'provider',  'user'
    ];
 
    protected $primaryKey = 'user_id';
 	protected $table = 'tbl_social';
 	public function login(){
 		return $this->belongsTo('App\Login', 'user');
 	}
}

