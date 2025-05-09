<div class="fixed flex flex-col top-0 left-0 w-64 bg-indigo-500 h-full shadow-lg sidebar">
    <div class="flex items-center justify-center h-14 border-b border-indigo-300">
        <div class="text-white text-xl font-bold">SiCekam</div>
    </div>
    <div class="overflow-y-auto overflow-x-hidden flex-grow">
        <ul class="flex flex-col space-y-1 py-4">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('admin') ? 'active-nav border-blue-500 bg-indigo-400' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate text-white">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('ayam') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('ayam*') ? 'active-nav border-blue-500 bg-indigo-400' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-warehouse"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate text-white">
                        Blok Kandang
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.akun') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6 {{ request()->routeIs('akun*') ? 'active-nav border-blue-500 bg-indigo-400' : '' }}">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-users-cog"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate text-white">
                        Manajemen Pengguna
                    </span>
                </a>
            </li>
            <li class="mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left relative flex flex-row items-center h-11 focus:outline-none hover:bg-indigo-400 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate text-white">
                            Keluar
                        </span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
