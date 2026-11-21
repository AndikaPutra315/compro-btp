<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrganizationMember;

class OrganizationController extends Controller
{
    public function index()
    {
        // Fetch all members flat, ordered by urutan then id
        $members = OrganizationMember::with('parent')->orderBy('urutan')->orderBy('id')->get();
        // Roots for tree preview
        $roots = OrganizationMember::whereNull('parent_id')->with('children.children.children')->orderBy('urutan')->get();
        return view('admin.organization.index', compact('members', 'roots'));
    }

    public function create()
    {
        $parents = OrganizationMember::orderBy('urutan')->orderBy('id')->get();
        $nextUrutan = (OrganizationMember::max('urutan') ?? 0) + 1;
        return view('admin.organization.create', compact('parents', 'nextUrutan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan'   => 'required|string|max:255',
            'nama'      => 'required|string|max:255',
            'urutan'    => 'required|integer|min:0',
            'parent_id' => 'nullable|exists:organization_members,id',
        ]);

        OrganizationMember::create($request->only('jabatan', 'nama', 'urutan', 'parent_id'));

        return redirect()->route('admin.organisasi.index')
            ->with('success', 'Anggota struktur organisasi berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        return redirect()->route('admin.organisasi.edit', $id);
    }

    public function edit(string $id)
    {
        $member  = OrganizationMember::findOrFail($id);
        // Exclude self + its descendants from parent options (prevent cycles)
        $exclude = $this->getDescendantIds($member);
        $exclude[] = $member->id;
        $parents = OrganizationMember::whereNotIn('id', $exclude)->orderBy('urutan')->orderBy('id')->get();
        return view('admin.organization.edit', compact('member', 'parents'));
    }

    public function update(Request $request, string $id)
    {
        $member = OrganizationMember::findOrFail($id);

        $request->validate([
            'jabatan'   => 'required|string|max:255',
            'nama'      => 'required|string|max:255',
            'urutan'    => 'required|integer|min:0',
            'parent_id' => 'nullable|exists:organization_members,id',
        ]);

        // Prevent setting parent to itself or a descendant
        if ($request->parent_id) {
            $exclude = $this->getDescendantIds($member);
            $exclude[] = $member->id;
            if (in_array((int) $request->parent_id, $exclude)) {
                return back()->withErrors(['parent_id' => 'Tidak bisa memilih diri sendiri atau turunannya sebagai induk.'])->withInput();
            }
        }

        $member->update($request->only('jabatan', 'nama', 'urutan', 'parent_id'));

        return redirect()->route('admin.organisasi.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $member = OrganizationMember::findOrFail($id);
        // Re-parent children to this member's parent (or null)
        OrganizationMember::where('parent_id', $member->id)->update(['parent_id' => $member->parent_id]);
        $member->delete();

        return redirect()->route('admin.organisasi.index')
            ->with('success', 'Anggota berhasil dihapus. Anak-anaknya dipindahkan ke induknya.');
    }

    /** Recursively collect descendant IDs */
    private function getDescendantIds(OrganizationMember $member): array
    {
        $ids = [];
        foreach ($member->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getDescendantIds($child));
        }
        return $ids;
    }
}
