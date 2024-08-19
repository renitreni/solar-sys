<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Project;
use App\Models\Service;
use Firebase\Storage\ServiceStorage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Livewire\WithFileUploads;

class ProjectJobCreateLivewire extends Component
{
    use WithFileUploads;

    public $clients;
    public $clientName;
    public $clientKeyword;
    public $projectNumber;
    public $propertyAddressKeyword;
    public $propertyAddresses;
    public $isNewProject = 'existing';
    public $services;
    public $firebaseStorage;

    #[Validate(['documents.*' => 'max:100000'])]
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
        if ($key != 'clientId') {
            return false;
        }

        if ($this->$key != $value) {
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

    public function store()
    {
        $this->validate([
            'clientId' => 'required',
            'projectNumber' => 'required',
        ]);

        $project = new Project();
        $project->client_id = $this->clientId;
        $project->project_number = $this->projectNumber;
        $project->save();

        $firebaseStorage = new ServiceStorage();
        foreach ($this->documents as $document) {
            $item = $firebaseStorage->upload($document)->getItem();
            $signedUrl = $item->signedUrl(now()->addMonth());
            $info = $item->info();
            $project->documents()->create([
                'document_path' => $item->name(),
                'document_type' => $info['contentType'],
                'document_size' => $info['size'],
                'document_url' => $signedUrl,
            ]);
        }
        $this->clearTempFiles();
    }

    public function clearTempFiles()
    {
        //
    }
}
