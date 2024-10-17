@php $descriptions = app(\App\Models\Task::class)->find($id) @endphp

<div class="row">
    <div class="col-md-6">
        <h6>Notes</h6>
        <div class="others-detail">
            {!! $descriptions->notes !!}
        </div>
    </div>
    <div class="col-md-6">
        <h6>Other Description</h6>
        <div class="others-detail">
            {!! $descriptions->other_description !!}
        </div>
    </div>
</div>

<style>
    .others-detail p {
        line-height: 0px !important;
    }
</style>