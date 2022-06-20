
{{-- Componente iconos usado en la vista users --}}
@props(['sortBy', 'sortAsc', 'sortField'])
@if($sortBy === $sortField)
    @if($sortAsc)
        <span class="w-4 ml-3">
            <i class="fa-solid fa-angle-up"></i>
        </span>
    @endif
    @if(!$sortAsc)
        <span class="w-4 ml-4">
            <i class="fa-solid fa-angle-down"></i>
        </span>
    @endif

@endif


