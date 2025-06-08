<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Company</label>
    <input type="text" name="company" value="{{ old('company', $user->company ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>City</label>
    <input type="text" name="city" value="{{ old('city', $user->city ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>Address</label>
    <textarea name="address" class="form-control">{{ old('address', $user->address ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Role</label>
    <select name="role" class="form-control" required>
        <option value="user" @selected(old('role', $user->role ?? '') === 'user')>User</option>
        <option value="admin" @selected(old('role', $user->role ?? '') === 'admin')>Admin</option>
    </select>
</div>
@if(!isset($user))
<div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
</div>
<div class="mb-3">
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" required>
</div>
@endif
<button class="btn btn-success">{{ $button }}</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
