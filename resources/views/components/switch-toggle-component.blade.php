<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" 
        @click="$dispatch('{{ $event }}', {
            'value': {
                '{{ $keyed_id }}' : {{ $model['id'] }}, 
                '{{ $keyed }}' : {{ $model[$keyed] }}
            } 
        })"
        {{ $model[$keyed] ? 'checked' : '' }}>
</div>
