<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Doctor\Doctor;
use App\Models\Payment;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'doctor_id',
        'name',
        'email',
        'phone',
        'gender',
        'dob',
        'height_feet',
        'height_inches',
        'appointment_date',
        'appointment_time',
        'reason',
        'status',
        'medical_history',
        'family_history',
        'lifestyle',
        'patient_record',
        'follow_up_file',
        'schedule_file',

        

    ];

    protected $casts = [
        'dob' => 'date',
        'appointment_date' => 'date',
        'appointment_time' => 'string',
        'medical_history' => 'array',
        'family_history' => 'array',
        'lifestyle' => 'array', 
        'patient_record' => 'array',
    ];

    protected $dates = [
        'appointment_date',
        'deleted_at',
    ];

    protected $appends = [
        'scheduled_at',
    ];

    /**
     * Accessor for combined scheduled datetime
     */
    public function getScheduledAtAttribute()
{
    try {
        $date = $this->appointment_date;
        $time = $this->appointment_time;

        if (!$date || strtotime($date) === false) {
            return null;
        }

        
        $formattedTime = Carbon::createFromFormat('H:i:s', $time)->format('g:i A');

        $parsedDate = Carbon::parse($date);

        // If time is provided and date has no time component, combine them
        if ($parsedDate->format('H:i:s') === '00:00:00' && $time) {
            return Carbon::parse("{$parsedDate->format('Y-m-d')} {$formattedTime}");
        }

        return $parsedDate;

    } catch (\Exception $e) {
        \Log::error('ScheduledAt parse failed', [
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'error' => $e->getMessage(),
        ]);
        return null;
    }
}


    /**
     * Formatted version of scheduled datetime
     */
    public function getFormattedScheduledAtAttribute()
    {
        return $this->scheduled_at
            ? Carbon::parse($this->scheduled_at)->format('d M Y, h:i A')
            : null;
    }

    /**
     * Mutator to standardize phone numbers
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\D+/', '', $value);
    }

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Scope to filter upcoming appointments
     */
   public function scopeUpcoming($query)
    {
        $now = now();

        return $query->where(function ($q) use ($now) {
            $q->where('appointment_date', '>', $now->toDateString())
              ->orWhere(function ($q2) use ($now) {
                  $q2->whereDate('appointment_date', $now->toDateString())
                     ->whereTime('appointment_time', '>=', $now->toTimeString());
              });
        });
    }

    /**
     * Scope to filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for appointments with full relationships
     */
    public function scopeWithFullDetails($query, $direction = 'desc')
    {
        return $query->with([
                'user',
                'doctor.user',
                'doctor',
                'payment'
            ])
            ->orderBy('appointment_date', $direction)
            ->orderBy('appointment_time', $direction);
    }


    public static function createForDoctor(Doctor $doctor, User $user, array $data): self
    {
        // if (!$doctor->isSlotAvailable($data['appointment_date'], $data['appointment_time'])) {
        //     throw new \Exception('This time slot is already booked or unavailable.');
        // }

        return self::create([
            'user_id'          => $user->id,
            'doctor_id'        => $doctor->id,
            'name'             => $data['name'],
            'email'            => $data['email'],
            'phone'            => $data['phone'],
            'gender'           => $data['gender'],
            'dob'              => $data['dob'],
            'height_feet'      => $data['height_feet']?? null,
            'height_inches'    => $data['height_inches']?? null,
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'reason'           => $data['reason'] ?? null,
            'status'           => $data['status'] ?? 'pending',
            'medical_history'  => $data['medical_history'] ?? [],
            'family_history'   => $data['family_history'] ?? [],
            'lifestyle'        => $data['lifestyle'] ?? [],
            'patient_record'   => $data['patient_record'] ?? [],
            'schedule_file'    => $data['schedule_file'] ?? null,
            'follow_up_file'   => $data['follow_up_file'] ?? null,
        ]);
    }


}
