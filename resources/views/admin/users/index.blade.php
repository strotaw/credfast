@extends('layouts.panel', ['panel' => 'admin'])

@section('page-title', 'Kelola User')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" class="flex flex-wrap gap-3">
            <input type="text" name="q" value="{{ request('q') }}" class="shell-input" placeholder="Cari nama / email">
            <select name="role" class="shell-select">
                <option value="">Semua role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}" @selected(request('role') === $role)>{{ strtoupper($role) }}</option>
                @endforeach
            </select>
            <button class="btn-secondary">Filter</button>
        </form>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">Tambah User</a>
    </div>

    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Kota</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ strtoupper($item->role) }}</span></td>
                        <td>{{ $item->kota ?? '-' }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('admin.users.show', $item) }}" class="btn-secondary">Lihat</a>
                            <a href="{{ route('admin.users.edit', $item) }}" class="btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $users->links() }}</div>
@endsection
