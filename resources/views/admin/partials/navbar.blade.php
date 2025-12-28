<nav class="w-full bg-gray-800 text-white shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <a href="{{ route('barang.index') }}" class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
          </svg>
          <span class="font-semibold text-lg">Admin Panel</span>
        </a>
      </div>

      <div class="flex items-center space-x-4">
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
            <img src="{{ Auth::user()->photo ? asset('uploads/profile/' . Auth::user()->photo) : '/mnt/data/Screenshot_2025-11-24-10-59-36-80.png' }}" 
                 class="h-9 w-9 rounded-full object-cover border-2 border-gray-600">

            <span class="hidden sm:inline-block font-medium">{{ Auth::user()->name }}</span>

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div x-show="open" @click.away="open = false"
               class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg overflow-hidden z-50">
            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil Admin</a>

            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Logout</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</nav>