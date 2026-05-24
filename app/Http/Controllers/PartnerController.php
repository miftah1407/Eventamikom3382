<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $partners = Partner::when($search, function($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orderBy('id')->get();

        return view('admin.partners', compact('partners', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'required|string|max:255',
        ]);
        Partner::create($request->only('name', 'logo_url'));
        return redirect()->back()->with('success', 'Partner berhasil ditambahkan!');
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'required|string|max:255',
        ]);
        $partner->update($request->only('name', 'logo_url'));
        return redirect()->back()->with('success', 'Partner berhasil diupdate!');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->back()->with('success', 'Partner berhasil dihapus!');
    }
}