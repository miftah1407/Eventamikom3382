@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manajemen Partner</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Tambah Partner</h2>
        <form action="{{ route('admin.partners.store') }}" method="POST" class="flex gap-3 flex-wrap">
            @csrf
            <input type="text" name="name" placeholder="Nama Partner..."
                class="border rounded-lg px-4 py-2 flex-1" required>
            <input type="text" name="logo_url" placeholder="URL Logo..."
                class="border rounded-lg px-4 py-2 flex-1" required>
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Tambah
            </button>
        </form>
    </div>

    {{-- Form Search --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form action="{{ route('admin.partners.index') }}" method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ $search ?? '' }}"
                placeholder="Cari partner..."
                class="border rounded-lg px-4 py-2 flex-1">
            <button type="submit"
                class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                Cari
            </button>
            <a href="{{ route('admin.partners.index') }}"
                class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">
                Reset
            </a>
        </form>
    </div>

    {{-- Tabel Partner --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Partner</th>
                    <th class="px-6 py-3">Logo</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3">Diupdate</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                <tr class="border-t">
                    <td class="px-6 py-3">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3">{{ $partner->name }}</td>
                    <td class="px-6 py-3">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                            class="h-10 w-auto object-contain">
                    </td>
                    <td class="px-6 py-3">{{ $partner->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-3">{{ $partner->updated_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-3 flex gap-2">
                        <button onclick="openEdit({{ $partner->id }}, '{{ $partner->name }}', '{{ $partner->logo_url }}')"
                            class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                            Edit
                        </button>
                        <form action="{{ route('admin.partners.destroy', $partner->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin hapus partner ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                        Belum ada partner.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Partner</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="text" id="editName" name="name"
                placeholder="Nama Partner"
                class="border rounded-lg px-4 py-2 w-full mb-3" required>
            <input type="text" id="editLogo" name="logo_url"
                placeholder="URL Logo"
                class="border rounded-lg px-4 py-2 w-full mb-4" required>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeEdit()"
                    class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                    Batal
                </button>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEdit(id, name, logo_url) {
        document.getElementById('editName').value = name;
        document.getElementById('editLogo').value = logo_url;
        document.getElementById('editForm').action = '/admin/partners/' + id;
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }
    function closeEdit() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }
</script>
@endsection