@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Team Management</h1>
        <p class="text-muted mb-0">Manage leadership, district coordinators, and volunteers.</p>
    </div>
    <a href="{{ route('admin.team.create') }}" class="btn btn-sahayata">+ Add Team Member</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card s-card metric"><div class="card-body"><small>Total</small><h4>{{ $stats['total'] }}</h4></div></div></div>
    <div class="col-md-3"><div class="card s-card metric"><div class="card-body"><small>Active</small><h4>{{ $stats['active'] }}</h4></div></div></div>
    <div class="col-md-3"><div class="card s-card metric"><div class="card-body"><small>Inactive</small><h4>{{ $stats['inactive'] }}</h4></div></div></div>
    <div class="col-md-3"><div class="card s-card metric"><div class="card-body"><small>Role Types</small><h4>{{ count($stats['role_distribution']) }}</h4></div></div></div>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('admin.team.index') }}" data-ai-search="team">
    <div class="col-md-4"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="AI quick search (name/district/role)"></div>
    <div class="col-md-3">
        <select name="role" class="form-select">
            <option value="">All roles</option>
            @foreach($roles as $role)
                <option value="{{ $role }}" @selected(request('role') === $role)>{{ $role }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2"><button class="btn btn-outline-secondary w-100">Filter</button></div>
    <div class="col-md-3 d-flex align-items-center"><small class="text-muted" id="team-search-hint">Try district + role together.</small></div>
</form>

<div class="card s-card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>District</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($members as $member)
                <tr>
                    <td class="fw-semibold">{{ $member->name }}</td>
                    <td>{{ $member->designation }}</td>
                    <td>{{ $member->district }}</td>
                    <td><span class="badge {{ $member->status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($member->status) }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this member?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No members yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $members->links() }}</div>
@endsection
