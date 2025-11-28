@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Customers</div>
                <div class="card-subtitle">Registered customers</div>
            </div>
            <a href="{{ route('customers.create') }}" class="btn">
                + New customer
            </a>
        </div>

        <div class="card-body">
            @if($customers->isEmpty())
                <p style="color: var(--text-muted); font-size: 0.9rem;">
                    No customers yet. Add your first customer.
                </p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? '-' }}</td>
                            <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 10px;">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
