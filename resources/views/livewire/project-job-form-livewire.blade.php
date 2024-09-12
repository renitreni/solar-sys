<x-form-view-component>
    <x-slot:title>
        Edit Job
    </x-slot:title>
    <x-slot:actionButtons>
        <div>
            <a href="{{ route('project-job-form.edit', ['id' => $this->projectId]) }}" type="button" class="btn btn-sm btn-sm btn-black">Cancel</a>
        </div>
        <div>
            <button type="button" wire:click='update' class="btn btn-sm btn-primary">Update</button>
        </div>
        <div>
            <a href="{{ route('project-job-file', ['id' => $this->projectId ]) }}" target="_blank" class="btn btn-sm btn-primary">Project Files</a>
        </div>
    </x-slot:actionButtons>

    <div class="accordion">
        {{-- ---------------------------- Projects --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Project</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <x-select-options-component :lists='$companies' keyword='companyKeyword' idKey='id'
                            labelKey='company_name' inputId='companyId' :inputName='$companyName' :livewireId='$this->__id'>
                            <x-slot:label>Company</x-slot:label>
                        </x-select-options-component>
                        @error('companyId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <x-select-options-component :lists='$clients' keyword='clientKeyword' idKey='id'
                            labelKey='name' inputId='clientId' :inputName='$clientName' :livewireId='$this->__id'>
                            <x-slot:label>Client</x-slot:label>
                        </x-select-options-component>
                        @error('clientId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Project Number</label>
                            <input type="text" class="form-control" wire:model='projectNumber'>
                        </div>
                        @error('projectNumber')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        @if ($projectId)
                            <div class="form-group">
                                <label>Property Address</label>
                                <input type="text" class="form-control" wire:model='propertyAddress'>
                            </div>
                        @else
                            <x-select-options-component :lists='$propertyAddresses' keyword='propertyAddressKeyword'
                                idKey='property_address' labelKey='property_address' inputId='propertyAddress'
                                openSelect=true :inputName='$propertyAddress'>
                                <x-slot:label>Property Address</x-slot:label>
                            </x-select-options-component>
                        @endif
                        @error('propertyAddress')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property Owner Name</label>
                            <input type="text" class="form-control" wire:model='propertyOwnerName'>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property Type</label>
                            <select class="form-control form-select" wire:model='propertyType'>
                                <option value="">-- Select Option --</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property State</label>
                            <select class="form-select form-control" wire:model.live='propertyState'>
                                <option value="">-- Select Option --</option>
                                @foreach ($states as $division)
                                    <option value="{{ $division['name'] }}">{{ $division['name'] }}</option>
                                @endforeach
                            </select>
                            @error('propertyState')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property City</label>
                            <select class="form-select form-control" wire:model.live="propertyCity">
                                <option value="">-- Select Option --</option>
                                @foreach ($cities ?? [] as $city)
                                    <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                            @error('propertyCity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property Area Code</label>
                            <input type="text" class="form-control" wire:model='propertyAreaCode'>
                            @error('propertyAreaCode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mailing Address for Wet Stamps</label>
                            <input type="text" class="form-control" wire:model='wetStampMailingAddress'>
                        </div>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Number of Wet Stamps</label>
                            <input type="text" class="form-control" wire:model='wetStampCount'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ---------------------------- Related Jobs --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Related Jobs</div>
            </div>
            <div class="card-body">
                <livewire:components.related-job-livewire-components></livewire:components.related-job-livewire-components>
            </div>
        </div>
        {{-- ---------------------------- JOB --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Job</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service Order Link</label>
                            <input type="text" class="form-control" wire:model='serviceOrderUrl'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service Order Form</label>
                            <input type="text" class="form-control" wire:model='serviceOrderForm'>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-auto">
                        <div class="form-group d-flex flex-column">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault"
                                    wire:model='inReview'>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Please check this if job is currently in-review.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Job Request #</label>
                            <input type="text" class="form-control" wire:model='requestNo'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Job Number</label>
                            <input type="text" class="form-control" wire:model='jobNo'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Job Status</label>
                            <input type="text" class="form-control" wire:model='jobStatus'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Date Received Formula</label>
                            <input type="text" class="form-control date-control" wire:model='dateReceivedFormula'
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Date Due</label>
                            <input type="text" class="form-control date-control" wire:model='dateDue' readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Date Completed</label>
                            <input type="text" class="form-control date-control" wire:model='dateCompleted'
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Date Sent to Client</label>
                            <input type="text" class="form-control date-control" wire:model='dateSent' readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Client Name</label>
                            <input type="text" class="form-control" wire:model='clientName'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Client Contact E-mail</label>
                            <input type="text" class="form-control" wire:model='clientEmail'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Client Contact E-mail Override</label>
                            <input type="text" class="form-control" wire:model='clientEmailOverride'>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Deliverables Email</label>
                            <input type="text" class="form-control" wire:model='deliverablesEmail'>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" wire:ignore>
                            <label>Additional Information From Client</label>
                            <!-- Create the editor container -->
                            <div id="client-request-editor" style="height:180px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ---------------------------- RFI --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">RFI (Request for Information)</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" wire:ignore>
                            <label>Enter your request</label>
                            <!-- Create the editor container -->
                            <div id="rfi-editor" style="height:180px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ---------------------------- Tracking Numbers --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tracking Numbers</div>
            </div>
            <div class="card-body">

            </div>
        </div>
        {{-- ---------------------------- Tasks --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tasks</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <livewire:task-table/>
                    </div>
                    <div class="col-md-4">
                        <label for="">Task Price Total</label>
                        <input type="number" class="form-control" wire:model='taskPriceTotal'>
                    </div>
                    <div class="col-md-4">
                        <label for="">Commercial Job Price</label>
                        <input type="number" class="form-control" wire:model='commercialJobPrice'>
                    </div>
                    <div class="col-md-4">
                        <label for="">Total</label>
                        <input type="number" class="form-control" wire:model='taskTotal'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-form-view-component>

@push('scripts')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(document).ready(function() {
            const quill = new Quill('#client-request-editor', {
                theme: 'snow'
            });
            const quill2 = new Quill('#rfi-editor', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                let value = $('#client-request-editor > .ql-editor').html();
                @this.set('additionalInfo', value)
            })

            quill2.on('text-change', function() {
                let value = $('#rfi-editor > .ql-editor').html();
                @this.set('rfiMessages', value)
            })

            $('#rfi-editor > .ql-editor').html('{!! $rfiMessages !!}');
            $('#client-request-editor > .ql-editor').html('{!! $additionalInfo !!}');

            $('.date-control').flatpickr({
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });

            @this.dispatch('related-job-table', {
                'projectId': '{{ $projectId }}',
                'propertyAddress': `{{ $propertyAddress }}`
            });

            
        });
    </script>
@endpush

@push('styles')
    <!-- Styles -->
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush
