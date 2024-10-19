<?php

namespace App\Livewire\Components;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectViewLivewireComponent extends Component
{
    public $project;

    public function render()
    {
        return view('livewire.components.project-view-livewire-component');
    }

    #[On('project-view-modal')]
    public function projectViewModal($rowId)
    {
        $this->project = Project::with('projectJob', 'client', 'company')->find($rowId)->toArray();

        $this->dispatch('related-job-table', $this->project['id'], $this->project['property_address']);
        $this->js('$("#projectViewModal").modal("show")');
    }
}
