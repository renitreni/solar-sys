<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Service</h3>
            <h6 class="op-7 mb-2"></h6>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column">
                    <livewire:table.service-table/>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="serviceFormModal" tabindex="-1" role="dialog"
        aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="serviceFormModalLabel">
                        @if ($this->serviceId)
                            Edit Service Form
                        @else
                            Add Service Form
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model.live="serviceName">
                            @error('serviceName')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    @if ($this->serviceId)
                        <button type="button" class="btn btn-danger" wire:click='destroy()'>Delete</button>
                        <button type="button" class="btn btn-primary" wire:click='update()'>Update</button>
                    @else
                        <button type="button" class="btn btn-primary"  wire:click='store()'>Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
