<x-form-view-component>
    <x-slot:title>Create Job</x-slot:title>
    <x-slot:actionButtons>
        <div>
            <a href="{{ route('project-job') }}" type="button" class="btn btn-sm btn-sm btn-black">Cancel</a>
        </div>
        <div>
            @if ($projectId)
                <button type="button" wire:click='update' class="btn btn-sm btn-primary">Update</button>
            @else
                <button type="button" wire:click='store' class="btn btn-sm btn-primary">Save</button>
            @endif
        </div>
    </x-slot:actionButtons>

    <div class="accordion">
        {{-- ---------------------------- --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Project</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">
                            <x-select-options-component :keyword='$clientKeyword' :lists='$clients' idKey='id'
                                labelKey='name' inputName='clientName' inputKeyword='clientKeyword'>
                                <x-slot:label>Client</x-slot:label>
                            </x-select-options-component>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Number</label>
                                <input type="text" class="form-control" wire:model='projectNumber'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Property Type</label>
                                <select class="form-select" wire:model='propertyType'>
                                    <option value="">-- Select Option --</option>
                                    <option value="residential">Residential</option>
                                    <option value="commercial">Commercial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Property Owner Name</label>
                                <input type="text" class="form-control" wire:model='propertyOwnerName'>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <x-select-options-component :keyword='$propertyAddressKeyword' :lists='$propertyAddresses' 
                            idKey='property_address'
                            labelKey='property_address' 
                            inputName='propertyAddress' 
                            inputKeyword='propertyAddressKeyword'
                            openSelect=true>
                                <x-slot:label>Property Address</x-slot:label>
                            </x-select-options-component>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 shadow-sm h-100">
                            Map here.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property Area Code</label>
                            <input type="text" class="form-control" wire:model='propertyAreaCode'>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property State</label>
                            <select class="form-select" wire:model.live='propertyState'>
                                <option value="">-- Select Option --</option>
                                @foreach ($states as $division)
                                    <option value="{{ $division['name'] }}">{{ $division['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Property City</label>
                            <select class="form-select" wire:model.live="propertyCity">
                                <option value="">-- Select Option --</option>
                                @foreach ($cities ?? [] as $city)
                                    <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mailing Address for Wet Stamps</label>
                            <input type="text" class="form-control" wire:model='wetStampMailingAddress'>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Number of Wet Stamps</label>
                            <input type="text" class="form-control" wire:model='wetStampCount'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ---------------------------- --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Related Jobs</div>
            </div>
            <div class="card-body">

            </div>
        </div>
        {{-- ---------------------------- --}}
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
                            <label class="form-label">In Review</label>
                            <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="1" wire:model='inReview'
                                        class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fa fa-check"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="0" wire:model='inReview'
                                        class="selectgroup-input" checked="">
                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fa fa-times"></i></span>
                                </label>
                            </div>
                        </div>
                    </div>
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
                            <label>Estimated Days to Complete</label>
                            <input type="text" class="form-control date-control" wire:model='estimatedCompletion'
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Estimated Days to Complete Override</label>
                            <input type="text" class="form-control date-control"
                                wire:model='estimatedCompletionOverride' readonly>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
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
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Date Completed</label>
                            <input type="text" class="form-control date-control" wire:model='dateCompleted'
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Date Cancelled</label>
                            <input type="text" class="form-control date-control" wire:model='dateCancelled'
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>Date Sent to Client</label>
                            <input type="text" class="form-control date-control" wire:model='dateSent' readonly>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Client Contact</label>
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
        {{-- ---------------------------- --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">RFI (Request for Information)</div>
                {{ $rfiMessages }}
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
        {{-- ---------------------------- --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tracking Numbers</div>
            </div>
            <div class="card-body">

            </div>
        </div>
        {{-- ---------------------------- --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tasks</div>
            </div>
            <div class="card-body">
                <div class="row">
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
        window.addEventListener('load', function() {
            // Select all elements with the 'hidden' attribute
            const hiddenElements = document.querySelectorAll('[hidden]');

            // Iterate over the NodeList and remove the 'hidden' attribute from each element
            hiddenElements.forEach(element => {
                element.removeAttribute('hidden');
            });
        });

        function dropdownSearchClient() {
            return {
                hideClient: true,
                actionSelect(id, label) {
                    this.hideClient = !this.hideClient;
                    @this.set('clientId', id)
                    @this.set('clientName', label)
                    @this.set('clientKeyword', '')
                }
            }
        }

        function dropdownSearch() {
            return {
                hide: true,
                actionSelect(id, label) {
                    this.hide = !this.hide;
                    @this.set('propertyAddress', label)
                    @this.set('propertyAddressKeyword', '')
                }
            }
        }
        $(document).ready(function() {
            const quill = new Quill('#rfi-editor', {
                theme: 'snow'
            });
            const quill2 = new Quill('#client-request-editor', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                let value = document.getElementsById('ql-editor')[0].innerHTML;
                @this.set('rfiMessages', value)
            })

            quill2.on('text-change', function() {
                let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
                @this.set('additionalInfo', value)
            })

            quill.setText('{{ $rfiMessages }}');
            quill2.setText('{{ $additionalInfo }}');

            $('.date-control').flatpickr({
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endpush

@push('styles')
    <!-- Styles -->
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush
