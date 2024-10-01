<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class ProjectViewLivewireComponent extends Component
{
    public function render()
    {
        return view('livewire.components.project-view-livewire-component');
    }

    #[On('project-view-modal')]
    public function projectViewModal($rowId)
    {
        $this->js('$("#projectViewModal").modal("show")');
    }
}
