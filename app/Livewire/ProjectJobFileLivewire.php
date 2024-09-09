<?php

namespace App\Livewire;

use App\Models\Document;
use App\Models\Project;
use Firebase\Storage\ServiceStorage;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectJobFileLivewire extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $project;

    public $documents;

    #[Validate(['documents.*' => 'max:100000'])]
    public $tempDocument;

    public $document;

    private $serviceStorage;

    public function mount($id)
    {
        $this->serviceStorage = new ServiceStorage;
        $this->project = Project::with('projectJob', 'client')->find($id);
        $this->documents = $this->project->documents->toArray();

        $this->documents = array_map(function ($value) {
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

    public function removeTempFile($fileIndex)
    {
        array_splice($this->tempDocument, $fileIndex, 1);
    }

    public function uploadDocs()
    {
        $this->validate([
            'tempDocument' => 'required',
        ]);

        // Upload files
        $firebaseStorage = new ServiceStorage;
        foreach ($this->tempDocument as $document) {
            $item = $firebaseStorage->upload($document)->getItem();
            $signedUrl = $item->signedUrl(now()->addMonth());
            $info = $item->info();

            $this->project->documents()->create([
                'document_path' => $item->name(),
                'document_type' => $info['contentType'],
                'document_size' => $info['size'],
                'document_url' => $signedUrl,
                'bucket_name' => $info['bucket'],
                'object_name' => $info['name'],
            ]);
            Storage::delete('livewire-tmp/'.$document->getFilename());
            $this->tempDocument = null;
        }

        $this->flash('success', 'Uploaded Sucessfully!', [], route('project-job-file', ['id' => $this->project->id]));
    }
}
