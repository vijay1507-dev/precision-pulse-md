<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    protected $table = 'doctor_availabilities';

    protected $fillable = [
        'doctor_id',
        'is_available',
        'available_days',
        'available_from',
        'available_to',
        'start_time',
        'end_time',
        'slot_duration',
        'recurrence',
        'blocked_dates',
    ];

    protected $casts = [
        'available_days' => 'array',
        'blocked_dates'  => 'array',
        'is_available'   => 'boolean',
    ];

    /**
     * Relationship: Doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Scope to get only available doctors
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Static method to create or update doctor availability
     */
    public static function storeFromRequest(array $data, int $doctorId): self
    {

       return self::updateOrCreate(
            ['doctor_id' => $doctorId],
            [
                'is_available'   => isset($data['is_available']),
                'available_days' => $data['available_days'] ?? [],
                'available_from' => $data['available_from'] ?? null,
                'available_to'   => $data['available_to'] ?? null,
                'start_time'     => $data['start_time'] ?? null,
                'end_time'       => $data['end_time'] ?? null,
                'slot_duration'  => $data['slot_duration'] ?? 30,
                'recurrence'     => $data['recurrence'] ?? 'none',
                'blocked_dates'  => isset($data['blocked_dates']) 
                    ? array_filter(array_map('trim', explode(',', $data['blocked_dates'])))
                    : [],
            ]
        );
    }
}
