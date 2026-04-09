<?php

namespace App\Http\Controllers;

use App\Models\SahayataTeam;
use Illuminate\Http\Request;

class TeamDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('q')->toString();
        $role = $request->string('role')->toString();

        $baseQuery = SahayataTeam::query()
            ->active()
            ->search($search)
            ->when($role, fn ($q) => $q->where('designation', $role));

        $leadership = (clone $baseQuery)
            ->whereIn('designation', ['Patron', 'President', 'Vice President', 'Secretary', 'Treasurer', 'IT Head'])
            ->orderBy('designation')
            ->orderBy('name')
            ->get();

        $districtTeam = (clone $baseQuery)
            ->where('designation', 'District Coordinator')
            ->orderBy('district')
            ->orderBy('name')
            ->get();

        $volunteers = (clone $baseQuery)
            ->where('designation', 'Volunteer')
            ->orderBy('district')
            ->orderBy('name')
            ->get();

        return view('team.index', [
            'leadership' => $leadership,
            'districtTeam' => $districtTeam,
            'volunteers' => $volunteers,
            'roles' => config('sahayata.team_roles', []),
            'search' => $search,
            'selectedRole' => $role,
        ]);
    }
}
