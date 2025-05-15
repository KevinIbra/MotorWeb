<div class="card">
    <div class="card header">{{$tittle}}</div>
    @if ($slot->isEmpty())
        <p>Please Help</p>
    @else
    {{ $slot }}
    @endif
    <div class="card footer">{{$footer}}</div>
</div>