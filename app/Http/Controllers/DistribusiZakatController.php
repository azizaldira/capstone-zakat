<?php

namespace App\Http\Controllers;

use App\Models\DistribusiZakat;
use App\Models\Mustahik;
use App\Http\Requests\StoreDistribusiZakatRequest;
use App\Http\Requests\UpdateDistribusiZakatRequest;
use Illuminate\Http\Request;

class DistribusiZakatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $distribusis = DistribusiZakat::with('mustahik')
            ->when($search, function ($query, $search) {
                return $query->where('kode_distribusi', 'like', "%{$search}%")
                             ->orWhereHas('mustahik', function ($q) use ($search) {
                                 $q->where('nama_lengkap', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->paginate(10);

        return view('amil.distribusi.index', compact('distribusis', 'search'));
    }

    public function create()
    {
        $mustahiks = Mustahik::where('status_aktif', 'Aktif')->orderBy('nama_lengkap')->get();
        return view('amil.distribusi.create', compact('mustahiks'));
    }

    public function store(StoreDistribusiZakatRequest $request)
    {
        $data = $request->validated();
        DistribusiZakat::create($data);

        return redirect()->route('amil.distribusi.index')->with('success', 'Data Distribusi Zakat berhasil ditambahkan.');
    }

    public function show(DistribusiZakat $distribusi)
    {
        $distribusi->load('mustahik');
        return view('amil.distribusi.show', compact('distribusi'));
    }

    public function edit(DistribusiZakat $distribusi)
    {
        $mustahiks = Mustahik::orderBy('nama_lengkap')->get();
        return view('amil.distribusi.edit', compact('distribusi', 'mustahiks'));
    }

    public function update(UpdateDistribusiZakatRequest $request, DistribusiZakat $distribusi)
    {
        $data = $request->validated();
        $distribusi->update($data);

        return redirect()->route('amil.distribusi.index')->with('success', 'Data Distribusi Zakat berhasil diperbarui.');
    }

    public function destroy(DistribusiZakat $distribusi)
    {
        $distribusi->delete();
        return redirect()->route('amil.distribusi.index')->with('success', 'Data Distribusi Zakat berhasil dihapus.');
    }
}
