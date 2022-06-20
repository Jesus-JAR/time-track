<div>
    <form action="" wire:submit.prevent="updateUser">
        <x-component-modal :showModal="$showModal">
            <div class="mt-3 text-center sm:mt-0 text-gray-900">
                <h3 class="uppercase text-lg leading-6 font-bold text-gray-900" id="modal-headline">
                    update user
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-900">
                    <div class="container mt-4 flex space-x-2">

                        <!-- First Name -->
                        <div class="mt-4 relative">
                            <x-component-input placeholder="Enter your last name" name="first_name" label="First Name:">
                            </x-component-input>
                        </div>

                        <!-- Last Name -->
                        <div class="mt-4 relative pl-3">
                            <x-component-input placeholder="Enter your last name" name="last_name" label="Last Name:">
                            </x-component-input>
                        </div>
                    </div>

                    <div class="container mt-4 flex space-x-2">

                        <!-- Dni -->
                        <div class="mt-4 relative pl-3">
                            <x-component-input placeholder="Insert your dni" name="dni" label="Dni:">
                            </x-component-input>
                        </div>


                        <!-- Phone -->
                        <div class="mt-4 relative pl-3">
                            <x-component-input placeholder="Enter your phone" name="phone" label="Phone:">
                            </x-component-input>
                        </div>
                    </div>

                    <div class="container mt-4 flex justify-around">

                        <!-- Email -->
                        <div class="mt-4 relative pl-3">
                            <x-component-input placeholder="Enter your email" type="email" name="email" label="Email:">
                            </x-component-input>
                        </div>

                        <!-- Rol -->
                        <div class="mt-4 relative w-1/2">
                            <x-jet-label for="rol" class="text-lg" value="{{ __('Rol') }}" />
                            <select
                                class="border-gray-300 focus:border-sea-300 focus:ring focus:ring-sea-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                id="rol" name="rol" type="text" wire:model="rol">
                                <option value="Developer">Select rol</option>
                                <option value="Admin">Admin</option>
                                <option value="Manager">Manager</option>
                                <option value="Developer">Developer</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <!-- Work hours -->
                        <div class="mt-4 relative w-48">
                            <x-jet-label class="text-lg" for="work_hours" value="{{ __('Work hours:') }}" />
                            <x-jet-input id="work_hours" name="work_hours" type="number" min="6" class="mt-1 block w-20"
                                wire:model="work_hours" />
                            @error('work_hours')
                                <span class="error text-red-600 text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <x-component-input-select></x-component-input-select>
                    </div>
                </div>


            </div>
        </x-component-modal>
    </form>

</div>

