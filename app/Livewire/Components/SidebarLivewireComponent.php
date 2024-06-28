<?php

namespace App\Livewire\Components;

use App\Models\GlobalParameter;
use Livewire\Component;

class SidebarLivewireComponent extends Component
{
    public function render()
    {
        return view(
            'livewire.components.sidebar-livewire-component',
            ['photoPath' => app(GlobalParameter::class)->getCompanyLogo()]
        );
    }
}
