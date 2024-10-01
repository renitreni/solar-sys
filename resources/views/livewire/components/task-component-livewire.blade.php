<div>
    <!-- Task Modal -->
    <div class="modal fade" id="task-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $taskId ? 'Edit Task' : 'Create Task' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <div class="w-100 mb-3">
                            <label>Services</label>
                            <select class="form-control form-select w-100" wire:model.live='serviceId'>
                                <option>-- Select Services --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service['id'] }}">{{ $service['service_name'] }}</option>
                                @endforeach
                            </select>
                            @error('serviceId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-100 mb-3">
                            <label>Task Price</label>
                            <input type="text" class="form-control" wire:model.live='price'>
                        </div>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if ($taskId)
                        <button type="button" class="btn btn-primary" wire:click='update'>Update</button>
                        <button type="button" class="btn btn-danger" wire:click='delete'>Delete</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click='create'>Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
