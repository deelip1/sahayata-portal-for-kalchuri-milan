<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SahayataMember;
use App\Models\SahayataTeam;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'active_cases' => 12,
            'total_contributions' => 184,
            'pending_approvals' => 7,
            'team_members' => SahayataTeam::count(),
            'members' => SahayataMember::count(),
        ];

        $aiInsights = [
            'contribution_trend' => 'Contributions increased 11% over the last 30 days.',
            'risk_alert' => '3 records flagged for duplicate phone and district combinations.',
            'engagement_score' => 'Volunteer engagement score: 78/100 (stable).',
        ];

        return view('admin.dashboard', compact('stats', 'aiInsights'));
    }
}
