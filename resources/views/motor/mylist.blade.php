@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card p-medium">
        <div class="flex justify-between items-center mb-medium">
            <h1 class="m-0">Kelola Motor</h1>
            <a href="{{ route('motor.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; margin-right: 4px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Motor
            </a>
        </div>

        @if($motors->isEmpty())
            <div class="text-center p-large">
                <p class="text-muted mb-medium">Anda belum memiliki motor yang dijual.</p>
                <a href="{{ route('motor.create') }}" class="btn btn-primary">Mulai Jual Motor</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Motor</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($motors as $motor)
                            <tr>
                                <td>
                                    @if($motor->primaryImage)
                                        <img src="{{ asset($motor->primaryImage->image_url) }}" 
                                             alt="{{ $motor->name }}" 
                                             class="my-cars-img-thumbnail">
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $motor->name }}</div>
                                    <small class="text-muted">{{ $motor->maker->name }} {{ $motor->motorModel->name }}</small>
                                </td>
                                <td>Rp {{ number_format($motor->price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="car-item-badge">
                                        {{ $motor->published_at ? 'Aktif' : 'Draft' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="{{ route('motor.edit', $motor->id) }}" 
                                           class="btn-link btn-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('motor.destroy', $motor->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus motor ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-link btn-delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-medium">
                {{ $motors->links() }}
            </div>
        @endif
    </div>
</div>
@endsection