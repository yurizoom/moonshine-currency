<x-moonshine::layout.grid>
    <x-moonshine::layout.column adaptiveColSpan="6" colSpan="{{ $element->isGroup() ? '8' : '12' }}">
        <x-moonshine::form.input-extensions
                :extensions="$element->getExtensions()"
        >
            <x-moonshine::form.input
                    :attributes="$attributes->merge([
                'value' => (string) $value
        ])"
            />
        </x-moonshine::form.input-extensions>
    </x-moonshine::layout.column>
    @if($element->isGroup())
        <x-moonshine::layout.column adaptiveColSpan="6" colSpan="4">

            <x-moonshine::form.select
                    :attributes="$attributes->merge([
                'value' => (string) $value
            ])">
                <x-slot:options>
                    @foreach($element->getCurrencies() as $currency)
                        <option value="{{ $currency }}"
                                @if($element->getCurrency() == $currency)selected @endif>{{ $currency }}</option>
                    @endforeach
                </x-slot:options>
            </x-moonshine::form.select>
        </x-moonshine::layout.column>
    @endif
</x-moonshine::layout.grid>
