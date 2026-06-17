<?php

namespace App\Http\Controllers;

use App\Models\Mustahik;
use App\Http\Requests\StoreMustahikRequest;
use App\Http\Requests\UpdateMustahikRequest;
use Illuminate\Http\Request;

class MustahikController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mustahiks = Mustahik::when($search, function ($query, $search) {
                return $query->where('kode_mustahik', 'like', "%{$search}%")
                             ->orWhere('nama_lengkap', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('amil.mustahik.index', compact('mustahiks', 'search'));
    }

    public function create()
    {
        return view('amil.mustahik.create');
    }

    public function store(StoreMustahikRequest $request)
    {
        $data = $request->validated();
        Mustahik::create($data);

        return redirect()->route('amil.mustahik.index')->with('success', 'Data Mustahik berhasil ditambahkan.');
    }

    public function show(Mustahik $mustahik)
    {
        return view('amil.mustahik.show', compact('mustahik'));
    }

    public function edit(Mustahik $mustahik)
    {
        return view('amil.mustahik.edit', compact('mustahik'));
    }

    public function update(UpdateMustahikRequest $request, Mustahik $mustahik)
    {
        $data = $request->validated();
        $mustahik->update($data);

        return redirect()->route('amil.mustahik.index')->with('success', 'Data Mustahik berhasil diperbarui.');
    }

    public function destroy(Mustahik $mustahik)
    {
        $mustahik->delete();
        return redirect()->route('amil.mustahik.index')->with('success', 'Data Mustahik berhasil dihapus.');
    }
}
