@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h3>Welcome, {{ Auth::user()->name }} 👋</h3>
            <p class="text-muted">Manage your marketplace activities</p>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>My Items</h5>
                    <p class="text-muted">View and manage your listings</p>
                    <button class="btn btn-primary btn-sm">View Items</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Add Item</h5>
                    <p class="text-muted">Post a new item for sale</p>
                    <button class="btn btn-success btn-sm">Add Item</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Messages</h5>
                    <p class="text-muted">Chat with buyers & sellers</p>
                    <button class="btn btn-secondary btn-sm">Open Messages</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
