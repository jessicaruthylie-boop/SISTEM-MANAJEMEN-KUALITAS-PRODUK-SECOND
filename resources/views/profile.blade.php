<x-app-layout>
    <x-slot name="header">
        <h2>Profil</h2>
    </x-slot>

    <div class="py-12">
        <p>Nama: {{ auth()->user()->name }}</p>
        <p>Email: {{ auth()->user()->email }}</p>
        <form method="POST" action="{{ route('profile.add') }}">
            @csrf
            <button type="submit">Tambah Akun</button>
        </form>
        <form method="POST" action="{{ route('profile.delete') }}">
            @csrf
            <button type="submit">Hapus Akun</button>
        </form>
    </div>
</x-app-layout>