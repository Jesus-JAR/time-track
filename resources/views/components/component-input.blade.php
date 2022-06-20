{{-- Componente input empleado en los formularios de empresas y usuarios cuando se precise --}}

<div>
    <div class="py-2">
        <x-jet-label for="{{$name}}" class="ml-1 text-lg">{{$label}}</x-jet-label>
        <x-jet-input
                wire:model="{{$name}}"
                id="{{$name}}"
                type="{{$type ?? ''}}"
                class="py-2 w-3/4" placeholder="{{$placeholder}}"></x-jet-input>
    </div>
    @if($errors->has($name))
        <small class="text-red-600">{{$errors->first($name)}}</small>
    @endif

</div>
