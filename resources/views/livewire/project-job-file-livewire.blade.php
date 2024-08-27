<x-form-view-component>
    <x-slot:title>
        Project Files / {{ $this->project->property_address }}
    </x-slot:title>
    <x-slot:actionButtons>
        <div>
            <a href="{{ route('project-job') }}" type="button" class="btn btn-sm btn-sm btn-black">Cancel</a>
        </div>
    </x-slot:actionButtons>
    <div wire:loading wire:target="removeFile, removeTempFile, uploadDocs">
        <div class="loading-state">
            <div class="loading"></div>
        </div>
    </div>
    <div>
        {{-- ---------------------------- --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Documents</div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            wire:ignore.self type="button" role="tab" aria-controls="home"
                            aria-selected="true">Storage</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            wire:ignore.self type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Upload</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"
                        wire:ignore.self>
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        wire:ignore.self>
                        <div class="row p-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-9" x-data="{ uploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="uploading = true"
                                        x-on:livewire-upload-finish="uploading = false"
                                        x-on:livewire-upload-cancel="uploading = false"
                                        x-on:livewire-upload-error="uploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">Multiple files input
                                                example</label>
                                            <input class="form-control" type="file" id="formFileMultiple"
                                                wire:model.live='tempDocument' multiple>
                                            <!-- Progress Bar -->
                                            <div x-show="uploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                            @error('tempDocument')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary w-100" style="margin-top: 13%;" wire:click='uploadDocs'>Upload</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                @foreach ($tempDocument ?? [] as $key => $document)
                                    <div class="col-md-2">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <h5 class="card-title"></h5>
                                                <p class="card-text">{{ $document->getClientOriginalName() }}</p>
                                                <div class="d-flex w-100 flex-row gap-2">
                                                    <a href="{{ $document->temporaryUrl() }}" target="_blank"
                                                        class="btn btn-primary w-100">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger w-100"
                                                        wire:click='removeTempFile({{ $key }})'>
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

            </div>
        </div>
    </div>
</x-form-view-component>
