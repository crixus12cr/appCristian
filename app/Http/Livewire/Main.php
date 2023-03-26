<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $welcome = 'Bienvenid@ estas son tus tareas';

    public function render()
    {
        return view('livewire.main'); //cuando no se a creado un layaout se puede aosciar a un layaot en el render
    }
}
