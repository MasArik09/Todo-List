<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-950">
        {{ __('Welcome back, :name 👋', ['name' => Auth::user()->name]) }}
    </h1>
    <p class="mt-2 text-sm text-gray-600">
        {{ __('You have :pending pending tasks and :overdue overdue tasks.', ['pending' => $pendingCount, 'overdue' => $overdueCount]) }}
        {{ __("Let's make today productive.") }}
    </p>
</div>
