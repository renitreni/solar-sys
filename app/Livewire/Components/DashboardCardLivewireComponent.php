<?php

namespace App\Livewire\Components;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Number;
use Livewire\Component;

class DashboardCardLivewireComponent extends Component
{
    public $userCount;
    public $clientCount;
    public $taskTotal;
    public $projectCount;

    public function mount()
    {
        $this->userCount = User::count('id');
        $this->clientCount = Client::count('id');
        $this->taskTotal = Number::currency(Task::sum('price_total'));
        $this->projectCount = Project::count();
    }

    public function render()
    {
        return view('livewire.components.dashboard-card-livewire-component');
    }
}
