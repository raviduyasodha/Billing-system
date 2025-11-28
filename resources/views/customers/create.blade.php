@extends('layouts.app')

@section('title', 'New customer')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">New customer</div>
                <div class="card-subtitle">Register a customer for future invoices</div>
            </div>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-error">
                    <strong>There were some problems:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea name="address"
                                  class="form-control"
                                  rows="2">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('customers.index') }}" class="btn-secondary btn">Cancel</a>
                    <button type="submit" class="btn">Save customer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
