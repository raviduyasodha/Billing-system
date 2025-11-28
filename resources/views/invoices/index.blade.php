@extends('layouts.app')

@section('title', 'Invoices')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Invoices</div>
                <div class="card-subtitle">Overview of all invoices</div>
            </div>
            <a href="{{ route('invoices.create') }}" class="btn">+ New Invoice</a>
        </div>

        <div class="card-body">
            @if($invoices->isEmpty())
                <p style="color: var(--text-muted); font-size: 0.9rem;">No invoices yet. Create your first one.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') }}</td>
                            <td>
                                @php $s = $invoice->status; @endphp
                                <span class="badge badge-{{ $s }}">
                                    {{ strtoupper($s) }}
                                </span>
                            </td>
                            <td class="text-right">
                                {{ number_format($invoice->total, 2) }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('invoices.show', $invoice) }}" class="btn-secondary btn" style="padding: 4px 10px; font-size: 0.78rem;">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 10px;">
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
