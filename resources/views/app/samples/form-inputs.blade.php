@php $editing = isset($sample) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="original"
            label="Original"
            value="{{ old('original', ($editing ? $sample->original : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="translated"
            label="Translated"
            value="{{ old('translated', ($editing ? $sample->translated : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="language" label="Language">
            @php $selected = old('language', ($editing ? $sample->language : 'DE')) @endphp
            <option value="DE" {{ $selected == 'DE' ? 'selected' : '' }} >DE</option>
            <option value="EN" {{ $selected == 'EN' ? 'selected' : '' }} >EN</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
