@props(['value' => false])

@if($value)
    <li class="car-specification-item active">
        {{ $slot }}
    </li>
@else
    <li class="car-specification-item">
        {{ $slot }}
    </li>
@endif



