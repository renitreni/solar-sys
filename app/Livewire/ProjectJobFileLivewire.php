<?php

namespace App\Livewire;

use App\Models\Document;
use App\Models\Project;
use Firebase\Storage\ServiceStorage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectJobFileLivewire extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $project;

    public $documents;

    public $document;

    private $serviceStorage;

    public function mount($id)
    {
        $this->serviceStorage = new ServiceStorage;
        $this->project = Project::with('projectJob', 'client')->find($id);
        $this->documents = $this->project->documents->toArray();

        $this->documents = array_map(function($value) {
            $value['document_url'] = $this->serviceStorage->getSignedUrl($value['object_name']); 
            return $value;
        }, $this->documents);
    }

    public function render()
    {
        return view('livewire.project-job-file-livewire');
    }

    public function removeFile($id)
    {
        $this->serviceStorage = new ServiceStorage;
        $this->document = Document::find($id);
        
        $this->serviceStorage->delete($this->document->object_name);
        $this->document->delete();

        $this->project = Project::with('projectJob', 'client')->find($this->project->id);
        $this->documents = $this->project->documents->toArray();
    }
}
