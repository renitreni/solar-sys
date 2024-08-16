<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Project;
use App\Models\Service;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectJobCreateLivewire extends Component
{
    use WithFileUploads;
    
    public $clients;
    public $clientName;
    public $clientKeyword;
    public $propertyAddressKeyword;
    public $propertyAddresses;
    public $isNewProject = 'existing';
    public $services;
    
    #[Validate(['documents.*' => 'image|max:1024'])]
    public $documents;

    public $clientId;
    public $contactNo;
    public $clientContactNo;
    public $clientEmail;
    public $propertyAddress;

    public function mount()
    {
        $this->services = Service::all()->toArray();
        $this->clients = Client::query()->limit(10)->get()->toArray();
        $this->propertyAddresses = Project::query()->distinct('property_address')->limit(10)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.project-job-create-livewire');
    }

    public function selectBind($values)
    {
        foreach ($values as $key => $value) {
            $this->clientIdChanged($key, $value);
            $this->$key = $value;
        }
    }

    public function updatedClientKeyword($value)
    {
        $this->clients = Client::search($value)->get()->toArray();
    }

    public function updatedPropertyAddressKeyword($value)
    {
        $this->propertyAddresses = Project::search($value)->get()->unique('property_address')->toArray();
    }

    private function clientIdChanged($key, $value)
    {
        if($key != 'clientId') {
            return false;
        }

        if($this->$key != $value) {
            $client = Client::find($value);
            $this->clientContactNo = $client->contact_no;
            $this->clientEmail = $client->email;
        }
    }

    public function updatedIsNewProject()
    {
        $this->propertyAddress = null;
        $this->propertyAddressKeyword = null;
    }

    public function removeTempFile($fileIndex)
    {
        array_splice($this->documents, $fileIndex, 1);
    }
}
