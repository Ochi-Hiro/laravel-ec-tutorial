<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    eroquent
                    @foreach($eloquent_all as $eloquent_owner)
                        {{ $eloquent_owner->name }}
                        {{ $eloquent_owner->created_at->diffForHumans() }}
                    @endforeach
                    <br>
                    querybuilder
                    @foreach($querybuilder_get as $querybuilder_owner)
                        {{ $querybuilder_owner->name }}
                        {{ Carbon\Carbon::parse($querybuilder_owner->created_at)->diffForHumans() }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
