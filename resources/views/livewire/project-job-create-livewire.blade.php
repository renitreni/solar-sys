<x-form-view-component>
    <x-slot:title>
        Create Service Order
    </x-slot:title>
    <x-slot:actionButtons>
        <div>
            <a href="{{ route('project-job') }}" type="button" class="btn btn-sm btn-sm btn-black">Cancel</a>
        </div>
        <div>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#saveModal">Save</button>
        </div>
    </x-slot:actionButtons>
    <div wire:loading wire:target="storeView, storeCreate, storeExit">
        <div class="loading-state">
            <div class="loading"></div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveModalLabel">Saving Prompt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you wish to continue?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click='storeView'>Save &
                        View Details</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click='storeCreate'>Save
                        & Create New</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click='storeExit'>Save & Exit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column">
        {{-- ====================== --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Organization
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row col-md-4">
                        <div class="col-md-9 pe-0">
                            <x-select-options-component :lists='$clients' keyword='clientKeyword' idKey='id'
                                labelKey='name' inputId='clientId' :inputName='$clientName' :livewireId='$this->__id'>
                                <x-slot:label>Client Name</x-slot:label>
                            </x-select-options-component>
                        </div>
                        <div class="col-md-3 p-0" x-data="{}">
                            <div class="d-flex flex-column" style="margin-top: 35%;">
                                <button type="button" class="btn text-nowrap btn-primary"
                                    @click="$dispatch('client-add')">Add
                                    Client</button>
                            </div>
                        </div>
                        @error('clientId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <livewire:components.client-form-livewire-component></livewire:components.client-form-livewire-component>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Client Contact</label>
                            <input type="text" class="form-control" wire:model.live='clientContactNo' disabled>
                            @error('clientContactNo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Client E-mail</label>
                            <input type="text" class="form-control" wire:model.live='clientEmail' disabled>
                            @error('clientEmail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ====================== --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Project Allocation
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-auto">
                        <div class="form-group d-flex flex-column">
                            <label class="form-label">Allocation</label>
                            <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="new"
                                        wire:model.live='isNewProject' class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon">
                                        New
                                    </span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="existing"
                                        wire:model.live='isNewProject' class="selectgroup-input" checked="">
                                    <span class="selectgroup-button selectgroup-button-icon">
                                        Existing
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if ($isNewProject == 'new')
                            <div class="form-group">
                                <label>New Project Address</label>
                                <input type="text" class="form-control" wire:model.live='propertyAddress'>
                            </div>
                        @endif
                        @if ($isNewProject == 'existing')
                            <x-select-options-component :lists='$propertyAddresses' keyword='propertyAddressKeyword'
                                idKey='property_address' labelKey='property_address' inputId='propertyAddress'
                                openSelect=true :inputName='$propertyAddress'>
                                <x-slot:label>Existing Project Address</x-slot:label>
                            </x-select-options-component>
                        @endif
                        @error('propertyAddress')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Project Number</label>
                            <input type="text" class="form-control" wire:model.live='projectNumber'>
                            @error('projectNumber')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Property Owner Name</label>
                            <input type="text" class="form-control" wire:model.live='propertyOwnerName'>
                            @error('propertyOwnerName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ====================== --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Created By
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User's Name</label>
                            <input type="text" class="form-control" value='{{ auth()->user()->name }}' readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User's E-mail</label>
                            <input type="text" class="form-control" value='{{ auth()->user()->email }}' readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ====================== --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Services
                </div>
            </div>
            <div class="card-body">
                <div class="row mx-3">
                    @foreach ($services as $service)
                        <div class="col-md-3 p-2">
                            <input type="checkbox" class="btn-check btn-check-services"
                                id="btn-services{{ $service['id'] }}" autocomplete="off"
                                wire:click='selectService({{ $service['id'] }})'>
                            <label class="btn btn-outline-info w-100"
                                for="btn-services{{ $service['id'] }}">{{ $service['service_name'] }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Additional Information</label>
                            <textarea class="form-control" wire:model='additionalInfo'></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ====================== --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Document Downloads
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                            <input class="form-control" type="file" id="formFileMultiple"
                                wire:model.live='documents' multiple>
                            <!-- Progress Bar -->
                            <div x-show="uploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                            @error('documents')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($documents ?? [] as $key => $document)
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
</x-form-view-component>
