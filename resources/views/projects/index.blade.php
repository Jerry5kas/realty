@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', 'Projects Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Projects', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <x-search-bar 
                placeholder="Search projects by name, developer, or RERA..." 
                :action="route('projects.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('project-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected projects?')" 
            class="hidden p-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all flex items-center gap-2"
            title="Delete Selected"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="hidden md:inline">Delete</span>
            <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs font-semibold" id="selectedCount">0</span>
        </button>
    </div>

    <!-- Filters -->
    <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <select name="project_type" onchange="window.location.href='{{ route('projects.index') }}?project_type=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Types</option>
            <option value="residential" {{ request('project_type') == 'residential' ? 'selected' : '' }}>Residential</option>
            <option value="commercial" {{ request('project_type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
            <option value="mixed" {{ request('project_type') == 'mixed' ? 'selected' : '' }}>Mixed Use</option>
        </select>

        <select name="status" onchange="window.location.href='{{ route('projects.index') }}?status=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Status</option>
            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="under-construction" {{ request('status') == 'under-construction' ? 'selected' : '' }}>Under Construction</option>
            <option value="ready-to-move" {{ request('status') == 'ready-to-move' ? 'selected' : '' }}>Ready to Move</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <select name="publish_status" onchange="window.location.href='{{ route('projects.index') }}?publish_status=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Publish Status</option>
            <option value="draft" {{ request('publish_status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ request('publish_status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="inactive" {{ request('publish_status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <select name="city_id" onchange="window.location.href='{{ route('projects.index') }}?city_id=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Cities</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>

    <form id="bulkDeleteForm" action="{{ route('projects.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table 
            title="Project Management"
            description="Manage all real estate projects"
            :createRoute="route('projects.create')"
            createLabel="Add Project"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Project', 'field' => 'name'],
                ['label' => 'Developer', 'field' => 'developer'],
                ['label' => 'Type', 'field' => 'type'],
                ['label' => 'Status', 'field' => 'status'],
                ['label' => 'Units', 'field' => 'units'],
                ['label' => 'Views', 'field' => 'views']
            ]"
        >
            <tr style="background-color: {{ $theme['primary_color'] }}05;">
                <td class="px-4 md:px-6 py-3">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-4 h-4 rounded focus:ring-offset-0" 
                        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                        onchange="toggleSelectAll(this, 'project-checkbox')"
                    >
                </td>
                <td colspan="7" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($projects as $project)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $project->id }}" 
                            class="project-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('project-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($project->primary_image)
                                <img src="{{ $project->primary_image }}" alt="{{ $project->name }}" 
                                     class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: {{ $theme['primary_color'] }}20;">
                                    <svg class="w-6 h-6" style="color: {{ $theme['primary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('projects.show', $project) }}" class="font-medium hover:opacity-70" style="color: {{ $theme['accent_color'] }};">
                                    {{ $project->name }}
                                </a>
                                <p class="text-xs text-gray-500">{{ $project->city->name }}, {{ $project->locality }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $project->developer_name }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $project->project_type == 'residential' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $project->project_type == 'commercial' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $project->project_type == 'mixed' ? 'bg-purple-100 text-purple-800' : '' }}">
                            {{ ucfirst($project->project_type) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $project->status == 'ready-to-move' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $project->status == 'under-construction' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $project->status == 'upcoming' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $project->status == 'completed' ? 'bg-gray-100 text-gray-800' : '' }}">
                            {{ ucwords(str_replace('-', ' ', $project->status)) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $project->total_units ?? 'N/A' }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $project->views }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('projects.edit', $project)"
                            :deleteRoute="route('projects.destroy', $project)"
                            deleteMessage="Delete {{ $project->name }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        No projects found. <a href="{{ route('projects.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first project</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($projects->hasPages())
        <div class="mt-6">
            {{ $projects->links() }}
        </div>
    @endif
</div>


@endsection

