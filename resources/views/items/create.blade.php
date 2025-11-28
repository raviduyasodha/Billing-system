@extends('layouts.app')

@section('title', 'New item')

@section('content')
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">New item</div>
                <div class="card-subtitle">Register an item with default price</div>
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

            <form action="{{ route('items.store') }}" method="POST">
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
                        <label class="form-label">Unit price</label>
                        <input type="number"
                               step="0.01"
                               name="unit_price"
                               class="form-control"
                               value="{{ old('unit_price') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description (optional)</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('items.index') }}" class="btn-secondary btn">Cancel</a>
                    <button type="submit" class="btn">Save item</button>
                </div>
            </form>
        </div>
    </div>
@endsection
