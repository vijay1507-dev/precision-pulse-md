<?php
namespace App\View\Components;

use Illuminate\View\Component;

class TinyEditor extends Component
{
    public $name;
    public $id;
    public $value;

    public function __construct($name, $id = null, $value = null)
    {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.tiny-editor');
    }
}
