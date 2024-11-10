<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Transaction extends Model
{
	use HasFactory;

	const STATUS_PENDING = 'pending';
	const STATUS_CONFIRMED = 'confirmed';
	const STATUS_REFUSED = 'refused';

	const TYPE_WITHDRAW = 'withdraw';
	const TYPE_DEPOSIT = 'deposit';

	protected $fillable = [
		'user_id',
		'amount',
		'address',
		'status',
		'img',
		'currency',
		'transaction_type',
	];



	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
