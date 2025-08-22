<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class PatientProfile extends Model
{
        /** @use HasFactory<\Database\Factories\PatientProfileFactory> */
        use HasFactory;

        protected $fillable = [
            'user_id',
            'date_of_birth',
            'gender',
            'phone_number',
            'height_cm',
            'weight_lbs',
            'profile_image',
            'age',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

         /**
         * Accessor to calculate age from date_of_birth.
         */
        public function getAgeAttribute()
        {
            return $this->date_of_birth
                ? Carbon::parse($this->date_of_birth)->age
                : null;
        }


        public static function createWithImage(array $data, ?UploadedFile $image = null): self
        {
            if ($image) {
                $data['profile_image'] = self::storeProfileImage($data['user_id'], $image);
            }

            return self::create(self::filterFillable($data));
        }

        protected static function storeProfileImage(int $userId, UploadedFile $image): string
        {
            self::deleteExistingImage($userId);
            $path = $image->store('patient/profile', 'public');
            return basename($path);
        }

        protected static function deleteExistingImage(int $userId): void
        {
            $existing = self::where('user_id', $userId)->first();
            if ($existing && $existing->profile_image) {
                Storage::disk('public')->delete('patient/profile/' . $existing->profile_image);
            }
        }

        protected static function filterFillable(array $data): array
        {
            return collect($data)
                ->only([
                    'user_id',
                    'date_of_birth',
                    'gender',
                    'phone_number',
                    'height_cm',
                    'weight_lbs',
                    'profile_image',
                ])
                ->toArray();
        }
}
