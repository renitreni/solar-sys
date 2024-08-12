@props([
    'keyword' => null,
    'lists' => null,
    'idKey' => '',
    'labelKey' => '',
    'inputId' => '',
    'inputName' => '',
    'openSelect' => false,
    'livewireId' => 0,
])

<div class="form-group" x-data="dropdownSearch{{ $inputId }}" hidden wire:ignore.self>
    <label>{{ $label }}</label>
    <div class="position-relative" @click.away="hide = true">
        <input id="input-{{ $inputId }}" class="form-control" x-model="inputName" x-on:click="hide = !hide">
        @if ($keyword || $lists)
            <div class="position-absolute border bg-white z-3 w-100" x-show="!hide">
                <div class="p-2">
                    <input class="form-control" wire:model.live='{{ Str::replace('$', '', $keyword) }}'
                        x-model='keyword'>
                </div>
                <div style="max-height: 300px;" class="overflow-scroll">
                    @foreach ($lists as $item)
                        <button class="btn btn-default w-100 text-start"
                            x-on:click="actionSelect(`{{ $item[$idKey] }}`, `{{ $item[$labelKey] }}`)">
                            {{ $item[$labelKey] }}
                        </button>
                    @endforeach
                @empty($lists)
                    @if ($openSelect)
                        <button class="btn btn-default w-100 text-start" x-on:click="actionSelect(keyword, keyword)"
                            x-text='keyword'>
                        </button>
                    @else
                        <button class="btn btn-default w-100 text-start">
                            No results.
                        </button>
                    @endif
                @endempty
            </div>
    @endif
</div>
</div>
</div>
<script>

    function dropdownSearch{{ $inputId }}() {
        return {
            hide: true,
            keyword: '',
            inputName: `{{ $inputName }}`,
            actionSelect(id, label) {
                this.hide = !this.hide;
                this.keyword = '';
                this.inputName = label;
                @this.set('{{ $inputId }}', id)
                @this.set('{{ $keyword }}', '')
                @this.selectBind({'{{ $inputId }}':id, '{{ $keyword }}': ''});
            }
        }
    }

    let inputElement{{ $inputId }} = document.getElementById('input-{{ $inputId }}');

    inputElement{{ $inputId }}.addEventListener('focus', function(event) {
        event.target.blur();
    });

    window.addEventListener('load', function() {
        // Select all elements with the 'hidden' attribute
        let hiddenElements{{ $inputId }} = document.querySelectorAll('[hidden]');

        // Iterate over the NodeList and remove the 'hidden' attribute from each element
        hiddenElements{{ $inputId }}.forEach(element => {
            element.removeAttribute('hidden');
        });
    });
</script>
