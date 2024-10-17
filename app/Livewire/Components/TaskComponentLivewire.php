<?php

namespace App\Livewire\Components;

use App\Models\Service;
use App\Models\Task;
use App\Models\TaskAsignee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    public $userList;

    public $assignees;

    public $selectedAssignee;

    public $otherDescription;

    public $notes;

    public function mount()
    {
        $this->services = Service::query()->orderBy('service_name')->get()->toArray();
        $this->userList = User::query()->orderBy('name')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.components.task-component-livewire');
    }

    #[On('create-task')]
    public function showModalCreate($data)
    {
        $this->resetExcept(['services', 'userList']);
        $this->projectId = $data['projectId'];
        $this->js('$("#task-modal").modal("show")');
        $this->js('loadNotesTaskQuill()');
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

        $projectTask = new Task;
        $projectTask->price = $this->price;
        $projectTask->service_id = $this->serviceId;
        $projectTask->project_id = $this->projectId;
        $projectTask->other_description = $this->otherDescription;
        $projectTask->notes = $this->notes;
        $projectTask->save();

        $this->alert('success', 'Created Task Sucessfully!');
        $this->js('$("#task-modal").modal("hide")');
        $this->dispatch('pg:eventRefresh-TaskTable');
        $this->resetExcept(['services', 'userList']);
    }

    #[On('edit-task')]
    public function showModalEdit($data)
    {
        $this->resetExcept(['services', 'userList']);
        $this->taskId = $data['id'];
        $this->assignees = $data['assignees'];
        $this->projectId = $data['project_id'];
        $this->serviceId = $data['service_id'];
        $this->otherDescription = $data['other_description'];
        $this->notes = $data['notes'];
        $this->price = $data['price'];
        
        $this->js('$("#task-modal").modal("show")');
        $this->js("$('#task-note-editor > .ql-editor').html('".$this->notes."');");
        $this->js("$('#other-description-editor > .ql-editor').html('".$this->otherDescription."');");
    }

    public function update()
    {
        $this->validate([
            'serviceId' => 'required',
            'price' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();

        $projectTask = Task::find($this->taskId);
        $projectTask->price = $this->price;
        $projectTask->service_id = $this->serviceId;
        $projectTask->project_id = $this->projectId;
        $projectTask->other_description = $this->otherDescription;
        $projectTask->notes = $this->notes;
        $projectTask->save();

        foreach ($this->assignees as $assignee) {
            TaskAsignee::query()
                ->updateOrCreate(['task_id' => $this->taskId, 'assigned_to' => $assignee['assigned_to']], $assignee);
        }

        DB::commit();

        $this->alert('success', 'Updated Task Sucessfully!');
        $this->js('$("#task-modal").modal("hide")');
        $this->dispatch('pg:eventRefresh-TaskTable');
        $this->resetExcept(['services', 'userList']);
    }

    public function delete()
    {
        $this->validate([
            'serviceId' => 'required',
            'price' => ['required', 'numeric'],
        ]);

        TaskAsignee::where('task_id', $this->taskId)->delete();
        Task::destroy($this->taskId);

        $this->alert('success', 'Deleted Task Sucessfully!');
        $this->js('$("#task-modal").modal("hide")');
        $this->dispatch('pg:eventRefresh-TaskTable');
        $this->resetExcept(['services', 'userList']);
    }

    public function addAssignee()
    {
        $this->validate(['selectedAssignee' => ['required']]);

        $hasAssigned = array_filter($this->assignees, fn($value) => $this->selectedAssignee == $value['assigned_to']);
        if ($hasAssigned) {
            $this->addError('selectedAssignee', 'Assignee already exists.');
            return false;
        }
        $user = User::find($this->selectedAssignee);
        $this->assignees[] = [
            "task_id" => $this->taskId,
            "assignee_name" => $user->name,
            "assigned_to" => $user->id
        ];
        $this->selectedAssignee = '';
    }

    public function deleteAssignee($assigned_id)
    {
        TaskAsignee::query()->where('task_id', $this->taskId)->where('assigned_to', $assigned_id)->delete();
        $hasAssigned = array_filter($this->assignees, fn($value) => $assigned_id != $value['assigned_to']);
        $this->assignees = $hasAssigned;
    }
}
