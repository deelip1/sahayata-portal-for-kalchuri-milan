<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SahayataMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = SahayataMember::query()
            ->search($request->string('q')->toString())
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')->toString()))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.members.index', [
            'members' => $members,
            'statuses' => config('sahayata.member_statuses', ['active', 'inactive', 'blocked']),
        ]);
    }

    public function create()
    {
        return view('admin.members.form', [
            'member' => new SahayataMember(),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request)
    {
        SahayataMember::create($this->validateMember($request));

        return redirect()->route('admin.members.index')->with('status', 'Member created successfully.');
    }

    public function edit(int $id)
    {
        return view('admin.members.form', [
            'member' => SahayataMember::findOrFail($id),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $member = SahayataMember::findOrFail($id);
        $member->update($this->validateMember($request));

        return redirect()->route('admin.members.index')->with('status', 'Member updated successfully.');
    }

    public function destroy(int $id)
    {
        SahayataMember::findOrFail($id)->delete();

        return redirect()->route('admin.members.index')->with('status', 'Member removed successfully.');
    }

    private function validateMember(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'mobile' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:120'],
            'district' => ['required', 'string', 'max:120'],
            'occupation' => ['nullable', 'string', 'max:120'],
            'status' => ['required', Rule::in(config('sahayata.member_statuses', ['active', 'inactive', 'blocked']))],
            'joined_at' => ['nullable', 'date'],
            'metadata' => ['nullable', 'array'],
        ]);
    }
}
