@extends('layouts.panel', ['panel' => 'marketing'])

@section('page-title', 'User Potensial')

@section('content')
    <div class="shell-card overflow-hidden">
        <table class="table-shell">
            <thead class="bg-slate-50">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Total Pengajuan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp ?? '-' }}</td>
                        <td>{{ $item->pengajuan_kredit_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $users->links() }}</div>
@endsection
