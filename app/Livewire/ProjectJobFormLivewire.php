<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Geo\City;
use App\Models\Geo\Country;
use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectJobFormLivewire extends Component
{
    public $rfi;

    public $job_addtional_info;

    public $project;
    public $client;
    public $country;
    public $cities;
    public $states;

    public function mount($id = null)
    {   
        $this->country = Country::with('cities', 'divisions')->first();
        $this->cities = $this->country->cities->sortBy('name');
        $this->states = $this->country->divisions->sortBy('name');
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
