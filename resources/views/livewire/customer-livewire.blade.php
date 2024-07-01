<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Clients</h3>
            <h6 class="op-7 mb-2"></h6>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <livewire:client-table />
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="clientFormModal" tabindex="-1" role="dialog"
        aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="clientFormModalLabel">
                        @if ($this->clientId)
                            Edit Client Form
                        @else
                            Add Client Form
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model.live="name">
                            @error('name')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label>E-mail</label>
                            <input type="text" class="form-control" wire:model.live="email">
                            @error('email')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" wire:model.live="contact_no">
                            @error('contact_no')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label>Address</label>
                            <textarea type="text" class="form-control" wire:model.live="address"></textarea>
                            @error('address')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    @if ($this->clientId)
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-danger" wire:click='destroy()'>Delete</button>
                        <button type="button" class="btn btn-primary" wire:click='update()'>Update</button>
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
