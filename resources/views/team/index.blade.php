@extends('layouts.app')

@section('content')
<div class="card s-card mb-4 border-0">
    <div class="card-body p-4 p-lg-5">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
            <div>
                <h1 class="display-6 fw-bold mb-2">Sahayata Foundation Team</h1>
                <p class="text-muted mb-0">Visible leadership, transparent coordination, and trusted volunteer network.</p>
            </div>
            <span class="ai-chip"><i class="bi bi-lightning-charge me-1"></i>AI quick search ready</span>
        </div>
    </div>
</div>

<form class="row g-2 mb-4" method="GET" action="{{ route('team.index') }}" data-ai-search="frontend-team">
    <div class="col-12 col-md-5">
        <input type="text" name="q" class="form-control form-control-lg" placeholder="Search name / district" value="{{ $search }}">
    </div>
    <div class="col-12 col-md-4">
        <select name="role" class="form-select form-select-lg">
            <option value="">All roles</option>
            @foreach($roles as $role)
                <option value="{{ $role }}" @selected($selectedRole === $role)>{{ $role }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3">
        <button class="btn btn-sahayata btn-lg w-100" type="submit">Apply Filters</button>
    </div>
</form>

@php
    $sections = [
        'Leadership Team' => $leadership,
        'State / District Team' => $districtTeam,
        'Volunteers' => $volunteers,
    ];
@endphp

@foreach($sections as $label => $items)
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">{{ $label }}</h2>
        <span class="badge text-bg-light">{{ $items->count() }} members</span>
    </div>

    <div class="row g-3">
        @forelse($items as $member)
            <div class="col-sm-6 col-xl-4">
                <article class="card s-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://placehold.co/84x84?text=Team' }}" alt="{{ $member->name }}"
                                 class="rounded-circle object-fit-cover" width="84" height="84" loading="lazy">
                            <div>
                                <h3 class="h5 mb-1">{{ $member->name }}</h3>
                                <span class="badge text-bg-primary">{{ $member->designation }}</span>
                            </div>
                        </div>
                        <div class="small text-muted mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $member->district }}</div>
                        @if($member->bio)
                            <p class="small">{{ $member->bio }}</p>
                        @endif
                        @if($member->contact_visible)
                            <div class="border-top pt-2 small">
                                @if($member->mobile)<div><i class="bi bi-telephone me-1"></i>{{ $member->mobile }}</div>@endif
                                @if($member->email)<div><i class="bi bi-envelope me-1"></i>{{ $member->email }}</div>@endif
                            </div>
                        @endif
                    </div>
                </article>
            </div>
        @empty
            <p class="text-muted">No team members found for this section.</p>
        @endforelse
    </div>
</section>
@endforeach
@endsection
