<?php

namespace App\Http\Controllers;

use App\Models\Muzakki;
use App\Http\Requests\StoreMuzakkiRequest;
use App\Http\Requests\UpdateMuzakkiRequest;
use Illuminate\Http\Request;

class MuzakkiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $muzakkis = Muzakki::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', "%{$search}%")
                         ->orWhere('kode_muzakki', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('admin.muzakki.index', compact('muzakkis', 'search'));
    }

    public function create()
    {
        return view('admin.muzakki.create');
    }

    public function store(StoreMuzakkiRequest $request)
    {
        Muzakki::create($request->validated());
        return redirect()->route('admin.muzakki.index')->with('success', 'Data Muzakki berhasil ditambahkan.');
    }

    public function show(Muzakki $muzakki)
    {
        return view('admin.muzakki.show', compact('muzakki'));
    }

    public function edit(Muzakki $muzakki)
    {
        return view('admin.muzakki.edit', compact('muzakki'));
    }

    public function update(UpdateMuzakkiRequest $request, Muzakki $muzakki)
    {
        $muzakki->update($request->validated());
        return redirect()->route('admin.muzakki.index')->with('success', 'Data Muzakki berhasil diperbarui.');
    }

    public function destroy(Muzakki $muzakki)
    {
        $muzakki->delete();
        return redirect()->route('admin.muzakki.index')->with('success', 'Data Muzakki berhasil dihapus.');
    }
}
