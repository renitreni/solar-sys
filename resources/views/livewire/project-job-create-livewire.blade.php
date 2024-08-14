<x-form-view-component>
    <x-slot:title>
        Create Service Order
    </x-slot:title>
    <x-slot:actionButtons>
        <div>
            <a href="{{ route('project-job') }}" type="button" class="btn btn-sm btn-sm btn-black">Cancel</a>
        </div>
        <div>
            <button type="button" wire:click='store' class="btn btn-sm btn-primary">Save</button>
        </div>
    </x-slot:actionButtons>

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
                    <div class="row col-md-6">
                        <div class="col-md-10 pe-0">
                            <x-select-options-component :lists='$clients' keyword='clientKeyword' idKey='id'
                                labelKey='name' inputId='clientId' :inputName='$clientName' :livewireId='$this->__id'>
                                <x-slot:label>Client Name</x-slot:label>
                            </x-select-options-component>
                        </div>
                        <div class="col-md-2 p-0" x-data="{}">
                            <div class="d-flex flex-column" style="margin-top: 30%;">
                                <button type="button" class="btn btn-primary" @click="$dispatch('client-add')">Add Client</button>
                            </div>
                        </div>
                        <livewire:components.client-form-livewire-component></livewire:components.client-form-livewire-component>
                        @error('clientId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Client Contact</label>
                            <input type="text" class="form-control" wire:model.live='clientContactNo' disabled>
                            @error('clientContactNo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
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
                                        New Project
                                    </span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="existing"
                                        wire:model.live='isNewProject' class="selectgroup-input" checked="">
                                    <span class="selectgroup-button selectgroup-button-icon">
                                        Existing Project
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($isNewProject === 'new')
                            New Project Address
                        @endif
                        @if($isNewProject === 'existing')
                            Existing Address
                        @endif
                        <div class="form-group">
                            <label>New Project Address</label>
                            <input type="text" class="form-control" wire:model.live='propertyAddress'>
                        </div>
                        <div>
                            <x-select-options-component :lists='$propertyAddresses' keyword='propertyAddressKeyword'
                                idKey='property_address' labelKey='property_address' inputId='propertyAddress'
                                openSelect=true :inputName='$propertyAddress'>
                                <x-slot:label>Existing Project Address</x-slot:label>
                            </x-select-options-component>
                            @error('propertyAddress')
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
                    User Info
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User's Name</label>
                            <input type="text" class="form-control" value='{{ auth()->user()->name }}' disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User's E-mail</label>
                            <input type="text" class="form-control" value='{{ auth()->user()->email }}' disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-form-view-component>
