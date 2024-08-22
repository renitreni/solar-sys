<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectJob;
use App\Models\Service;
use App\Models\Task;
use Firebase\Storage\ServiceStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectJobCreateLivewire extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $clients;

    public $clientName;

    public $clientKeyword;

    public $projectNumber;

    public $propertyAddressKeyword;

    public $propertyAddresses;

    public $isNewProject = 'existing';

    public $services;

    public $servicesSelected;

    public $firebaseStorage;

    #[Validate(['documents.*' => 'max:100000'])]
    public $documents;

    public $clientId;

    public $contactNo;

    public $clientContactNo;

    public $clientEmail;

    public $propertyAddress;

    public $additionalInfo;

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

        if ($value != $this->$key) {
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

    public function selectService($id)
    {
        if(in_array($id, $this->servicesSelected ?? [])) {
            $this->servicesSelected = array_values(array_diff($this->servicesSelected, [$id]));
        } else {
            $this->servicesSelected[] = $id;
        }
    }

    public function store()
    {
        $this->validate([
            'clientId' => 'required',
            'projectNumber' => 'required',
            'documents' => 'required',
            'propertyAddress' => 'required'
        ]);

        // Insert Project
        $project = new Project;
        $project->client_id = $this->clientId;
        $project->project_number = $this->projectNumber;
        $project->property_address = $this->propertyAddress;
        $project->created_by = Auth::id();

        // If exists, get related project
        if ($this->isNewProject == 'existing') {
            $relatedProject = Project::where('property_address', $this->propertyAddress)->first();

            $project->property_owner_name = $relatedProject->property_owner_name;
            $project->property_type = $relatedProject->property_type;
            $project->property_state = $relatedProject->property_state;
            $project->property_city = $relatedProject->property_city;
            $project->property_area_code = $relatedProject->property_area_code;
        }

        $project->save();

        // Insert to Job necessary columns
        $projectJob = new ProjectJob();
        $projectJob->project_id = $project->id;
        $projectJob->additional_info = $this->additionalInfo;
        $projectJob->client_name = $this->clientName;
        $projectJob->client_email = $this->clientEmail;
        $projectJob->save();

        foreach ($this->servicesSelected as $serviceId) {
            $service = Service::find($serviceId);
            // Create tasks
            $task = new Task();
            $task->service_id = $service->id;
            $task->project_id = $project->id;
            $task->price_total = $service->price;
        }

        // Upload files
        $firebaseStorage = new ServiceStorage;
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
            Storage::delete('livewire-tmp/'.$document->getFilename());
            $this->documents = null;
        }

        $this->flash('success', 'Stored Sucessfully!', [], route('project-job-form.edit', ['id' => $project->id]));
    }
}
