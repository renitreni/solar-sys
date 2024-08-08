<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 position-relative">
        <div class="fixed-div shadow-sm d-flex">
            <h3 class="fw-bold m-0">{{ $title }}</h3>
            <div class="op-7 ms-3">
                <div class="d-flex gap-2">
                    {{ $actionButtons }}
                </div>
            </div>
        </div>
    </div>
    <div class="row fixed-div-distance">
        {{ $slot }}
    </div>
</div>