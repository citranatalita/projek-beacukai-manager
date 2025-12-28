@extends('layouts.admin')



@section('title', 'Profil Admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
  <div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="p-6 md:flex md:gap-6">

      <div class="md:w-1/3 text-center">
        <img src="{{ Auth::user()->photo ? asset('uploads/profile/' . Auth::user()->photo) : '/mnt/data/Screenshot_2025-11-24-10-59-36-80.png' }}"
             class="mx-auto h-36 w-36 rounded-full object-cover border-4 border-emerald-400">

        <div class="mt-4">
          <a href="{{ route('admin.profile.edit') }}" class="px-4 py-2 bg-emerald-500 text-white rounded shadow hover:bg-emerald-600">
            Edit Profil
          </a>
        </div>
      </div>

      <div class="md:flex-1 mt-4 md:mt-0">
        <h2 class="text-2xl font-semibold">{{ Auth::user()->name }}</h2>
        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="p-4 border rounded">
            <h6 class="text-xs text-gray-400">Nomor HP</h6>
            <p class="mt-1">{{ Auth::user()->phone ?? '-' }}</p>
          </div>

          <div class="p-4 border rounded">
            <h6 class="text-xs text-gray-400">Role</h6>
            <p class="mt-1">Admin</p>
          </div>

          <div class="p-4 border rounded">
            <h6 class="text-xs text-gray-400">Bergabung</h6>
            <p class="mt-1">{{ Auth::user()->created_at->format('d-m-Y') }}</p>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>
@endsection