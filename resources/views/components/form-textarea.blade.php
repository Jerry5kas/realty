@props(['label', 'name', 'value' => '', 'required' => false, 'placeholder' => '', 'rows' => 3])

<div>
    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <textarea 
        name="{{ $name }}" 
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all @error($name) border-red-500 @enderror" 
        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" 
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
