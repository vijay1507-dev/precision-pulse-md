<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use App\Models\Patient\PatientProfile;
use App\Models\Doctor\Doctor;
use App\Models\Appointment\Appointment;
use App\Models\Payment;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $appends = ['first_name'];

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'name',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function sendPasswordResetNotification($token)
    {
        if ($this->hasRole('patient')) {
            $this->notify(new \App\Notifications\Patient\PatientResetPasswordNotification($token));
        } else {
            $this->notify(new \App\Notifications\DefaultResetPasswordNotification($token));
        }
    }



     /**
     * Accessor to expose `name` as `first_name` in API
     */
    public function getFirstNameAttribute()
    {
        return $this->attributes['name'];
    }

    /**
     * Create Dotor User 
     * */

    public static function createDoctorAccount(array $data): self
    {
        $user = self::create([
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        $user->assignRole('doctor');
        return $user;
    }

     /**
     * Create Paitent User 
     *
     * */
    public static function createPatientAccount(array $data): self
    {
        $user = self::create([
            'name'      => $data['first_name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        $user->assignRole('patient');
        return $user;
    }


     /**
     * Update Patient User 
     *
     * */
    public function updatePatientUser(array $data): void
    {
        $this->update([
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
        ]);
    }

    /**
     * Upadte Dotor User 
     *
     * */
    public function updateDoctorUser(array $data): void
    {
        $this->update([
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
        ]);
    }

    /**
     * Patient Profile Relation
     * */

    public function patientProfile()
    {
        return $this->hasOne(PatientProfile::class);
    }

    /**
     * Admins Profile Relation
     * */

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }



    /**
     * Doctor Profile Relations 
     *
     * */

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }


    /**
     * 
     * 
     * */

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

     /**
     * 
     * 
     * */

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * 
     * */

    public function intakeForms()
    {
        return $this->hasOne(\App\Models\IntakeForm::class);
    }


}
