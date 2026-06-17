@extends('layouts.app')

@section('header', 'Detail Pengguna')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Akun Pengguna</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width: 150px;" class="text-muted">Nama Lengkap</th>
                            <td>: <span class="fw-bold">{{ $user->name }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Email</th>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Role Akses</th>
                            <td>: 
                                <span class="badge bg-{{ $user->role === 'admin_panitia' ? 'primary' : 'info text-dark' }}">
                                    {{ $user->role === 'admin_panitia' ? 'Admin Panitia' : 'Amil' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tanggal Dibuat</th>
                            <td>: {{ $user->created_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Terakhir Diperbarui</th>
                            <td>: {{ $user->updated_at->format('d F Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
