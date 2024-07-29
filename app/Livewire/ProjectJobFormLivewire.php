<?php

namespace App\Livewire;

use App\Livewire\Abstract\FormComponent;
use App\Models\Client;
use App\Models\Geo\City;
use App\Models\Geo\Country;
use App\Models\Geo\Division;
use App\Models\Project;
use App\Models\ProjectJob;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProjectJobFormLivewire extends FormComponent
{
    use LivewireAlert;

    public $jobAdditionalInfo;
    public $clients;
    public $country;
    public $cities;
    public $states;
    public $project;
    public $job;
    public $clientKeyword;

    // PROJECT
    public $clientId;
    public $projectNumber;
    public $propertyType;
    public $propertyOwnerName;
    public $propertyAddress;
    public $propertyState;
    public $propertyCity;
    public $propertyAreaCode;
    public $wetStampMailingAddress;
    public $wetStampCount;
    public $shippingNumber;
    public $inReview;
    public $priorityLevel;
    public $taskPriceTotal;
    public $rfiMessages;
    public $commercialJobPrice;
    public $taskTotal;

    // JOB
    public $projectId;
    public $jobName;
    public $serviceOrderUrl;
    public $serviceOrderForm;
    public $requestNo;
    public $jobNo;
    public $jobStatus;
    public $estimatedCompletion;
    public $estimatedCompletionOverride;
    public $dateReceivedFormula;
    public $dateDue;
    public $dateCompleted;
    public $dateCancelled;
    public $dateSent;
    public $clientName;
    public $clientEmail;
    public $clientEmailOverride;
    public $deliverablesEmail;
    public $additionalInfo;

    public function mount($id = null)
    {   
        $this->project = Project::with('projectJob', 'client')->find($id);
        if($this->project) {
            $this->initModelData($this->project);
            $this->initModelData($this->project->projectJob);
            $this->clientName = $this->project->client->name;
        }

        $this->country = Country::with(['divisions:id,name,country_id'])->first();
        $this->states = $this->country->divisions->sortBy('name')->toArray();

        if($this->project) {
            $this->getCityList();
        }
        
        $this->clients = Client::all()->toArray();
    }

    public function render()
    {
        return view('livewire.project-job-form-livewire');
    }

    public function updated($property)
    {
        if($property == 'project.property_state') {
            $this->getCityList();
            $this->project['property_city'] = null;
        }
    }

    public function updatedClientKeyword($value)
    {
        $this->clients = Client::search($value)->get()->toArray();
    }

    private function getCityList()
    {
        $stateModel = Division::where('name', $this->project['property_state'])->first();
        $this->cities = City::where('division_id', $stateModel->id)->orderBy('name')->get()->toArray();
    }

    public function update()
    {
        // Project Update
        $project = Project::with('projecJob')->find($this->project['id']);
        $project->client_id = $this->clientId;
        $project->project_number = $this->projectNumber;
        $project->property_type = $this->propertyType;
        $project->property_owner_name = $this->propertyOwnerName;
        $project->property_address = $this->propertyAddress;
        $project->property_state = $this->propertyState;
        $project->property_city = $this->propertyCity;
        $project->property_area_code = $this->propertyAreaCode;
        $project->wet_stamp_mailing_address = $this->wetStampMailingAddress;
        $project->wet_stamp_count = $this->wetStampCount;
        $project->shipping_number = $this->shippingNumber;
        $project->priority_level = $this->priorityLevel;
        $project->task_price_total = $this->taskPriceTotal;
        $project->commercial_job_price = $this->commercialJobPrice;
        $project->task_total = $this->taskTotal;
        $project->rfi_messages = $this->rfiMessages;
        $project->save();

        // Job Update
        $job = $project->projecJob;
        $job->job_name = $this->jobName;
        $job->service_order_url = $this->serviceOrderUrl;
        $job->request_no = $this->requestNo;
        $job->job_no = $this->jobNo;
        $job->service_order_form = $this->serviceOrderForm;
        $job->job_status = $this->jobStatus;
        $job->in_review = $this->inReview;
        $job->estimated_completion = $this->estimatedCompletion;
        $job->estimated_completion_override = $this->estimatedCompletionOverride;
        $job->date_received_formula = $this->dateReceivedFormula;
        $job->date_due = $this->dateDue;
        $job->date_completed = $this->dateCompleted;
        $job->date_cancelled = $this->dateCancelled;
        $job->date_sent = $this->dateSent;
        $job->client_name = $this->clientName;
        $job->client_email = $this->clientEmail;
        $job->client_email_override = $this->clientEmailOverride;
        $job->deliverables_email = $this->deliverablesEmail;
        $job->additional_info = $this->additionalInfo;
        $this->alert('success', 'Updated Sucessfully!');
    }
}
