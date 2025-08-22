<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AppointmentListCard extends Component
{
    public string $title;
    public string $link;
    public array $appointments;

    public function __construct(string $title, string $link, array $appointments)
    {
        $this->title = $title;
        $this->link = $link;
        $this->appointments = $appointments;
    }

    public function render()
    {
        return view('components.admin.appointment-list-card');
    }
}

