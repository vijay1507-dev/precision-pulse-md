<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorExperience;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'doctor']);

        $emails = [
            'rajat@example.com',
            'jane@example.com',
            'watson@example.com'
        ];

        \App\Models\User::whereIn('email', $emails)->delete();

        $doctors = [
            ['name' => 'Dr. Rajat', 'last_name' => 'Dhiman', 'email' => 'rajat@example.com', 'specializations' => ['Cardiology']],
            ['name' => 'Dr. Jane', 'last_name' => 'Smith', 'email' => 'jane@example.com', 'specializations' => ['Dermatology']],
            ['name' => 'Dr. John', 'last_name' => 'Watson', 'email' => 'watson@example.com', 'specializations' => ['General Medicine']],
        ];

        foreach ($doctors as $doc) {
            $user = User::create([
                'name' => $doc['name'],
                'last_name' => $doc['last_name'],
                'email' => $doc['email'],
                'password' => bcrypt('password'),
            ]);

            $user->assignRole('doctor');

            $doctor = Doctor::create([
                'user_id' => $user->id,
                'gender' => 'Male',
                'phone' => '9876543210',
                'about_me' => 'Experienced doctor with a passion for healing.',
                'license_number' => strtoupper('LIC' . rand(10000, 99999)),
                'npi' => rand(1000000000, 9999999999),
                'specializations' => $doc['specializations'],
                'profile_photo' => null,
            ]);

            DoctorExperience::insert([
                [
                    'doctor_id'     => $doctor->id,
                    'hospital_name' => 'Apollo Hospital',
                    'address'       => 'New Delhi, India',
                    'position'      => 'Senior Consultant',
                    'start_date'    => '2015-01-01',
                    'end_date'      => '2020-12-31',
                    'description'   => 'Managed high-risk cases and mentored junior staff.',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
                [
                    'doctor_id'     => $doctor->id,
                    'hospital_name' => 'Max Healthcare',
                    'address'       => 'Gurgaon, India',
                    'position'      => 'Chief Specialist',
                    'start_date'    => '2021-01-01',
                    'end_date'      => null,
                    'description'   => 'Currently leading the cardiac department.',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            ]);
        }
    }
}
