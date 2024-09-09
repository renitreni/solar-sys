<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Company;
use App\Models\Geo\City;
use App\Models\Geo\Country;
use App\Models\Geo\Division;
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
    use LivewireAlert;
    use WithFileUploads;

    public $country;

    public $states;

    public $cities;

    public $propertyState;

    public $propertyCity;

    public $propertyAreaCode;

    public $companies;

    public $companyName;

    public $companyId;

    public $companyKeyword;

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

    public $relatedProject;

    public $propertyOwnerName;

    public $propertyType;

    public function mount()
    {
        $this->services = Service::all()->toArray();
        $this->clients = Client::query()->limit(10)->get()->toArray();
        $this->companies = Company::query()->limit(10)->get()->toArray();
        $this->propertyAddresses = Project::query()->distinct('property_address')->limit(10)->get()->toArray();
        $this->country = Country::with(['divisions:id,name,country_id'])->first();
        $this->states = $this->country->divisions->sortBy('name')->toArray();
    }

    public function render()
    {
        return view('livewire.project-job-create-livewire');
    }

    public function selectBind($values)
    {
        foreach ($values as $key => $value) {
            $this->clientIdChanged($key, $value);
            $this->propertyAddressChanged($key, $value);
            $this->$key = $value;
        }
    }

    public function updatedClientKeyword($value)
    {
        $this->clients = Client::search($value)->get()->toArray();
    }

    public function updatedCompanyKeyword($value)
    {
        $this->companies = Company::search($value)->get()->toArray();
    }

    public function updatedPropertyAddressKeyword($value)
    {
        $this->propertyAddresses = Project::search($value)->get()->unique('property_address')->toArray();
    }

    public function updatedPropertyState($value)
    {
        $this->propertyCity = null;
        $stateModel = Division::where('name', $value)->first();
        $this->cities = City::where('division_id', $stateModel->id)->get()->toArray();
    }

    private function propertyAddressChanged($key, $value)
    {
        if ($key != 'propertyAddress') {
            return false;
        }

        if ($value != $this->$key) {
            $this->relatedProject = Project::where('property_address', $value)->orderBy('created_at')->first();
            $this->projectNumber = $this->relatedProject->project_number;
            $this->propertyOwnerName = $this->relatedProject->property_owner_name;
            $this->propertyType = $this->relatedProject->property_type;
            $this->propertyState = $this->relatedProject->property_state;
            $this->updatedPropertyState($this->propertyState);
            $this->propertyCity = $this->relatedProject->property_city;
        }
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
        $this->propertyAddressKeyword = null;
        $this->propertyOwnerName = null;
        $this->propertyAddress = null;
        $this->projectNumber = null;
        $this->propertyState = null;
        $this->propertyCity = null;
    }

    public function removeTempFile($fileIndex)
    {
        array_splice($this->documents, $fileIndex, 1);
    }

    public function selectService($id)
    {
        if (in_array($id, $this->servicesSelected ?? [])) {
            $this->servicesSelected = array_values(array_diff($this->servicesSelected, [$id]));
        } else {
            $this->servicesSelected[] = $id;
        }
    }

    public function storeView()
    {
        $this->flash('success', 'Stored Sucessfully!', [], route('project-job-form.edit', ['id' => $this->store()]));
    }

    public function storeCreate()
    {
        $this->store();

        $this->flash('success', 'Stored Sucessfully!', [], route('project-job-form'));
    }

    public function storeExit()
    {
        $this->store();

        $this->flash('success', 'Stored Sucessfully!', [], route('project-job'));
    }

    private function store()
    {
        $this->validate([
            'clientId' => 'required',
            'projectNumber' => 'required',
            'propertyAddress' => 'required',
        ]);

        // Insert Project
        $project = new Project;
        $project->client_id = $this->clientId;
        $project->project_number = $this->projectNumber;
        $project->property_address = $this->propertyAddress;
        $project->company_id = $this->companyId;
        $project->created_by = Auth::id();
        $project->property_type = $this->propertyType;

        // If exists, get related project
        if ($this->isNewProject == 'existing') {
            $project->property_owner_name = $this->relatedProject->property_owner_name;
            $project->property_state = $this->relatedProject->property_state;
            $project->property_city = $this->relatedProject->property_city;
            $project->property_area_code = $this->relatedProject->property_area_code;
        }

        $project->save();

        // Insert to Job necessary columns
        $projectJob = new ProjectJob;
        $projectJob->project_id = $project->id;
        $projectJob->additional_info = $this->additionalInfo;
        $projectJob->client_name = $this->clientName;
        $projectJob->client_email = $this->clientEmail;
        $projectJob->save();

        foreach ($this->servicesSelected as $serviceId) {
            $service = Service::find($serviceId);
            // Create tasks
            $task = new Task;
            $task->service_id = $service->id;
            $task->project_id = $project->id;
            $task->price_total = $service->price;
            $task->save();
        }

        // Upload files
        $firebaseStorage = new ServiceStorage;
        foreach ($this->documents ?? [] as $document) {
            $item = $firebaseStorage->upload($document)->getItem();
            $signedUrl = $item->signedUrl(now()->addMonth());
            $info = $item->info();

            $project->documents()->create([
                'document_path' => $item->name(),
                'document_type' => $info['contentType'],
                'document_size' => $info['size'],
                'document_url' => $signedUrl,
                'bucket_name' => $info['bucket'],
                'object_name' => $info['name'],
            ]);
            Storage::delete('livewire-tmp/'.$document->getFilename());
            $this->documents = null;
        }

        return $project->id;
    }
}
