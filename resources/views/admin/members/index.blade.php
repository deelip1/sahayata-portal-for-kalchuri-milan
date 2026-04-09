@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Member Management</h1>
        <p class="text-muted mb-0">Manage community members with AI-supported validation.</p>
    </div>
    <a href="{{ route('admin.members.create') }}" class="btn btn-sahayata">+ Add Member</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('admin.members.index') }}" data-ai-search="members">
    <div class="col-md-4"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search by name, mobile, district"></div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">All status</option>
            @foreach($statuses as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2"><button class="btn btn-outline-secondary w-100">Filter</button></div>
    <div class="col-md-3 d-flex align-items-center"><small class="text-muted" id="member-search-hint">AI tip: mobile + district narrows faster.</small></div>
</form>

<div class="card s-card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>District</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($members as $member)
                <tr>
                    <td class="fw-semibold">{{ $member->name }}</td>
                    <td>{{ $member->mobile }}</td>
                    <td>{{ $member->district }}</td>
                    <td><span class="badge text-bg-{{ $member->status === 'active' ? 'success' : ($member->status === 'blocked' ? 'danger' : 'secondary') }}">{{ ucfirst($member->status) }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this member?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No members available.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $members->links() }}</div>
@endsection
