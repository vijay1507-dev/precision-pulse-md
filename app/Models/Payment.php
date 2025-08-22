<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Appointment\Appointment;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'appointment_id',
        'gateway',
        'status',
        'transaction_id',
        'gateway_reference',
        'payment_method_type',
        'receipt_url',
        'currency',
        'amount',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
