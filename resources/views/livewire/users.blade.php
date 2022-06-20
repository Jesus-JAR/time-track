<div class="p-6 sm:px-20 bg-white border-gray-200">
    <div class="mt-8 text-2xl flex justify-between">

        <div class="text-gray-600 font-bold text-2xl md:text-4xl">{{ __('Users') }}</div>

        @if (!auth()->user()->hasRole('Super Admin'))
            <div class=" text-gray-600 font-bold text-2xl md:text-4xl">
                @foreach ($companies as $company)
                    <h1>{{ $company->name }}</h1>
                @endforeach
            </div>
        @endif

        <div>
            @if (auth()->user()->hasRole('Super Admin') xor
                auth()->user()->hasRole('Admin'))
                <button wire:click="confirmUserAdd"
                    class="bg-sea-600 hover:bg-sea-500 text-white font-bold py-1 px-2 border-b-4 border-sea-700 hover:border-sea-500 rounded">
                    New User
                </button>
            @endif
        </div>
    </div>

    <div class="hidden md:block overflow-x-auto">
        <div class="mt-6">
            <div class="flex text-gray-500">
                <select wire:model="perPage" name="" id=""
                class="h-10 mr-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="">selected</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
                <x-jet-input id="search" placeholder="Search..." class="block w-full mb-3" type="text" name="search"
                    wire:model="search" />

                <button wire:click="clear">
                    <span class="ml-2 fa-solid fa-eraser text-gray-500 text-4xl"></span>
                </button>
            </div>
            <div class="mt-2 shadow-lg">
                <table class="table-auto w-full">
                    <thead>
                        <!-- head -->
                        <tr class="bg-sea-100 border-2 border-gray-200">
                            <th class="px-4 py-2 border-r-2 border-gray-200">
                                <div class="flex items-center cursor-pointer mr-3 justify-beetwen"
                                    wire:click="sortBy('id')">
                                    <button>ID</button>
                                    <x-sort-icon sort-field="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                                </div>
                            </th>
                            <th class="px-4 py-2 border-r-2 border-gray-200">
                                <div class="flex items-center cursor-pointer mr-3" wire:click="sortBy('first_name')">
                                    <button>First name</button>
                                    <x-sort-icon sort-field="first_name" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                                </div>
                            </th>
                            <th class="px-4 py-2 border-r-2 border-gray-200">
                                <div class="flex items-center cursor-pointer" wire:click="sortBy('last_name')">
                                    <button>Last name</button>
                                    <x-sort-icon sort-field="last_name" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                                </div>
                            </th>
                            @if (!(
                                auth()->user()->hasRole('Super Admin') xor
                                auth()->user()->hasRole('Admin')
                            ))
                                <th class="px-4 py-2 border-r-2 border-gray-200">
                                    <div class="flex items-center cursor-pointer w-32" wire:click="sortBy('email')">
                                        <button>Email</button>
                                        <x-sort-icon sort-field="email" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                                    </div>
                                </th>
                            @endif

                            @if (auth()->user()->hasRole('Super Admin'))
                                <th class="px-4 py-2 border-r-2 border-gray-200">
                                    <div class="flex items-center cursor-pointer w-32" wire:click="sortBy('cod_emp')">
                                        <button>Company</button>
                                        <x-sort-icon sort-field="cod_emp" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                                    </div>
                                </th>
                            @endif
                            @if (!(auth()->user()->hasRole('Developer')))
                            <th class="px-4 py-2 border-r-2 border-gray-200">
                                <div class="flex items-center">
                                    Rol
                                </div>
                            </th>

                            @endif
                            @if (auth()->user()->hasRole('Super Admin') xor
                                auth()->user()->hasRole('Admin'))
                                <th class="px-4 py-2">
                                    Actions
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <!-- body -->
                        @foreach ($users as $user)
                            <tr class="border-2 border-gray-200">
                                <td class="px-4 py-2 w-3 border-r-2 border-gray-200">{{ $user->id }}</td>
                                <td class="px-4 py-2 border-r-2 border-gray-200">{{ $user->first_name }}</td>
                                <td class="px-4 py-2 border-r-2 border-gray-200">{{ $user->last_name }}</td>
                                @if (!(
                                    auth()->user()->hasRole('Super Admin') xor
                                    auth()->user()->hasRole('Admin')
                                ))
                                    <td class="px-4 py-2 border-r-2 border-gray-200">{{ $user->email }}</td>
                                @endif

                                @if (auth()->user()->hasRole('Super Admin'))
                                    <td class="px-4 py-2 border-r-2 border-gray-200">{{ $user->business->name }}</td>
                                @endif

                                <td class="px-4 py-2 border-r-2 border-gray-200">
                                    @foreach ($user->getRoleNames() as $role)
                                        {{ $role }}
                                    @endforeach
                                </td>
                                @if (auth()->user()->hasRole('Super Admin') xor
                                    auth()->user()->hasRole('Admin'))
                                    <td class="px-4 py-2 w-auton flex justify-around">
                                        <button wire:click="showModal({{ $user->id }})"
                                            class="bg-ochre-500 hover:bg-ochre-400 px-2 text-white border-ochre-700 hover:border-ochre-500 rounded uppercase">
                                            Edit
                                        </button>

                                        @if (auth()->user()->hasRole('Super Admin') xor
                                            auth()->user()->hasRole('Admin'))
                                            <x-jet-danger-button wire:click="confirmUserDeletion({{ $user->id }})"
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
        </div>
        <div class="mt-4 h-auto">
            {{ $users->links() }}
        </div>
    </div>

    <div class="">
        {{-- Display mobile --}}
        <div class="bg-white p-4 md:hidden">
            <div class="flex">
                <x-jet-input wire:model.debounce.500ms="search" type="search" placeholder="Search"
                    class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />

            </div>

            <div class="grid pt-2 mt-2 grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">

                @foreach ($users as $user)
                    <div class="bg-sea-100 space-y-3 p-4 rounded-lg shadow">
                        <div class="flex items-center space-x-2 text-sm">
                            <div>
                                <a href="#" class="text-blue-500 font-bold hover:underline">{{ $user->id }}</a>
                            </div>
                            <div class="text-gray-500">{{ $user->first_name }}, {{ $user->last_name }}</div>
                            <div>
                                @foreach ($user->getRoleNames() as $role)
                                    {{ $role }}
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <span
                                class="p-1.5 text-xs font-bold tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-40">{{ $user->email }}</span>
                        </div>
                        @if (auth()->user()->hasRole('Super Admin')  xor auth()->user()->hasRole('Admin'))
                            <div class="flex justify-around px-4 py-1 my-1">
                                <button wire:click="showModal({{ $user->id }})"
                                    class="bg-ochre-500 hover:bg-ochre-400 px-2 text-white font-bold border-ochre-700 hover:border-ochre-500 rounded">
                                    Edit
                                </button>
                                <x-jet-danger-button wire:click="confirmUserDeletion({{ $user->id }})"
                                    wire:loading.attr="disabled">
                                    {{ __('Delete') }}
                                </x-jet-danger-button>
                            </div>
                        @endif
                    </div>
                @endforeach

            </div>
            <div class="bg-white px-4 py-3  items-center justify-between border-t border-gray-200 sm:px-6">
                {{ $users->links() }}
            </div>

        </div>
        {{-- Display mobile --}}
    </div>

    @if (auth()->user()->hasRole('Super Admin') xor
        auth()->user()->hasRole('Admin'))

        {{-- Delete users --}}
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete User') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this user?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingUserDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteUser({{ $confirmingUserDeletion }})"
                    wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
        {{-- Delete users --}}

        <!-- Add users -->
        <x-jet-dialog-modal wire:model="confirmingUserAdd">
            <x-slot name="title">
                <div class="flex">
                    {{-- Icono de add user --}}
                    <div
                        class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10 mr-3">
                        <!-- Heroicon name: outline/exclamation -->
                        <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    {{-- Fin Icono de add user --}}

                    <h2 class="ml-4 font-bold text-xl">{{ __('Add User') }}</h2>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="container mt-4 flex space-x-2">


                    <!-- First Name -->
                    <div class="mt-4 relative">
                        <x-jet-label for="first_name" class="text-lg" value="{{ __('First name') }}" />
                        <x-jet-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" autofocus
                            autocomplete="first_name" wire:model.lazy="first_name" />
                        @error('first_name')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="mt-4 relative pl-3">
                        <x-jet-label for="last_name" class="text-lg" value="{{ __('Last name') }}" />
                        <x-jet-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                            autocomplete="last_name" wire:model.lazy="last_name" />
                        @error('last_name')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <div class="container mt-4 flex space-x-2">

                    <!-- Rol -->
                    <div class="mt-4 relative mr-32 w-48">
                        <x-jet-label for="rol" class="text-lg" value="{{ __('Rol') }}" />
                        <select
                            class="border-gray-300 focus:border-sea-300 focus:ring focus:ring-sea-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="rol" name="rol" type="text" wire:model.lazy="rol">
                            <option value="Developer">Select rol</option>
                            @if (auth()->user()->hasRole('Super Admin'))
                                <option value="Super Admin">Super Admin</option>
                            @endif
                            <option value="Admin">Admin</option>
                            <option value="Manager">Manager</option>
                            <option value="Developer">Developer</option>
                        </select>
                    </div>

                    <!-- Work hours -->

                    <div class="mt-4 relative">
                        <x-jet-label class="text-lg" for="work_hours" value="{{ __('Work hours:') }}" />
                        <x-jet-input id="work_hours" name="work_hours" type="number" min="6" class="mt-1 block w-20"
                            wire:model="work_hours" />
                        @error('work_hours')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <div class="container mt-4 flex space-x-2">
                    <!-- Email -->
                    <div class="mt-4 relative">
                        <x-jet-label class="text-lg" for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" type="email" name="email" class="mt-1 block w-full"
                            wire:model.lazy="email" />
                        @error('email')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mt-4 relative pl-3">
                        <x-jet-label class="text-lg" for="phone" value="{{ __('Phone') }}" />
                        <x-jet-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                            wire:model.lazy="phone" />
                        @error('phone')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="container mt-4 flex space-x-2">

                    <div class="relative" x-data="{ show: false }">
                        <x-jet-label class="text-lg" for="password" value="{{ __('Password') }}" />
                        <x-jet-input wire:model.lazy="password" id="password" maxlength="15" class="block mt-1 w-full"
                            type="password" name="password" required />
                        @error('password')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="relative pl-3">
                        <x-jet-label class="text-lg" for="password_confirmation"
                            value="{{ __('Confirm Password:') }}" />
                        <x-jet-input wire:model.lazy="password_confirmation" id="password_confirmation" maxlength="15"
                            class="block mt-1 w-full" type="password" name="password_confirmation" required
                            autocomplete="new-password" />
                        @error('password_confirmation')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="container mt-4 flex space-x-2">
                    <!-- Dni -->
                    <div class="mt-4 relative pr-3">
                        <x-jet-label class="text-lg" for="dni" value="{{ __('Dni') }}" />
                        <x-jet-input id="dni" name="dni" type="text" class="mt-1 block w-full" wire:model="dni" />
                        @error('dni')
                            <span class="error text-red-600 text-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4 relative">
                        <x-jet-label class="text-lg" for="business" value="{{ __('Business:') }}" />
                        <select id="cod_emp" name="cod_emp" wire:model.lazy="cod_emp"
                            class="border-gray-300 focus:border-sea-300 focus:ring focus:ring-sea-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">Select Company</option>
                            @if (auth()->user()->hasRole('Super Admin'))
                                <option value="1">Super Admin</option>
                            @endif
                            @foreach ($business as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('cod_emp')
                                <span class="error text-red-600 text-bold">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                </div>

            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingUserAdd', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="saveUser()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>


    @endif

</div>
@push('modals')
ç    <livewire:live-modal />
@endpush

