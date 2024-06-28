<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Settings - Company Logo</h3>
            <h6 class="op-7 mb-2"></h6>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <form wire:submit="save" class="d-flex flex-column">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}">
                            @endif

                            <input type="file" wire:model="photo" class="form-control my-3">

                            @error('photo')
                                <span class="error">{{ $message }}</span>
                            @enderror

                            <button class="btn btn-sm btn-info" type="submit">Save photo</button>
                        </form>
                    </div>

                    <div class="col-md-9 d-flex justify-content-center">
                        <div class="d-flex flex-column">
                            <img src="{{ route('get-image', ['path' => $photoPath]) }}" alt="brand">
                            @if (config('app.company-logo') == $photoPath)
                                <label class="text-center mt-2 fs-5">This is just a placeholder.</label>
                            @else
                                <button class="btn btn-danger mt-3" type="button" wire:click="removeLogo">Delete This
                                    Company Logo</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
