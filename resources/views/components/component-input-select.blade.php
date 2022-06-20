{{-- Componente select que obtiene los datos de la base de datos el cual usamos cuando se necesite --}}
<div class="py-2">
    <x-jet-label class="text-lg" for="cod_emp" value="{{ __('Bussines:') }}" />
    <select id="cod_emp" wire:model='cod_emp' name="cod_emp" class="border-gray-300 focus:border-sea-300 focus:ring focus:ring-sea-200 focus:ring-opacity-50 rounded-md shadow-sm">
        <option value="">Select Company</option>
        @foreach ($business ?? '' as $company)
            <option value="{{ $company->id }}">{{ $company->name }}</option>
        @endforeach
    </select>
</div>
