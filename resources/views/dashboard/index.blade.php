<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome greeting -->
            @include('dashboard.partials.welcome')

            <!-- Quick actions -->
            @include('dashboard.partials.quick-actions')

            <!-- Progress bar -->
            @include('dashboard.partials.progress-bar')

            <!-- Statistics cards -->
            @include('dashboard.partials.stat-cards')

            <!-- Recent tasks list -->
            @include('dashboard.partials.recent-tasks')
        </div>
    </div>
</x-app-layout>
