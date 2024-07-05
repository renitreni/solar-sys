<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Users - All List</h3>
            <h6 class="op-7 mb-2"></h6>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column">
                    <div>
                        <button type="button" class="btn btn-sm btn-success" wire:click='addNew'>
                            <i class="fas fa-plus"></i> Add New
                        </button>
                    </div>
                    <div>
                        <livewire:user-table />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Modal -->
    <div wire:ignore.self class="modal fade" id="userFormModal" tabindex="-1" role="dialog"
        aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($this->userId)
                        <h5 class="modal-title fw-bold" id="userFormModalLabel">Edit User Form</h5>
                    @else
                        <h5 class="modal-title fw-bold" id="userFormModalLabel">Add User Form</h5>
                    @endif
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
                        @if (!$this->userId)
                            <div class="col-12 mb-3">
                                <label>New Password</label>
                                <input type="password" class="form-control" wire:model.live="password">
                                @error('password')
                                    <div class="text-start text-danger ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" wire:model.live="passwordConfirmation">
                                @error('passwordConfirmation')
                                    <div class="text-start text-danger ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
                @if ($this->userId)
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="updateUser">Update</button>
                    </div>
                @else
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary" wire:click='store'>Save</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="userFormModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            Are you sure you want to delete <code>{{ $this->email }}</code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" wire:click="deleteUser">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Pass Modal -->
    <div wire:ignore.self class="modal fade" id="userChangePassModal" tabindex="-1" role="dialog"
        aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="userFormModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label>New Password</label>
                            <input type="password" class="form-control" wire:model.live="password">
                            @error('password')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" wire:model.live="passwordConfirmation">
                            @error('passwordConfirmation')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-warning" wire:click='changePassword'>Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
