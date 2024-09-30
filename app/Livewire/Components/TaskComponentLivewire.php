<?php

namespace App\Livewire\Components;

use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskComponentLivewire extends Component
{
    public $services;

    public $projectId;

    public function mount()
    {
        $this->services = Service::all()->toArray();
    }
    
    public function render()
    {
        return view('livewire.components.task-component-livewire');
    }

    #[On('create-task')]
    public function create($data)
    {
        $this->projectId = $data['projectId'];

        $this->js('$("#task-modal").modal("show")');
    }
}
