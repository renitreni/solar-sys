@props([
    'keyword' => null,
    'lists' => null,
    'idKey' => '',
    'labelKey' => '',
    'inputName' => '',
    'inputKeyword' => '',
    'openSelect' => false,
])

<div class="form-group" x-data="dropdownSearch{{ $identifier }}" hidden wire:ignore.self>
    <label>{{ $label }}</label>
    <div class="position-relative" @click.away="hide = true">
        <input class="form-control" wire:model.live='{{ $inputName }}' x-on:click="hide = !hide" readonly>
        @if ($keyword || $lists)
            <div class="position-absolute border bg-white z-3 w-100" x-show="!hide" wire:self>
                <div class="p-2">
                    <input class="form-control" wire:model.live='{{ $inputKeyword }}' x-model='keyword'>
                </div>
                <div style="max-height: 300px;" class="overflow-scroll">
                    @foreach ($lists as $item)
                        <button class="btn btn-default w-100 text-start"
                            x-on:click="actionSelect(`{{ $item[$idKey] }}`, `{{ $item[$labelKey] }}`)">
                            {{ $item[$labelKey] }}
                        </button>
                    @endforeach
                    @empty($lists)
                        @if($openSelect)
                            <button class="btn btn-default w-100 text-start"
                                x-on:click="actionSelect(keyword, keyword)"
                                x-text='keyword'>
                            </button>
                        @else
                            <button class="btn btn-default w-100 text-start">
                                No results.
                            </button>
                        @endif
                    @endempty
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        function dropdownSearch{{ $identifier }}() {
            return {
                hide: true,
                keyword: '',
                actionSelect(id, label) {
                    this.hide = !this.hide;
                    this.keyword = '';
                    @this.set('{{ $inputName }}', label)
                    @this.set('{{ $inputKeyword }}', '')
                }
            }
        }
    </script>
@endpush
