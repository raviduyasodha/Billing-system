@extends('layouts.app')

@section('title', 'Invoice ' . $invoice->invoice_number)

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">
                    Invoice {{ $invoice->invoice_number }}
                </div>
                <div class="card-subtitle">
                    {{ $invoice->customer->name ?? 'No customer' }}
                </div>
            </div>

            <div style="text-align: right; font-size: 0.8rem;">
                <div>
                    Status:
                    @php $s = $invoice->status; @endphp
                    <span class="badge badge-{{ $s }}">{{ strtoupper($s) }}</span>
                </div>
                <div style="margin-top: 4px; color: var(--text-muted);">
                    Date: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') }}<br>
                    @if($invoice->due_date)
                        Due: {{ \Carbon\Carbon::parse($invoice->due_date)->format('Y-m-d') }}
                    @endif
                </div>
            </div>
        </div>

        <div class="card-body">
            {{-- Customer details --}}
            <div class="summary" style="margin-bottom: 14px;">
                <div class="summary-row">
                    <span class="summary-label">Customer</span>
                    <span class="summary-value">
                        {{ $invoice->customer->name ?? '-' }}
                    </span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Email</span>
                    <span class="summary-value">
                        {{ $invoice->customer->email ?? '-' }}
                    </span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Phone</span>
                    <span class="summary-value">
                        {{ $invoice->customer->phone ?? '-' }}
                    </span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Address</span>
                    <span class="summary-value">
                        {{ $invoice->customer->address ?? '-' }}
                    </span>
                </div>
            </div>

            {{-- Items table --}}
            <div class="items-card">
                <div class="items-header">
                    <div class="items-title">Items</div>
                </div>

                @if($invoice->items->isEmpty())
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 8px 0 0;">
                        No items added.
                    </p>
                @else
                    <table class="table" style="margin-bottom: 0;">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Unit price</th>
                            <th class="text-right">Line total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->items as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td class="text-right">{{ $item->quantity }}</td>
                                <td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-right">{{ number_format($item->line_total, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{-- Totals --}}
            <div class="summary" style="margin-top: 14px; max-width: 320px; margin-left: auto;">
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">{{ number_format($invoice->subtotal, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Tax</span>
                    <span class="summary-value">{{ number_format($invoice->tax, 2) }}</span>
                </div>
                <div class="summary-row summary-total">
                    <span class="summary-label">Total</span>
                    <span class="summary-value">{{ number_format($invoice->total, 2) }}</span>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('invoices.index') }}" class="btn-secondary btn">Back to invoices</a>
                <a href="{{ route('invoices.create') }}" class="btn">Create another invoice</a>
            </div>
        </div>
    </div>
@endsection
