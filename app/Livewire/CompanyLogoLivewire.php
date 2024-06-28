<?php

namespace App\Livewire;

use App\Models\GlobalParameter;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyLogoLivewire extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $photo;

    public function save()
    {
        $path = $this->photo->store(path: 'photos/company-logo');

        app(GlobalParameter::class)
            ->where('param_name', 'company-logo')
            ->update(['param_value' => $path]);
    }

    public function removeLogo()
    {
        app(GlobalParameter::class)
            ->where('param_name', 'company-logo')
            ->update(['param_value' => null]);
    }

    public function render()
    {
        return view(
            'livewire.company-logo-livewire',
            ['photoPath' => app(GlobalParameter::class)->getCompanyLogo()]
        );
    }
}
