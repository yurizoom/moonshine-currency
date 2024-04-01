<x-moonshine::grid>
    <x-moonshine::column adaptiveColSpan="6" colSpan="{{ $element->isGroup() ? '8' : '12' }}">
        <x-moonshine::form.input-extensions
                :extensions="$element->getExtensions()"
        >
        <x-moonshine::form.input
                :attributes="$element->attributes()->merge([
                'id' => $element->id(),
                'name' => $element->name($element->column()),
                'value' => (string) $value
        ])"
        />
        </x-moonshine::form.input-extensions>
    </x-moonshine::column>
    @if($element->isGroup())
    <x-moonshine::column adaptiveColSpan="6" colSpan="4">

            <x-moonshine::form.select
                    :attributes="$element->attributes()->merge([
                'id' => $element->currencyColumn(),
                'name' => $element->name($element->currencyColumn()),
                'value' => (string) $value
            ])">
                <x-slot:options>
                    @foreach($element->getCurrencies() as $currency)
                        <option value="{{ $currency }}"
                                @if($element->getCurrency() == $currency)selected @endif>{{ $currency }}</option>
                    @endforeach
                </x-slot:options>
            </x-moonshine::form.select>
    </x-moonshine::column>
    @endif
</x-moonshine::grid>
