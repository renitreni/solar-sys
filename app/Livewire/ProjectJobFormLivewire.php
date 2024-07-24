<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectJobFormLivewire extends Component
{
    public $rfi;

    public $job_addtional_info;

    public $project;
    public $client;

    public function mount($id = null)
    {
        $this->project = Project::find($id)?->toArray();
        if($this->project) {
            $this->client = Client::find($this->project['client_id'])->toArray();
        }
    }

    public function render()
    {
        return view('livewire.project-job-form-livewire');
    }
}
