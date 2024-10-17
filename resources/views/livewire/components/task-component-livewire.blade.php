<div>
    <!-- Task Modal -->
    <div class="modal fade" id="task-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $taskId ? 'Edit Task' : 'Create Task' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
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
                        <div class="col-md-6 mb-3">
                            <label>Task Price</label>
                            <input type="text" class="form-control" wire:model.live='price'>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="input-group mb-3">
                                <select class="form-control form-select" wire:model.live='selectedAssignee'>
                                    <option value="">-- Select Option --</option>
                                    @foreach ($userList ?? [] as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-sm btn-primary" wire:click='addAssignee'>Add
                                    Assignee</button>
                            </div>
                            @error('selectedAssignee')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <ol class="list-group list-group-numbered">
                                @foreach ($assignees ?? [] as $assignee)
                                    <li class="list-group-item justify-content-between">
                                        <label for="">{{ $assignee['assignee_name'] }}</label>
                                        <button type="button" class="btn btn-xs btn-outline-danger"
                                            wire:click='deleteAssignee({{ $assignee['assigned_to'] }})'>
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="col-md-8 mb-3 d-flex flex-column">
                            <div class="mb-3" wire:ignore>
                                <label>Other Service Description</label>
                                <div id="other-description-editor" style="height:180px"></div>
                            </div>
                            <div wire:ignore>
                                <label>Notes</label>
                                <div id="task-note-editor" style="height:180px"></div>
                            </div>
                        </div>
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
    <script>
        $(document).ready(function() {
            var quill3 = new Quill('#task-note-editor', {
                theme: 'snow'
            });

            quill3.on('text-change', function() {
                let value = $('#task-note-editor > .ql-editor').html();
                @this.set('notes', value)
            });

            var quill4 = new Quill('#other-description-editor', {
                theme: 'snow'
            });

            quill4.on('text-change', function() {
                let value = $('#other-description-editor > .ql-editor').html();
                @this.set('otherDescription', value)
            })
        });
    </script>
</div>
