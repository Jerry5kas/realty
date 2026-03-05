@props(['label', 'name', 'value' => '1', 'checked' => false])

<div>
    <label class="flex items-center">
        <input 
            type="checkbox" 
            name="{{ $name }}" 
            value="{{ $value }}" 
            {{ old($name, $checked) ? 'checked' : '' }}
            class="w-4 h-4 rounded focus:ring-offset-0" 
            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
            {{ $attributes }}
        >
        <span class="ml-2 text-sm" style="color: {{ $theme['accent_color'] }};">{{ $label }}</span>
    </label>
</div>
