@props(['label', 'name', 'options' => [], 'value' => '', 'required' => false, 'placeholder' => 'Select...'])

<div>
    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <select 
        name="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all @error($name) border-red-500 @enderror" 
        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $key => $label)
            <option value="{{ $key }}" {{ old($name, $value) == $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
