<div>
    {{-- Modal de crear y editar empresa --}}
<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="{{ $showModal }} inset-0 bg-gray-500 bg-opacity-40 transition-opacity"></div>

    <div class="{{ $showModal }} z-10 inset-0 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">

            <div
                class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-sea-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fa-solid fa-pen-to-square text-sea-500 text-xl"></i>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-sea-600 text-base font-medium text-white hover:bg-sea-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sea-500 sm:ml-3 sm:w-auto sm:text-sm uppercase">
                        {{ $action }}
                    </button>
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm uppercase"
                        wire:click='closeModal'>
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div></div>
