<?php

namespace App\Livewire\Components;

use App\Models\Service;
use App\Models\Task;
use App\Services\TaskService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskComponentLivewire extends Component
{
    use LivewireAlert;

    public $services;

    public $projectId;

    public $serviceId;

    public $taskId;

    public $price;

    public function mount()
    {
        $this->services = Service::query()->orderBy('service_name')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.components.task-component-livewire');
    }

    #[On('create-task')]
    public function showModalCreate($data)
    {
        $this->resetExcept(['services']);
        $this->projectId = $data['projectId'];

        $this->js('$("#task-modal").modal("show")');
    }

    public function updatedServiceId($value)
    {
        $this->price = Service::find($value)->price;
    }

    public function create()
    {
        $this->validate([
            'serviceId' => 'required',
            'price' => ['required', 'numeric'],
        ]);

        $projectTask = new Task();
        $projectTask->price = $this->price;
        $projectTask->service_id = $this->serviceId;
        $projectTask->project_id = $this->projectId;
        $projectTask->save();

        $this->js('$("#task-modal").modal("hide")');
        $this->alert('success', 'Created Task Sucessfully!');
        $this->dispatch('pg:eventRefresh-TaskTable');
        $this->resetExcept(['services']);
    }

    #[On('edit-task')]
    public function showModalEdit($data)
    {
        $this->resetExcept(['services']);
        $this->taskId = $data['id'];
        $this->projectId = $data['project_id'];
        $this->serviceId = $data['service_id'];
        $this->price = $data['price'];

        $this->js('$("#task-modal").modal("show")');
    }

    public function update() {
        $this->validate([
            'serviceId' => 'required',
            'price' => ['required', 'numeric'],
        ]);

        $projectTask = Task::find($this->taskId);
        $projectTask->price = $this->price;
        $projectTask->service_id = $this->serviceId;
        $projectTask->project_id = $this->projectId;
        $projectTask->save();

        $this->js('$("#task-modal").modal("hide")');
        $this->alert('success', 'Updated Task Sucessfully!');
        $this->dispatch('pg:eventRefresh-TaskTable');
        $this->resetExcept(['services']);
    }

    public function delete() {
        $this->validate([
            'serviceId' => 'required',
            'price' => ['required', 'numeric'],
        ]);

        Task::destroy($this->taskId);

        $this->js('$("#task-modal").modal("hide")');
        $this->alert('success', 'Deleted Task Sucessfully!');
        $this->dispatch('pg:eventRefresh-TaskTable');
        $this->resetExcept(['services']);
    }
}