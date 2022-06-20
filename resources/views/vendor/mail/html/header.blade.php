<tr>
    <td class="header">
        <a href="{{ $url }}">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('logo/time_track_color.png') }}" alt="logo web">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
