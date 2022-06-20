<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="mt-6">
        <div class="flex justify-between">
            <div class="text-gray-600 font-bold text-2xl md:text-4xl">{{ __('Records') }}</div>

            <div>
                <a href=" {{ route('download-pdf') }}">
                    <button
                        class="bg-ochre-600 hover:bg-ochre-500 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                        </svg>
                        <span>PDF</span>
                    </button>
                </a>
            </div>

        </div>

        <div class="mt-8 text-2xl flex justify-between">
            <div class="">
                <x-jet-input wire:model.debounce.500ms="date" type="date"></x-jet-input>
            </div>
            <div class=" text-gray-600 font-bold text-2xl md:text-4xl">
                @if (!auth()->user()->hasRole('Super Admin'))
                    @foreach ($companies as $company)
                        <h1>{{ $company->name }}</h1>
                    @endforeach
                @endif

            </div>
            <div class="p-2 mr-2">
                <x-jet-button class="bg-sea-600 hover:bg-sea-800" wire:click="confirmingCheckInAdd">
                    Check in
                </x-jet-button>
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('id')">
                        <div class="flex items-center w-3">
                            ID
                            <x-sort-icon sort-field="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('hour_in')">
                        <div class="flex items-center">
                            Hour in
                            <x-sort-icon sort-field="hour_in" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('hour_out')">
                        <div class="flex items-center">
                            Hour out
                            <x-sort-icon sort-field="hour_out" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('total')">
                        <div class="flex items-center">
                            Total
                            <x-sort-icon sort-field="total" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('created_at')">
                        <div class="flex items-center w-3">
                            Created
                            <x-sort-icon sort-field="created_at" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td class="border px-4 py-2">{{ $record->id }}</td>
                        <td class="border px-4 py-2">{{ $record->hour_in }}</td>
                        <td class="border px-4 py-2">{{ $record->hour_out }}</td>
                        <td class="border px-4 py-2">{{ $record->total_day }}</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($record->created_at)->format('Y/m/d') }}
                        </td>
                @endforeach
                </tr>
            </tbody>
        </table>

    </div>
    <div class="mt-4">
        {{ $records->links() }}
    </div>
    {{-- Add users --}}
    <x-jet-dialog-modal wire:model="confirmingCheckInAdd">
        <x-slot name="title">
            <p class="text-xl font-bold text-green-400">{{ __('Check in') }}</p>

        </x-slot>

        <x-slot name="content">
            <!-- x-data="{ open: '$disabled' }"
            x-bind:disabled=" open = false"-->
            <div class="flex justify-around">
                <button wire:click="check_in()"
                    class="h-12 px-6 m-2 text-lg text-ochre-100 transition-colors duration-150 bg-ochre-400 rounded-lg focus:shadow-outline hover:bg-ochre-500">ENTER</button>
                <button wire:click="check_out()"
                    class="h-12 px-6 m-2 text-lg text-sea-100 transition-colors duration-150 bg-sea-700 rounded-lg focus:shadow-outline hover:bg-sea-800">EXIT</button>
            </div>
        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>

</div>
