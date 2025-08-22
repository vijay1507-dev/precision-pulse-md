<?php
namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Doctor extends Model
{
      protected $fillable = [
        'user_id',
        'gender',
        'phone',
        'about_me',
        'license_number',
        'npi',
        'specializations',
        'profile_photo',
    ];


     protected $casts = [
        'specializations' => 'array',
    ];



    /**
     * Relation With User Table  as Doctor Profile 
     *
     * */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Relation With Appointments 
    * 
    * */

    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment\Appointment::class);
    }


    /**
     * Relation With Experiences
     * */

    public function experiences()
    {
        return $this->hasMany(DoctorExperience::class);
    }
    /**
     * Relation With DoctorAvailability
     * */
    public function availability()
    {
        return $this->hasOne(\App\Models\Doctor\DoctorAvailability::class);
    }

    /**
     * All Doctors 
     * */
    public static function getAllWithUser(): Collection
    {
        return self::with('user')
            ->latest()
            ->get();
    }

    /**
     * Doctor  profile by id 
     * */

    public static function findFullProfile(int $id): self
    {
        return self::with(['user', 'availability', 'experiences'])->findOrFail($id);
    }

    /**
     * 
     * Doctors with Filter
     * */

    public static function getFilteredList(array $filters): LengthAwarePaginator
    {
        $query = self::with(['user', 'availability']);

        if (!empty($filters['search'])) {
            $query->whereHas('user', function (Builder $q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('last_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['specialization'])) {
            $query->whereJsonContains('specializations', $filters['specialization']);
        }

        $sortable = ['name', 'email', 'created_at'];
        $sort = in_array($filters['sort'] ?? '', $sortable) ? $filters['sort'] : 'created_at';
        $direction = ($filters['direction'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

        $query->when($sort === 'name', fn($q) => 
            $q->join('users', 'doctors.user_id', '=', 'users.id')
              ->orderBy('users.name', $direction)
              ->select('doctors.*') // To avoid column ambiguity
        , fn($q) => $q->orderBy($sort, $direction));

        return $query->paginate(2)->appends($filters);
    }

    /**
     * 
     * Create doctor Profile 
     * */

    public static function createFromRequest(array $data, int $userId): self
    {
        return self::create([
            'user_id'         => $userId,
            'gender'          => $data['gender'],
            'phone'           => $data['phone'],
            'about_me'        => $data['about_me'],
            'license_number'  => $data['license_number'] ?? 'LIC' . rand(1000, 9999),
            'npi'             => $data['npi'] ?? rand(1000000000, 9999999999),
            'specializations' => $data['specializations'],
            'profile_photo'   => isset($data['profile_photo']) 
                ? $data['profile_photo']->store('doctors', 'public') 
                : null,
        ]);
    }

    /**
     * Update doctor Profile 
     * */

    public function updateFromRequest(array $data): void
    {
        $photoPath = $this->profile_photo;

        if (isset($data['profile_photo']) && $data['profile_photo'] instanceof \Illuminate\Http\UploadedFile) {
            $photoPath = $data['profile_photo']->store('doctors', 'public');
        }

        $this->update([
            'gender'          => $data['gender'],
            'phone'           => $data['phone'],
            'about_me'        => $data['about_me'],
            'license_number'  => $data['license_number'],
            'npi'             => $data['npi'],
            'specializations' => $data['specializations'],
            'profile_photo'   => $photoPath,
        ]);
    }




}
