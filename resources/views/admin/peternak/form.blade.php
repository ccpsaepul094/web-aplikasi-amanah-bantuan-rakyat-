<div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $peternak->nama ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $peternak->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" {{ isset($peternak) ? '' : 'required' }}>
    @if(isset($peternak))
        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
    @endif
</div>

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" name="is_approved" id="is_approved" 
        {{ old('is_approved', $peternak->is_approved ?? false) ? 'checked' : '' }}>
    <label for="is_approved" class="form-check-label">Disetujui</label>
</div>
