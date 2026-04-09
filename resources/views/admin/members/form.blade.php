@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $isEdit ? 'Edit Member' : 'Add Member' }}</h1>
    <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary">Back</a>
</div>

<form method="POST" action="{{ $isEdit ? route('admin.members.update', $member->id) : route('admin.members.store') }}" class="card s-card" data-ai-form="member">
    <div class="card-body p-4">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $member->mobile) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">District</label>
                <input type="text" name="district" class="form-control" value="{{ old('district', $member->district) }}" required list="member-district-list">
                <datalist id="member-district-list"><option>Raipur</option><option>Bilaspur</option><option>Durg</option><option>Bhopal</option></datalist>
            </div>
            <div class="col-md-6">
                <label class="form-label">Occupation</label>
                <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $member->occupation) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" @selected(old('status', $member->status ?? 'active') === 'active')>Active</option>
                    <option value="inactive" @selected(old('status', $member->status) === 'inactive')>Inactive</option>
                    <option value="blocked" @selected(old('status', $member->status) === 'blocked')>Blocked</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Joined At</label>
                <input type="date" name="joined_at" class="form-control" value="{{ old('joined_at', optional($member->joined_at)->format('Y-m-d')) }}">
            </div>
        </div>
    </div>
    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
        <small class="text-muted" id="member-form-hint">AI will verify required fields before submit.</small>
        <button class="btn btn-sahayata" type="submit">{{ $isEdit ? 'Update Member' : 'Create Member' }}</button>
    </div>
</form>
@endsection
