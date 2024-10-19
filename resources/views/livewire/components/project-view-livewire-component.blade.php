<div>
    <div class="modal fade" id="projectViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="projectViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectViewModalLabel">Project View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-4">
                            <h5 class="mb-0">Company</h5>
                            <strong>{{ $project['company']['company_name'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Client</h5>
                            <strong>{{ $project['client']['name'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Project Number</h5>
                            <strong>{{ $project['project_number'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Property Owner name</h5>
                            <strong>{{ $project['property_owner_name'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Property Address</h5>
                            <strong>{{ $project['property_address'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Property Type</h5>
                            <strong>{{ $project['property_type'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Property State</h5>
                            <strong>{{ $project['property_state'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Property City</h5>
                            <strong>{{ $project['property_city'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Property Area Code</h5>
                            <strong>{{ $project['property_area_code'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Mailing Address for Wet Stamps</h5>
                            <strong>{{ $project['wet_stamp_mailing_address'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-0">Number of Wet Stamps</h5>
                            <strong>{{ $project['wet_stamp_count'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-12">
                            <h3 class="mb-0 mt-4 text-decoration-underline">Related Jobs</h3>
                            <livewire:components.related-job-livewire-components></livewire:components.related-job-livewire-components>
                        </div>
                        <div class="col-md-12">
                            <h3 class="mb-0 mt-4 text-decoration-underline">Job</h3>
                        </div>
                        @if ($project['project_job']['in_review'] ?? null)
                            <div class="col-md-3">
                                <h5>Review Status</h5>
                                <h5><span class="badge bg-info">In Review</span></h5>
                            </div>
                        @endif
                        <div class="col-md-3">
                            <h5 class="mb-0">Service Order Link</h5>
                            <strong>{{ $project['project_job']['service_order_url'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Service Order Form</h5>
                            <strong>{{ $project['project_job']['service_order_form'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Job request #</h5>
                            <strong>{{ $project['project_job']['request_no'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Job Number</h5>
                            <strong>{{ $project['project_job']['job_no'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Job Statys</h5>
                            <strong>{{ $project['project_job']['job_status'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Date Received Formula</h5>
                            <strong>{{ $project['project_job']['date_received_formula'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Date Due</h5>
                            <strong>{{ $project['project_job']['date_due'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Date Completed</h5>
                            <strong>{{ $project['project_job']['date_completed'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Date Sent to Client</h5>
                            <strong>{{ $project['project_job']['date_sent'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Client Name</h5>
                            <strong>{{ $project['project_job']['client_name'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Client Contact E-mail</h5>
                            <strong>{{ $project['project_job']['client_email'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Client Contact E-mail Override</h5>
                            <strong>{{ $project['project_job']['client_email_override'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <h5 class="mb-0">Deliverables Email</h5>
                            <strong>{{ $project['project_job']['deliverables_email'] ?? '' }}</strong>
                        </div>
                        <div class="col-md-12">
                            <h5 class="mb-0">Additional Information From Client</h5>
                            <strong>{{ $project['project_job']['additional_info'] ?? '' }}</strong>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
