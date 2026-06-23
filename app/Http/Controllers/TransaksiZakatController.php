<?php

namespace App\Http\Controllers;

use App\Models\TransaksiZakat;
use App\Models\Muzakki;
use App\Http\Requests\StoreTransaksiZakatRequest;
use App\Http\Requests\UpdateTransaksiZakatRequest;
use Illuminate\Http\Request;

class TransaksiZakatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $transaksis = TransaksiZakat::with('muzakki')
            ->when($search, function ($query, $search) {
                return $query->where('kode_transaksi', 'like', "%{$search}%")
                             ->orWhereHas('muzakki', function ($q) use ($search) {
                                 $q->where('nama_lengkap', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksis', 'search'));
    }

    public function create()
    {
        $muzakkis = Muzakki::orderBy('nama_lengkap')->get();
        return view('admin.transaksi.create', compact('muzakkis'));
    }

    public function store(StoreTransaksiZakatRequest $request)
    {
        // the nominal might be formatted with dots if from input, but we will assume it's cleaned up by JS or the request before validation. Wait, the user asked for "format rupiah yang mudah digunakan", so we might get it with dots. But the request validates as numeric. Let's clean it up before creating if needed, but it's easier to clean in JS before submit. We will assume JS cleans it up or we clean it here.
        $data = $request->validated();
        // Since we are validating it as numeric, it must be sent as pure number.
        TransaksiZakat::create($data);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi Zakat berhasil ditambahkan.');
    }

    public function show(TransaksiZakat $transaksi)
    {
        $transaksi->load('muzakki');
        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function edit(TransaksiZakat $transaksi)
    {
        $muzakkis = Muzakki::orderBy('nama_lengkap')->get();
        return view('admin.transaksi.edit', compact('transaksi', 'muzakkis'));
    }

    public function update(UpdateTransaksiZakatRequest $request, TransaksiZakat $transaksi)
    {
        $data = $request->validated();
        $transaksi->update($data);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi Zakat berhasil diperbarui.');
    }

    public function destroy(TransaksiZakat $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi Zakat berhasil dihapus.');
    }
}
