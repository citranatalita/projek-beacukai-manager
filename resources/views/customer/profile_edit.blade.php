@extends('layouts.customer')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Edit Profil</h2>

    <div class="card shadow-sm p-4">

        <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- FOTO PROFIL -->
            <div class="text-center mb-4">

                @if($user->photo)
                    <img src="{{ asset('uploads/profile/' . $user->photo) }}" 
                         class="rounded-circle mb-3"
                         width="120" height="120" style="object-fit:cover;">
                @else
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                         style="width:120px;height:120px;font-size:45px;margin:auto;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div class="mt-2">
                    <label class="btn btn-primary">
                        Unggah Foto
                        <input type="file" name="photo" hidden>
                    </label>
                </div>

            </div>

            <!-- NAMA -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <!-- EMAIL (TIDAK BISA DIUBAH) -->
            <div class="mb-3">
                <label class="form-label">Email (tidak dapat diubah)</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <!-- NOMOR HP -->
            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            </div>

            <button type="submit" class="btn btn-success w-100">💾 Simpan Perubahan</button>

        </form>
    </div>
</div>
@endsection