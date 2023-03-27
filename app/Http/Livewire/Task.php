<?php

namespace App\Http\Livewire;

use App\Models\Task as ModelsTask;
use Livewire\Component;

class Task extends Component
{
    public $tasks;
    public $task;

    protected $rules = [
        'task.text' => 'required|max:40'
    ]; //cuando una propiedad no hace nada en la vista tiene que ser protegido

    /* esta funcion es el ciclo de vida de un componente que se llama una sola vez cuando se carga el componente de la pagina */
    /* Se utiliza para inicializar variables y realizar otras tareas necesarias para preparar el componente para su uso. */
    /* se puede inicializar una propiedad de un modelo que se utilizará para almacenar los datos del componente. */
    /* Además de inicializar variables, el método mount también se utiliza para registrar los listeners de eventos, como los eventos de escucha de DOM, los eventos emitidos por otros componentes, etc. Los listeners se registran para que puedan responder a los eventos que se producen en la página y actualizar el estado del componente en consecuencia. */
    public function mount()
    {
        $this->tasks = ModelsTask::orderBy('id', 'desc')->get();
        $this->task = new ModelsTask();
    }

    public function updatedTaskText()
    {
        $this->validate(['task.text' => 'max:40']);
    }

    public function render()
    {
        return view('livewire.task');
    }

    public function save()
    {
        // dd($this->task);
        $this->validate();//corre las rules
        $this->task->save();// guarda los datos del formulario

        $this->mount(); // limpia el input del formulario y ejecuto el mount una vez

        session()->flash('message', 'Tarea guardada correctamente');
    }
    public function delete($id)
    {
        $task = ModelsTask::find($id);

        if (!is_null($task)) {
            $task->delete();
            session()->flash('message', 'Tarea eliminada correctamente');
            $this->mount();
        }
    }

    public function edit(ModelsTask $task)
    {
        $this->task = $task;
    }

}
