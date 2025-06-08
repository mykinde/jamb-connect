@extends('layouts.toolbar')

@section('title', 'User Directory')

@section('content')

  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-sm w-100" style="max-width: 1000px;">
      <div class="card-body p-4  animate__animated animate__fadeInUp">

        <h4 class="card-title text-center mb-3">User Details</h4>

        <ul class="list-group list-group-flush mb-3">
          <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
          <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
          <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</li>
          <li class="list-group-item"><strong>Company:</strong> {{ $user->company ?? 'N/A' }}</li>
          <li class="list-group-item"><strong>City:</strong> {{ $user->city ?? 'N/A' }}</li>
          <li class="list-group-item"><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</li>
        </ul>

        <div class="d-grid gap-2">
          <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit User</a>
          <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection