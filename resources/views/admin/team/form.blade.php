@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $isEdit ? 'Edit Team Member' : 'Add Team Member' }}</h1>
    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">Back</a>
</div>

<div class="progress mb-3" role="progressbar" aria-label="Form progress" aria-valuemin="0" aria-valuemax="100" aria-valuenow="75">
    <div class="progress-bar" style="width:75%">Step 3/4 - Profile</div>
</div>

<form method="POST" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.team.update', $member->id) : route('admin.team.store') }}" class="card s-card" data-ai-form="team-member">
    <div class="card-body p-4">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Designation</label>
                <select name="designation" class="form-select" id="designation" required>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @selected(old('designation', $member->designation) === $role)>{{ $role }}</option>
                    @endforeach
                </select>
                <small id="designation-hint" class="text-muted">AI can suggest role based on bio keywords.</small>
            </div>
            <div class="col-md-6">
                <label class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control" id="photo-input" accept="image/*">
                <small class="text-muted">AI helper validates file quality and size (max 2MB).</small>
            </div>
            <div class="col-md-6">
                <label class="form-label">District / Location</label>
                <input name="district" class="form-control" value="{{ old('district', $member->district) }}" required list="district-list">
                <datalist id="district-list"><option>Raipur</option><option>Bilaspur</option><option>Durg</option><option>Jabalpur</option></datalist>
            </div>
            <div class="col-md-6">
                <label class="form-label">Mobile</label>
                <input name="mobile" class="form-control" value="{{ old('mobile', $member->mobile) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input name="email" class="form-control" type="email" value="{{ old('email', $member->email) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Joining Date</label>
                <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', optional($member->joining_date)->format('Y-m-d')) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" @selected(old('status', $member->status ?? 'active') === 'active')>Active</option>
                    <option value="inactive" @selected(old('status', $member->status) === 'inactive')>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <div class="form-check">
                    <input type="hidden" name="contact_visible" value="0">
                    <input class="form-check-input" type="checkbox" value="1" id="contact_visible" name="contact_visible" @checked(old('contact_visible', $member->contact_visible))>
                    <label class="form-check-label" for="contact_visible">Show contact publicly</label>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">Short Bio</label>
                <textarea name="bio" class="form-control" rows="4" id="bio-input">{{ old('bio', $member->bio) }}</textarea>
                <small class="text-muted" id="bio-hint">AI will auto-format and check clarity.</small>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
        <small class="text-muted" id="form-quality-msg">Form quality: waiting for input…</small>
        <button class="btn btn-sahayata" type="submit">{{ $isEdit ? 'Update Member' : 'Create Member' }}</button>
    </div>
</form>
@endsection
