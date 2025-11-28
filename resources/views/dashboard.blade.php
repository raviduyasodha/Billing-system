@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Dashboard</div>
                <div class="card-subtitle">Quick overview and shortcuts</div>
            </div>
        </div>

        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap: 14px;">
                {{-- Customers card --}}
                <div class="summary" style="background: radial-gradient(circle at top left, rgba(59,130,246,0.18) 0, #020617 60%);">
                    <div class="summary-row">
                        <span class="summary-label">Customers</span>
                        <span class="summary-value">{{ $customerCount }}</span>
                    </div>
                    <div style="margin-top: 8px; display:flex; gap:8px;">
                        <a href="{{ route('customers.index') }}" class="btn-secondary btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            View all
                        </a>
                        <a href="{{ route('customers.create') }}" class="btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            + New customer
                        </a>
                    </div>
                </div>

                {{-- Invoices card --}}
                <div class="summary" style="background: radial-gradient(circle at top left, rgba(16,185,129,0.18) 0, #020617 60%);">
                    <div class="summary-row">
                        <span class="summary-label">Invoices</span>
                        <span class="summary-value">{{ $invoiceCount }}</span>
                    </div>
                    <div style="margin-top: 8px; display:flex; gap:8px;">
                        <a href="{{ route('invoices.index') }}" class="btn-secondary btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            View all
                        </a>
                        <a href="{{ route('invoices.create') }}" class="btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            + New invoice
                        </a>
                    </div>
                </div>
            </div>

            <div style="margin-top: 18px; font-size: 0.85rem; color: var(--text-muted);">
                From here you mainly use:
                <ul style="margin-top: 6px; padding-left: 18px;">
                    <li><strong>Customers</strong> to register clients</li>
                    <li><strong>Invoices</strong> to create invoices with items</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
