@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
  <div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">Edit Profil Admin</h3>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid grid-cols-1 gap-4">

        <div>
          <label class="block text-sm font-medium">Nama</label>
          <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                 class="mt-1 w-full rounded border-gray-200 shadow-sm" required>
        </div>

        <div>
          <label class="block text-sm font-medium">Email</label>
          <input type="email" value="{{ Auth::user()->email }}" class="mt-1 w-full rounded border-gray-200 shadow-sm" disabled>
        </div>

        <div>
          <label class="block text-sm font-medium">Nomor HP</label>
          <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                 class="mt-1 w-full rounded border-gray-200 shadow-sm">
        </div>

        <div>
          <label class="block text-sm font-medium">Foto Profil</label>
          <div class="mt-2 flex items-center gap-4">
            <img id="preview" src="{{ Auth::user()->photo ? asset('uploads/profile/' . Auth::user()->photo) : '/mnt/data/Screenshot_2025-11-24-10-59-36-80.png' }}"
                 class="h-20 w-20 rounded-full object-cover border">

            <label class="bg-gray-100 px-3 py-2 rounded cursor-pointer">
              Pilih Foto
              <input type="file" name="photo" accept="image/*" class="hidden" onchange="previewImage(event)">
            </label>
          </div>
        </div>

        <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded shadow hover:bg-emerald-600 mt-4">
          Simpan Perubahan
        </button>

      </div>
    </form>
  </div>
</div>

<script>
function previewImage(event) {
  const reader = new FileReader();
  reader.onload = function(){
    document.getElementById('preview').src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection