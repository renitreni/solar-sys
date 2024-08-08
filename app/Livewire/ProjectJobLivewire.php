<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ProjectJobLivewire extends Component
{
    public function render()
    {
        return view('livewire.project-job-livewire');
    }

    #[On('edit-project-form')]
    public function bindEdit($rowId)
    {
        $this->redirectRoute('project-job-form.edit', ['id' => $rowId]);
    }
}
