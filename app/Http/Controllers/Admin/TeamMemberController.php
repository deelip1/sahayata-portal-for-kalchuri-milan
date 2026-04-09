<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SahayataTeam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $members = SahayataTeam::query()
            ->search($request->string('q')->toString())
            ->when($request->filled('role'), fn ($q) => $q->where('designation', $request->string('role')->toString()))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => SahayataTeam::count(),
            'active' => SahayataTeam::where('status', 'active')->count(),
            'inactive' => SahayataTeam::where('status', 'inactive')->count(),
            'role_distribution' => SahayataTeam::selectRaw('designation, COUNT(*) as total')->groupBy('designation')->pluck('total', 'designation'),
        ];

        return view('admin.team.index', [
            'members' => $members,
            'stats' => $stats,
            'roles' => config('sahayata.team_roles', []),
        ]);
    }

    public function create()
    {
        return view('admin.team.form', [
            'member' => new SahayataTeam(),
            'roles' => config('sahayata.team_roles', []),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request)
    {
        $payload = $this->validateMember($request);
        $payload['contact_visible'] = $request->boolean('contact_visible');
        if ($request->hasFile('photo')) {
            $payload['photo'] = $request->file('photo')->store('team', 'public');
        }

        $payload['metadata'] = [
            'duplicate_email_mobile_hint' => SahayataTeam::where('email', $payload['email'] ?? null)
                ->orWhere('mobile', $payload['mobile'] ?? null)
                ->exists(),
        ];

        SahayataTeam::create($payload);

        return redirect()->route('admin.team.index')->with('status', 'Team member created successfully.');
    }

    public function edit(int $id)
    {
        $member = SahayataTeam::findOrFail($id);

        return view('admin.team.form', [
            'member' => $member,
            'roles' => config('sahayata.team_roles', []),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $member = SahayataTeam::findOrFail($id);
        $payload = $this->validateMember($request);
        $payload['contact_visible'] = $request->boolean('contact_visible');

        if ($request->hasFile('photo')) {
            $payload['photo'] = $request->file('photo')->store('team', 'public');
        }

        $payload['metadata'] = [
            'duplicate_email_mobile_hint' => SahayataTeam::where('id', '!=', $id)
                ->where(function ($q) use ($payload) {
                    $q->where('email', $payload['email'] ?? null)
                        ->orWhere('mobile', $payload['mobile'] ?? null);
                })
                ->exists(),
        ];

        $member->update($payload);

        return redirect()->route('admin.team.index')->with('status', 'Team member updated successfully.');
    }

    public function destroy(int $id)
    {
        $member = SahayataTeam::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.team.index')->with('status', 'Team member deleted successfully.');
    }

    private function validateMember(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'designation' => ['required', 'string', Rule::in(config('sahayata.team_roles', []))],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'mobile' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:120'],
            'district' => ['required', 'string', 'max:120'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'joining_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'contact_visible' => ['nullable', 'boolean'],
            'metadata' => ['nullable', 'array'],
        ]);
    }
}
