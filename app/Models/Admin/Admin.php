<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Admin extends Model
{
    


    protected $fillable = [
        'user_id',
        'phone',
        'avatar',
        'position',
        'department',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get Admin Profile
     * 
     * */

    public static function fetchWithUser($id): ?self
    {
  
        return static::with('user')->where('user_id', $id)->first();
    }

    /**
     * Save or update the admin profile along with related user and avatar.
     */
    public function saveProfile(array $data, Request $request): self
    {

        $user = $request->user();;

        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        $avatar = $this->handleAvatar($request);

        $this->fill([
            'user_id'    => $user->id,
            'phone'      => $data['phone'] ?? null,
            'position'   => $data['position'] ?? null,
            'department' => $data['department'] ?? null,
            'bio'        => $data['bio'] ?? null,
            'avatar'     => $avatar ?? $this->avatar,
        ])->save();

        return $this->load('user');
    }


    /**
     * Handle avatar upload and replace old file if it exists.
     */


   public function handleAvatar(Request $request): ?string
    {
        $file = $request->file('avatar');

        if (!$file || !$file->isValid()) {
            return null;
        }


        if ($this->avatar) {
            Storage::disk('public')->delete($this->avatar);
        }

        // Create a custom name: admin_1720208745.jpg
        $filename = 'admin_' . time() . '.' . $file->getClientOriginalExtension();


        return $file->storeAs('admin', $filename, 'public');
    }

}
