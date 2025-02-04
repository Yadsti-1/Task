<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskComponent extends Component
{
    public $tasks = [];
    public $name; // Define la variable
    public $description; // Define la variable
    public $id;
    public $miTarea = null;
    public $modal = false; // Define la variable para abrir y cerrar el modal donde se van a crear las tareas
    public $users; // Define la variable para almacenar los usuarios
    public $isUpdating; // Define la variable para saber si se está actualizando o creando una tarea

    public function getTasks()
    {
        return Task::where('user_id', Auth::id())->orderBy('id', 'desc')->get(); // Obtiene las tareas del usuario autenticado
    }

    public function mount()
    {
        $this->tasks = $this->getTasks();
        $this->users = User::where('id', '!=', Auth::user()->id)->get(); // Asigna las tareas del usuario autenticado a la variable tasks
    }

    public function render()
    {
        return view('livewire.task-component');
    }

    private function clearFields()
    {
        $this->name = '';
        $this->description = '';
        $this->miTarea = null;
        $this->isUpdating = false;
    }

    public function openCreateModal(Task $task = null)
    {
        $this->isUpdating = false;
        if ($task) {
            
            $this->miTarea = Task::find($task->id);
            if ($this->miTarea) {
                $this->name = $this->miTarea->name;
                $this->description = $this->miTarea->description;
                $this->id = $this->miTarea->id;
            }

        } else {
            $this->clearFields();
            $this->miTarea = null;
        }
        $this->modal = true;
    }

    public function closeCreateModal()
    {
        $this->modal = false;
    }

    public function createorUpdateTask()
    {
        if ($this->id) {
            $task = Task::find($this->id);
            if ($task) {
                $task->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);
            }
        }else{

            if (empty($this->name) || empty($this->description)) {
                session()->flash('error', 'Todos los campos son obligatorios.');
                return;
            }
            $task = Task::create([
                'name' => $this->name,
                'description' => $this->description,
                'user_id' => Auth::user()->id,
            ]);
        }


    $this->clearFields();
    $this->modal = false;
    $this->tasks = $this->getTasks()->sortByDesc('id');
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }
}