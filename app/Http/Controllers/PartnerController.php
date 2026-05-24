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
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name'      => $request->name,
            'logo_url'  => $path,
            'logo_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Partner berhasil ditambahkan!');
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $data['logo_url']  = $path;
            $data['logo_path'] = $path;
        }

        $partner->update($data);
        return redirect()->back()->with('success', 'Partner berhasil diupdate!');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->back()->with('success', 'Partner berhasil dihapus!');
    }
}