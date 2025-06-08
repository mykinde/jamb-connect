@extends('layouts.toolbar')

@section('title', 'User Directory')

@section('content')


   



  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-sm w-100" style="max-width: 1000px;">
      <div class="card-body p-4 animate__animated animate__fadeInDown">
        <h3 class="card-title text-center mb-4">Edit User</h3>

        <form method="POST" action="{{ route('users.update', $user->id) }}">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" 
                     id="name" 
                     name="name" 
                     class="form-control @error('name') is-invalid @enderror" 
                     value="{{ old('name', $user->name) }}" required autofocus>
              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" 
                     id="email" 
                     name="email" 
                     class="form-control @error('email') is-invalid @enderror" 
                     value="{{ old('email', $user->email) }}" required>
              @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="text" 
                     id="phone" 
                     name="phone" 
                     class="form-control @error('phone') is-invalid @enderror" 
                     value="{{ old('phone', $user->phone) }}">
              @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="company" class="form-label">Company</label>
              <input type="text" 
                     id="company" 
                     name="company" 
                     class="form-control @error('company') is-invalid @enderror" 
                     value="{{ old('company', $user->company) }}">
              @error('company') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" 
                     id="city" 
                     name="city" 
                     class="form-control @error('city') is-invalid @enderror" 
                     value="{{ old('city', $user->city) }}">
              @error('city') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" 
                     id="address" 
                     name="address" 
                     class="form-control @error('address') is-invalid @enderror" 
                     value="{{ old('address', $user->address) }}">
              @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="role" class="form-label">Role</label>
              <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
              @error('role') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
          </div>

          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
<div class="d-grid mt-4">
          <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-2">Go Back</a>
         
        </div>
      </div>
    </div>
  </div>

@endsection