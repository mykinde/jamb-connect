@extends('layouts.toolbar')

@section('title', 'User Directory')

@section('content')



<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
  <h4 class="mb-0">User Directory</h4>

  <form action="{{ route('users.index') }}" method="GET" class="d-flex flex-grow-1 flex-md-grow-0 gap-2">
    <input
      type="text"
      name="search"
      id="search"
      class="form-control"
      placeholder="Search by name or city..."
      value="{{ request('search') }}"
    >
    <button type="submit" class="btn btn-outline-primary">Search</button>
  </form>

  <a href="{{ route('users.create') }}" class="btn btn-success">+ Add New User</a>
</div>

<div class="row">
  @foreach($users as $user)
    <div class="col-md-6 col-lg-4 mb-4  animate__animated animate__fadeInUp">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title mb-2 "><strong>Name:</strong> {{ $user->name }}</h5>
          <p class="card-text mb-1"><strong>Email:</strong> {{ $user->email }}</p>
          <p class="card-text mb-1"><strong>Phone:</strong> {{ $user->number ?? 'N/A' }}</p>
          <p class="card-text mb-1"><strong>City:</strong> {{ $user->role ?? 'N/A' }}</p>
          <p class="card-text mb-1"><strong>Company:</strong> {{ $user->company ?? 'N/A' }}</p>
          <p class="card-text mb-1"><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
          <p class="card-text mb-3"><strong>Date:</strong> {{ $user->created_at ?? 'N/A' }}</p>

          <div class="mt-auto d-flex justify-content-between align-items-center">
            <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-sm">View</a>
            <div class="d-flex gap-2">
              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-4">
  {{ $users->links() }}
</div>

@endsection
