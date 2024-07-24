<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Projects</h3>
            <h6 class="op-7 mb-2"></h6>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('project-job-form') }}" type="button" class="btn btn-sm btn-sm btn-success">
                    <i class="fas fa-plus"></i> Add New
                </a>
                <div class="row">
                    <div class="col-md-12">
                        <livewire:project-table/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>