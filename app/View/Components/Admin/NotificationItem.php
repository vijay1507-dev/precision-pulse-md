<?php
namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Notifications extends Component
{
    public array $notifications;

    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
    }

    public function render()
    {
        return view('components.admin.notifications');
    }
}
