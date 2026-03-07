<x-layout.frontend>
    <div class="max-w-7xl mx-auto px-4 py-6 md:py-10">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Favorites</h1>
            <p class="text-gray-600">Properties and projects you've saved for later</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Properties Section -->
        @if($properties->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6" style="color: {{ $theme['primary_color'] }};">
                    Properties ({{ $properties->count() }})
                </h2>
                <div class="space-y-4">
                    @foreach($properties as $property)
                        @include('partials.property-card-compact', ['property' => $property, 'showRemove' => true])
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Projects Section -->
        @if($projects->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6" style="color: {{ $theme['secondary_color'] }};">
                    Projects ({{ $projects->count() }})
                </h2>
                <div class="space-y-4">
                    @foreach($projects as $project)
                        @include('partials.project-card-compact', ['project' => $project, 'showRemove' => true])
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Empty State -->
        @if($properties->count() === 0 && $projects->count() === 0)
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">No Favorites Yet</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Start exploring properties and projects. Click the heart icon to save your favorites here.
                </p>
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('listings', ['type' => 'properties']) }}" class="px-6 py-3 rounded-lg font-semibold text-white shadow-md hover:shadow-lg transition-all" style="background-color: {{ $theme['primary_color'] }};">
                        Browse Properties
                    </a>
                    <a href="{{ route('listings', ['type' => 'projects']) }}" class="px-6 py-3 rounded-lg font-semibold text-white shadow-md hover:shadow-lg transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                        Browse Projects
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layout.frontend>
