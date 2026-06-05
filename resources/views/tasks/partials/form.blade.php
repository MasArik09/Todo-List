<div class="space-y-6">
    <!-- Title -->
    <div>
        <x-input-label for="title" :value="__('Task Title')" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $task->title ?? '')" required autofocus autocomplete="title" placeholder="e.g. Finish Laravel assignment" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <!-- Description -->
    <div>
        <x-input-label for="description" :value="__('Description')" />
        <x-textarea id="description" name="description" class="mt-1 block w-full" rows="4" placeholder="e.g. Details about the task, steps to complete, etc.">{{ old('description', $task->description ?? '') }}</x-textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Category -->
        <div>
            <x-input-label for="category_id" :value="__('Category')" />
            <x-select-input id="category_id" name="category_id" class="mt-1 block w-full">
                <option value="">{{ __('No Category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>

        <!-- Due Date -->
        <div>
            <x-input-label for="due_date" :value="__('Due Date')" />
            <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" :value="old('due_date', $task->due_date ?? '')" />
            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Priority -->
        <div>
            <x-input-label for="priority" :value="__('Priority')" />
            <x-select-input id="priority" name="priority" class="mt-1 block w-full">
                <option value="Low" @selected(old('priority', $task->priority ?? 'Medium') == 'Low')>{{ __('Low') }}</option>
                <option value="Medium" @selected(old('priority', $task->priority ?? 'Medium') == 'Medium')>{{ __('Medium') }}</option>
                <option value="High" @selected(old('priority', $task->priority ?? 'Medium') == 'High')>{{ __('High') }}</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
        </div>

        <!-- Status -->
        <div>
            <x-input-label for="status" :value="__('Status')" />
            <x-select-input id="status" name="status" class="mt-1 block w-full">
                <option value="Pending" @selected(old('status', $task->status ?? 'Pending') == 'Pending')>{{ __('Pending') }}</option>
                <option value="Completed" @selected(old('status', $task->status ?? 'Pending') == 'Completed')>{{ __('Completed') }}</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save Task') }}</x-primary-button>
        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            {{ __('Cancel') }}
        </a>
    </div>
</div>
