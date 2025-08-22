<?php
namespace App\Models\Doctor;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class DoctorExperience extends Model
{
    protected $fillable = [
        'doctor_id', 'hospital_name', 'position','address',
        'start_date', 'end_date', 'description'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    /**
     * Create Doctors experiences
     * */

    public static function bulkStore(array $experiences, int $doctorId): void
    {
        
        foreach ($experiences as $exp) {
            self::create([
                'doctor_id'     => $doctorId,
                'hospital_name' => $exp['hospital_name'],
                'address'       => $exp['address'],
                'position'      => $exp['position'],
                'start_date'    => $exp['start_date'],
                'end_date'      => $exp['end_date'],
                'description'   => $exp['description'] ?? null,
            ]);
        }
}

    /**
     * Update Doctors experiences
     *
     * */

    public static function syncFromRequest(array $experiences, int $doctorId): void
    {
        static::where('doctor_id', $doctorId)->delete();

        static::bulkStore($experiences, $doctorId);
    }




}
