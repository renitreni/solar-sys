<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProjectJobLivewire extends Component
{
    public function render()
    {
        // dump($crypt);
        // dump(Hash::check(1, $crypt));
        return view('livewire.project-job-livewire');
    }
}
