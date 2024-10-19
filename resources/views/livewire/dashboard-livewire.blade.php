<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
            <h6 class="op-7 mb-2">Overview</h6>
        </div>
        {{-- <div class="ms-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-sm btn-label-info btn-round me-2">Manage</a>
            <a href="#" class="btn btn-sm btn-primary btn-round">Add Customer</a>
        </div> --}}
    </div>
    @livewire('components.dashboard-card-livewire-component')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Projects
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <livewire:project-table disableAction="true" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
