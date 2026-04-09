@extends('layouts.app')

@section('content')
<section class="mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <h1 class="h3 mb-1">Sahayata Admin Dashboard</h1>
            <p class="text-muted mb-0">AI-assisted governance panel for cases, contributions, team, and members.</p>
        </div>
        <span class="ai-chip"><i class="bi bi-stars me-1"></i>AI insights enabled</span>
    </div>
</section>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3"><div class="card s-card metric"><div class="card-body"><small>Active Cases</small><h4 class="mb-0">{{ $stats['active_cases'] }}</h4></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card s-card metric"><div class="card-body"><small>Total Contributions</small><h4 class="mb-0">{{ $stats['total_contributions'] }}</h4></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card s-card metric"><div class="card-body"><small>Pending Approvals</small><h4 class="mb-0">{{ $stats['pending_approvals'] }}</h4></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card s-card metric"><div class="card-body"><small>Team / Members</small><h4 class="mb-0">{{ $stats['team_members'] }} / {{ $stats['members'] }}</h4></div></div></div>
</div>

<div class="card s-card">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h2 class="h5 mb-0">AI Insights Panel</h2>
        <span class="badge text-bg-success">Live Assist</span>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush" id="ai-insight-list">
            <li class="list-group-item px-0"><strong>Contribution trend:</strong> {{ $aiInsights['contribution_trend'] }}</li>
            <li class="list-group-item px-0"><strong>Risk alerts:</strong> {{ $aiInsights['risk_alert'] }}</li>
            <li class="list-group-item px-0"><strong>Engagement score:</strong> {{ $aiInsights['engagement_score'] }}</li>
        </ul>
    </div>
</div>
@endsection
