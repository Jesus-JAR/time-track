<div class="p-6 sm:px-20 bg-white border-gray-200">
    <div class="mt-8 text-2xl flex justify-between">

        <div class="text-gray-600 font-bold text-2xl md:text-4xl">{{ __('Business') }}</div>

        @if (auth()->user()->hasRole('Super Admin'))
            <button
                class="bg-sea-600 hover:bg-sea-500 text-white font-bold py-1 px-2 border-b-4 border-sea-700 hover:border-sea-500 rounded"
                wire:click='showModal'>
                New Business
            </button>
        @endif
    </div>

    <div class="py-10">
        <div class="justify-center mx-auto sm:px-6 lg:px-8">
            <div class="hidden md:block overflow-x-auto">
                <div class="mt-6">
                    @if (auth()->user()->hasRole('Super Admin'))
                        <div class="flex text-gray-500">
                            <select wire:model="perPage"
                                class="h-10 mr-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">Select</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                            <x-jet-input id="search" placeholder="Search..." class="block w-full mb-3" type="text"
                                name="search" wire:model="search" />

                            <button wire:click="clear">
                                <span class="ml-2 fa-solid fa-eraser text-gray-500 text-4xl"></span>
                            </button>
                        </div>
                    @endif
                    <div class="mt-2">
                        <table class="border-2 border-gray-200 table-auto w-full">
                            <thead>
                                <!-- head -->
                                <tr class="bg-sea-100">
                                    <th class="px-4 py-2 border-r-2 border-gray-200">

                                        <div class="flex items-center cursor-pointer mr-3 justify-beetwen"
                                            wire:click="sortable('id')">
                                            <button>ID</button>
                                            <span class="ml-4">
                                                <!-- En cada icono se comprueba si esta selectionado o no para mostrarlo -->
                                                <i
                                                    class="fa-solid fa-angle-{{ $camp === 'id' ? $icon : '' }} text-gray-500 cursor-pointer"></i>
                                            </span>
                                        </div>
                                    </th>
                                    <th class="px-4 py-2 border-r-2 border-gray-200">

                                        <div class="flex items-center cursor-pointer mr-3 justify-beetwen"
                                            wire:click="sortable('name')">
                                            <button>Name</button>
                                            <span class="ml-4">
                                                <i
                                                    class="fa-solid fa-angle-{{ $camp === 'name' ? $icon : '' }} text-gray-500 cursor-pointer"></i>
                                            </span>
                                        </div>
                                    </th>

                                    <th class="px-4 py-2 border-r-2 border-gray-200">

                                        <div class="flex items-center cursor-pointer mr-3 justify-beetwen"
                                            wire:click="sortable('address')">
                                            <button>Address</button>
                                            <span class="w-4 ml-4">
                                                <i
                                                    class="fa-solid fa-angle-{{ $camp === 'address' ? $icon : '' }} text-gray-500 cursor-pointer"></i>
                                            </span>
                                        </div>
                                    </th>

                                    <th class="px-4 py-2">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- body -->
                                {{-- Mostramos los datos de la tabla traidos desde el controlado con un foreach --}}
                                @foreach ($business as $company)
                                    <tr class="border-2 border-gray-200">
                                        <td class="px-4 py-2 w-3 border-r-2 border-gray-200">{{ $company->id }}</td>
                                        <td class="px-4 py-2 border-r-2 border-gray-200">{{ $company->name }}</td>
                                        <td class="px-4 py-2 border-r-2 border-gray-200">{{ $company->address }}</td>
                                        @if (auth()->user()->hasRole('Super Admin') xor
                                            auth()->user()->hasRole('Admin'))
                                            <td class="px-4 py-2 w-auton flex justify-around">
                                                <button wire:click="showModal({{ $company->id }})"
                                                    class="bg-ochre-500 hover:bg-ochre-400 px-2 text-white border-ochre-700 hover:border-ochre-500 rounded uppercase">
                                                    Edit
                                                </button>

                                                @if (auth()->user()->hasRole('Super Admin') xor
                                                    auth()->user()->hasRole('Admin'))
                                                    <x-jet-danger-button
                                                        wire:click="confirmBusinessDeletion({{ $company->id }})"
                                                        wire:loading.attr="disabled">
                                                        {{ __('Delete') }}
                                                    </x-jet-danger-button>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    {{-- links es una funcion para mostrar la paginacion de la tabla --}}
                    <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                        {{ $business->links() }}
                    </div>

                </div>

            </div>
        </div>
        <div class="">
            {{-- Display mobile --}}
            {{-- Vista movil mas respnsiva --}}

            <div class="bg-white p-4 md:hidden">
                @if (auth()->user()->hasRole('Super Admin'))
                    <div class="flex">
                        <x-jet-input wire:model.debounce.500ms="q" type="search" placeholder="Search"
                            class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />

                    </div>
                @endif
                <div class="grid pt-2 mt-2 grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">

                    @foreach ($business as $company)
                        <div class="bg-sea-100 space-y-3 p-4 rounded-lg shadow">
                            <div class="flex items-center space-x-2 text-sm">
                                <div>
                                    <a href="#"
                                        class="text-blue-500 font-bold hover:underline">{{ $company->id }}</a>
                                </div>
                                <div class="text-gray-500">{{ $company->name }}</div>
                                <div class="text-gray-500">{{ $company->address }}</div>

                            </div>

                            @if (auth()->user()->hasRole('Super Admin')  xor auth()->user()->hasRole('Admin'))
                                <div class="flex justify-around px-4 py-1 my-1">
                                    <button wire:click="showModal({{ $company->id }})"
                                        class="bg-ochre-500 hover:bg-ochre-400 px-2 text-white font-bold border-ochre-700 hover:border-ochre-500 rounded">
                                        Edit
                                    </button>
                                    {{-- Boton de jetstream para eliminar una empresa --}}
                                    <x-jet-danger-button wire:click="confirmBusinessDeletion({{ $company->id }})"
                                        wire:loading.attr="disabled">
                                        {{ __('Delete') }}
                                    </x-jet-danger-button>
                                </div>
                            @endif
                        </div>
                    @endforeach

                </div>
                <div class="bg-white px-4 py-3  items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $business->links() }}
                </div>

            </div>
            {{-- Fin:Display mobile --}}
        </div>
        {{-- Delete users --}}
        {{-- Modal que se muestra al accionar en eliminar --}}
        <x-jet-dialog-modal wire:model="confirmBusinessDeletion">
            <x-slot name="title">
                {{ __('Delete User') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure? If you delete it, all users of that company will be deleted') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmBusinessDeletion', false)"
                    wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteBusiness({{ $confirmBusinessDeletion }})"
                    wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
        {{-- Delete users --}}
    </div>
</div>
{{-- Invocamos el modal para editar o crear una empresa --}}
@push('modals')
    <livewire:live-modal-business />
@endpush
