<div class="page-inner">
    @push('styles')
        <!-- Include stylesheet -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Create Job</h3>
            <div class="op-7 mb-2">
                <div class="d-flex gap-2">
                    <div>
                        <a href="{{ route('project-job') }}" type="button" class="btn btn-sm btn-sm btn-black">Cancel</a>
                    </div>
                    <div>
                        <a href="{{ route('project-job-form') }}" type="button"
                            class="btn btn-sm btn-sm btn-primary">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="accordion" id="accordionPanelsStayOpen">
            {{-- ---------------------------- --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-11" aria-expanded="true" aria-controls="panelsStayOpen-11">
                        Project
                    </button>
                </h2>
                <div id="panelsStayOpen-11" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-1">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-3" wire:ignore>
                                <div class="form-group">
                                    <label>Client</label>
                                    <select id="client-select2" class="form-control">
                                        @if($client)
                                            <option value="{{ $client['id'] }}" selected>{{ $client['name'] }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Project Number</label>
                                    <input type="text" class="form-control" wire:model='project.project_number'>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" wire:ignore>
                                    <label>Property Type</label>
                                    <select id="property-type-select2"> {{-- Please see JS as select2 --}}
                                        <option value="residential">Residential</option>
                                        <option value="commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Property Owner Name</label>
                                    <input type="text" class="form-control" wire:model='project.property_owner_name'>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Property Address</label>
                                    <input type="text" class="form-control" wire:model='project.property_address'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mailing Address for Wet Stamps</label>
                                    <input type="text" class="form-control" wire:model='project.wet_stamp_mailing_address'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Number of Wet Stamps</label>
                                    <input type="text" class="form-control" wire:model='project.wet_stamp_count'>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Related Jobs</h4>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ---------------------------- --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-2">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-22" aria-expanded="true" aria-controls="panelsStayOpen-22">
                        Job
                    </button>
                </h2>
                <div id="panelsStayOpen-22" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-2">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Service Order Link</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Service Order Form</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-auto">
                                <div class="form-group d-flex flex-column">
                                    <label class="form-label">In Review</label>
                                    <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="icon-input" value="1"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button selectgroup-button-icon"><i
                                                    class="fa fa-check"></i></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="icon-input" value="0"
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
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Job Number</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Job Status</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Estimated Days to Complete</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Estimated Days to Complete Override</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Received Formula</label>
                                    <input type="datetime" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Due</label>
                                    <input type="datetime" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Completed</label>
                                    <input type="datetime" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Cancelled</label>
                                    <input type="datetime" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date Sent to Client</label>
                                    <input type="datetime" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Client Contact</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Client Contact E-mail</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Client Contact E-mail Override</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Deliverables Email</label>
                                    <input type="text" class="form-control">
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
            </div>
            {{-- ---------------------------- --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-3">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-33" aria-expanded="true" aria-controls="panelsStayOpen-33">
                        RFI (Request for Information)
                    </button>
                </h2>
                <div id="panelsStayOpen-33" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-3">
                    <div class="accordion-body">
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
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-4">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-44" aria-expanded="true" aria-controls="panelsStayOpen-44">
                        Tracking Numbers
                    </button>
                </h2>
                <div id="panelsStayOpen-44" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-4">
                    <div class="accordion-body">
                        ---
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-5">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-55" aria-expanded="true" aria-controls="panelsStayOpen-55">
                        Tasks
                    </button>
                </h2>
                <div id="panelsStayOpen-55" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-5">
                    <div class="accordion-body">
                        ---
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-6">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-66" aria-expanded="true" aria-controls="panelsStayOpen-66">
                        Price
                    </button>
                </h2>
                <div id="panelsStayOpen-66" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-6">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Task Price Total</label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Commercial Job Price</label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Total</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#rfi-editor', {
            theme: 'snow'
        });
        const quill2 = new Quill('#client-request-editor', {
            theme: 'snow'
        });

        quill.on('text-change', function() {
            let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
            @this.set('rfi', value)
        })

        quill2.on('text-change', function() {
            let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
            @this.set('job_addtional_info', value)
        })

        // START: CLIENT
        $('#client-select2').select2({
            theme: 'bootstrap-5',
            allowClear: true,
            placeholder: 'Select Options',
            ajax: {
                url: '{{ route('get.client.select') }}',
                dataType: 'json'
            }
        });

        $('#client-select2').on('change', function(e) {
            var data = $(this).val();
            @this.set('project.client_id', data);
        });
        // END: CLIENT

        // START: PROPERTY TYPE
        $('#property-type-select2').select2({
            width: '100%',
            theme: 'bootstrap-5',
            allowClear: true,
            minimumResultsForSearch: -1,
            placeholder: 'Select Options',
        });

        @if($project)
            $('#property-type-select2').val('{{ $project['property_type'] }}').trigger('change');
        @endif
        
        $('#property-type-select2').on('change', function(e) {
            var data = $(this).val();
            @this.set('project.property_type', data);
        });
        // END: PROPERTY TYPE
    </script>
</div>

@push('styles')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
