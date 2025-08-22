<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class UserProfile extends Component
{
    public User $user;
    public string $fallbackImage;

    /**
     * Create a new component instance.
     */
    public function __construct(User $user, string $fallbackImage = '')
    {
        $this->user          = $user;
        $this->fallbackImage = $fallbackImage ?: asset('assets/images/profile.jpg');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.user-profile');
    }
}
