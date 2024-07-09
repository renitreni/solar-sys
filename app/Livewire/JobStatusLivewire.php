<?php

namespace App\Livewire;

use App\Models\JobStatus;
use Livewire\Attributes\On;
use Livewire\Component;

class JobStatusLivewire extends Component
{
    public $jobStatusId;

    public $jobStatusName;

    public function render()
    {
        return view('livewire.job-status-livewire');
    }

    #[On('job-status-edit')]
    public function bindEdit($rowId)
    {
        $jobStatus = JobStatus::find($rowId);
        $this->jobStatusId = $jobStatus->id;
        $this->jobStatusName = $jobStatus->job_status_name;

        $this->js("$('#jobStatusFormModal').modal('show')");
    }

    #[On('job-status-add')]
    public function create()
    {
        $this->jobStatusId = null;
        $this->jobStatusName = null;

        $this->js("$('#jobStatusFormModal').modal('show')");
    }

    public function update()
    {
        $this->validate([
            'jobStatusName' => ['required', 'max:100']
        ]);

        $jobStatus = JobStatus::find($this->jobStatusId);
        $jobStatus->job_status_name = $this->jobStatusName;
        $jobStatus->save();

        $this->js("$('#jobStatusFormModal').modal('hide')");
        $this->dispatch('pg:eventRefresh-JobStatusTable');
    }

    public function store()
    {
        $this->validate([
            'jobStatusName' => ['required', 'max:100']
        ]);

        $jobStatus = new JobStatus();
        $jobStatus->job_status_name = $this->jobStatusName;
        $jobStatus->save();

        $this->js("$('#jobStatusFormModal').modal('hide')");
        $this->dispatch('pg:eventRefresh-JobStatusTable');
    }

    public function destroy()
    {
        $jobStatus = JobStatus::find($this->jobStatusId)->delete();

        $this->js("$('#jobStatusFormModal').modal('hide')");
        $this->dispatch('pg:eventRefresh-JobStatusTable');

    }
}
