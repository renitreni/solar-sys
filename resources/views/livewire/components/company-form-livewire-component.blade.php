<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="companyFormModal" tabindex="-1" role="dialog"
        aria-labelledby="userFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="companyFormModalLabel">
                        @if ($this->companyId)
                            Edit Company Form
                        @else
                            Add Company Form
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label>Company Name</label>
                            <input type="text" class="form-control" wire:model.live="companyName">
                            @error('companyName')
                                <div class="text-start text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    @if ($this->companyId)
                        <button type="button" class="btn btn-sm btn-danger" wire:click='destroy()'>Delete</button>
                        <button type="button" class="btn btn-sm btn-primary" wire:click='update()'>Update</button>
                    @else
                        <button type="button" class="btn btn-sm btn-primary" wire:click='store()'>Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
