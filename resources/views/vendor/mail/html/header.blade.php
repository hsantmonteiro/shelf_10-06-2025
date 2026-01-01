@props(['url'])
<tr>
<td class="header">
@if (trim($slot) === 'Shelf')
<img src="https://imgur.com/AaXoGnz.png" class="logo" alt="Shelf Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
