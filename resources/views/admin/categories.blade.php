@extends('layouts.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Kelola Kategori</h1>
            <p class="text-slate-500 font-medium">Buat dan atur kategori event di sini.</p>
        </div>
        <button onclick="openTambah()"
            class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
            + Tambah Kategori
        </button>
    </header>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        {{-- Search Bar --}}
        <div class="px-8 py-6 bg-slate-50/50 border-b flex gap-4">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-4 w-full">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Cari nama kategori..."
                    class="flex-1 px-5 py-3 rounded-xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                    Cari
                </button>
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-3 bg-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-300 transition">
                    Reset
                </a>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4 w-16">No</th>
                        <th class="px-8 py-4">Nama Kategori</th>
                        <th class="px-8 py-4">Dibuat</th>
                        <th class="px-8 py-4">Diupdate</th>
                        <th class="px-8 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-t">
                    @forelse($categories as $category)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6 font-bold text-slate-400">{{ $loop->iteration }}</td>
                        <td class="px-8 py-6 font-black text-slate-800">{{ $category->name }}</td>
                        <td class="px-8 py-6 text-slate-500">{{ $category->created_at->format('d M Y') }}</td>
                        <td class="px-8 py-6 text-slate-500">{{ $category->updated_at->format('d M Y') }}</td>
                        <td class="px-8 py-6">
                            <div class="flex gap-2">
                                <button onclick="openEdit({{ $category->id }}, '{{ $category->name }}')"
                                    class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                    method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-400">
                            Belum ada kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

{{-- Modal Tambah --}}
<div id="tambahModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-96">
        <h2 class="text-lg font-bold mb-4">Tambah Kategori</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nama Kategori..."
                class="border rounded-xl px-4 py-3 w-full mb-4" required>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeTambah()"
                    class="bg-slate-200 text-slate-600 px-4 py-2 rounded-xl hover:bg-slate-300">
                    Batal
                </button>
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-96">
        <h2 class="text-lg font-bold mb-4">Edit Kategori</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="text" id="editName" name="name"
                class="border rounded-xl px-4 py-3 w-full mb-4" required>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeEdit()"
                    class="bg-slate-200 text-slate-600 px-4 py-2 rounded-xl hover:bg-slate-300">
                    Batal
                </button>
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTambah() {
        document.getElementById('tambahModal').classList.remove('hidden');
        document.getElementById('tambahModal').classList.add('flex');
    }
    function closeTambah() {
        document.getElementById('tambahModal').classList.add('hidden');
        document.getElementById('tambahModal').classList.remove('flex');
    }
    function openEdit(id, name) {
        document.getElementById('editName').value = name;
        document.getElementById('editForm').action = '/admin/categories/' + id;
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }
    function closeEdit() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }
</script>
@endsection