<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Support extends Model
{
    use HasFactory;
    
    protected $fillable=[
			'message',
			'user_id',
			'status'
    ];



	public function user(){
		return $this->belongsTo(User::class);
	}
}
