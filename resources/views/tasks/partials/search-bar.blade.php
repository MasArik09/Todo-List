<form method="GET" action="{{ route('tasks.index') }}" class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-150 p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
        <!-- Search Input -->
        <div class="col-span-1 sm:col-span-2">
            <x-input-label for="search" :value="__('Search')" />
            <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" :value="request('search')" placeholder="Search by task title..." />
        </div>

        <!-- Category Dropdown -->
        <div>
            <x-input-label for="category_id" :value="__('Category')" />
            <x-select-input id="category_id" name="category_id" class="mt-1 block w-full">
                <option value="">{{ __('All Categories') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select-input>
        </div>

        <!-- Priority Dropdown -->
        <div>
            <x-input-label for="priority" :value="__('Priority')" />
            <x-select-input id="priority" name="priority" class="mt-1 block w-full">
                <option value="">{{ __('All Priorities') }}</option>
                <option value="Low" @selected(request('priority') == 'Low')>{{ __('Low') }}</option>
                <option value="Medium" @selected(request('priority') == 'Medium')>{{ __('Medium') }}</option>
                <option value="High" @selected(request('priority') == 'High')>{{ __('High') }}</option>
            </x-select-input>
        </div>

        <!-- Status Dropdown -->
        <div>
            <x-input-label for="status" :value="__('Status')" />
            <x-select-input id="status" name="status" class="mt-1 block w-full">
                <option value="">{{ __('All Statuses') }}</option>
                <option value="Pending" @selected(request('status') == 'Pending')>{{ __('Pending') }}</option>
                <option value="Completed" @selected(request('status') == 'Completed')>{{ __('Completed') }}</option>
            </x-select-input>
        </div>

        <!-- Overdue Checkbox -->
        <div class="flex items-center h-10">
            <label for="overdue" class="inline-flex items-center cursor-pointer">
                <input id="overdue" type="checkbox" name="overdue" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(request('overdue'))>
                <span class="ms-2 text-sm text-gray-600">{{ __('Overdue Tasks Only') }}</span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="col-span-1 lg:col-span-2 flex justify-end gap-3 mt-4 lg:mt-0">
            <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Reset') }}
            </a>
            <x-primary-button>
                {{ __('Filter') }}
            </x-primary-button>
        </div>
    </div>
</form>
