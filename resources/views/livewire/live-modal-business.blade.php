<div>
    <form action="" wire:submit.prevent="{{ $method }}">
{{-- llamamos al modal para crear y editar empresa y añadimos los inputs mediante el componente component-input --}}
        <x-component-modal-business :showModal="$showModal" :action="$action" :title="$title">

            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">{{ $title }}</h3>
                <div class="mt-2">

                    <x-component-input placeholder="Enter business name" name="name" label="Name:">
                    </x-component-input>
                    <x-component-input placeholder="Enter business address" name="address" label="Address:">
                    </x-component-input>
                    <div class="flex flex-col">
                        <div>
                            <x-jet-label class="ml-1 text-lg" for="description">Description:</x-jet-label>
                            <textarea name="description" id="description" cols="30" rows="5"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                wire:model="description">
                </textarea>
                        </div>

                        <div>
                            @if ($errors->has('description'))
                                <small class="text-red-600">{{ $errors->first('description') }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </x-component-modal-business>
    </form>

</div>
