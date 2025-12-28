<aside class="w-64 bg-gray-900 text-gray-200 min-h-screen px-3 py-6 hidden md:block">
  <div class="mb-6 text-center">
    <img src="{{ Auth::user()->photo ? asset('uploads/profile/' . Auth::user()->photo) : '/mnt/data/Screenshot_2025-11-24-10-59-36-80.png' }}"
         class="mx-auto h-20 w-20 rounded-full object-cover border-2 border-emerald-400">

    <h4 class="mt-3 font-semibold">{{ Auth::user()->name }}</h4>
    <p class="text-sm text-gray-400">Admin</p>
  </div>

  <nav class="space-y-1">
    <a href="{{ route('barang.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800">
      Dashboard
    </a>

    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800">Profil Admin</a>
  </nav>
</aside>