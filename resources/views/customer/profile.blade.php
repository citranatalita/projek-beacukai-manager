@extends('layouts.customer')

@section('content')

<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow border-0 rounded-4 p-4" style="background:#ffe6ea; width: 450px;">    

    <h3 class="text-center fw-bold mb-4">👤 Profil Saya</h3>

    <div class="card shadow border-0 rounded-4" style="background:#ffe6ea;">
        <div class="card-body p-4">

        <div class="text-center mb-3">

            @if ($user->photo)
                <img src="{{ asset('uploads/profile/' . $user->photo) }}"
                    class="rounded-circle"
                    style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <div class="rounded-circle bg-danger text-white fw-bold d-flex justify-content-center align-items-center"
                    style="width: 100px; height: 100px; margin:auto; font-size: 32px;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif
            </div>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Nama Lengkap</label>
                <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Email</label>
                <input type="text" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Nomor HP</label>
                <input type="text" class="form-control" value="{{ $user->phone }}" disabled>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Tanggal Bergabung</label>
                <input type="text" class="form-control" value="{{ $user->created_at->format('d-m-Y') }}" disabled>
            </div>

            <div class="text-center mt-3">
            <a href="{{ route('customer.profile.edit') }}" class="btn btn-primary">
                Edit Profil
            </a>
            </div>

        </div>
    </div>
</div>

@endsection