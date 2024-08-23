<x-form-view-component>
    <x-slot:title>
        Project Files / {{ $this->project->property_address }}
    </x-slot:title>
    <x-slot:actionButtons>
        <div>
            <a href="{{ route('project-job') }}" type="button" class="btn btn-sm btn-sm btn-black">Cancel</a>
        </div>
    </x-slot:actionButtons>
    <div>
        {{-- ---------------------------- --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Documents</div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($documents ?? [] as $document)
                        <div class="col-md-2">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">{{ explode('-#-', $document['document_path'])[1] }}</p>
                                    <div class="d-flex w-100 flex-row gap-2">
                                        <a href="{{ $document['document_url'] }}" target="_blank"
                                            class="btn btn-primary w-100">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger w-100"
                                            wire:click='removeFile({{ $document['id'] }})'>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-form-view-component>
