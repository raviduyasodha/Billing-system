@extends('layouts.app')

@section('title', 'Items')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Items</div>
                <div class="card-subtitle">Registered items for invoices</div>
            </div>
            <a href="{{ route('items.create') }}" class="btn">
                + New item
            </a>
        </div>

        <div class="card-body">
            @if($items->isEmpty())
                <p style="color: var(--text-muted); font-size: 0.9rem;">
                    No items yet. Create your first item.
                </p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-right">Unit price</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td style="max-width: 260px;">
                                <span style="font-size: 0.8rem; color: var(--text-muted);">
                                    {{ \Illuminate\Support\Str::limit($item->description, 80) }}
                                </span>
                            </td>
                            <td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 10px;">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
