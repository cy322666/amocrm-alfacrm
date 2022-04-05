@component($typeForm, get_defined_vars())
    <div data-controller="input"
         data-input-mask="{{$mask ?? ''}}"
    >
        <input {{ $attributes }} style="margin: 5px; width: 22rem">
    </div>
    @empty(!$datalist)
        <datalist id="datalist-{{$name}}">
            @foreach($datalist as $item)
                <option value="{{ $item }}">
            @endforeach
        </datalist>
    @endempty
@endcomponent