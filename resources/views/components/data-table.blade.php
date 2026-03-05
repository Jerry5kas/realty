@props(['title', 'description', 'createRoute' => null, 'createLabel' => 'Add New', 'columns', 'data', 'actions' => true])

<div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
    <!-- Header -->
    <div class="px-4 md:px-6 py-4 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-4" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
        <div>
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">{{ $title }}</h2>
            @if($description)
                <p class="text-sm mt-1" style="color: white; opacity: 0.8;">{{ $description }}</p>
            @endif
        </div>
        @if($createRoute)
            <a href="{{ $createRoute }}" class="inline-block px-4 py-2 text-white rounded-lg font-medium hover:opacity-90 transition-all text-center" style="background-color: {{ $theme['secondary_color'] }};">
                + {{ $createLabel }}
            </a>
        @endif
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-full">
            <thead style="background-color: {{ $theme['primary_color'] }}10;">
                <tr>
                    @foreach($columns as $column)
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium uppercase tracking-wider whitespace-nowrap" style="color: {{ $theme['primary_color'] }};">
                            {{ $column['label'] }}
                        </th>
                    @endforeach
                    @if($actions)
                        <th class="px-4 md:px-6 py-3 text-right text-xs font-medium uppercase tracking-wider whitespace-nowrap" style="color: {{ $theme['primary_color'] }};">
                            Actions
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
