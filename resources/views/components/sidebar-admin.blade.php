<div class="fixed flex flex-col top-0 left-0 w-64 bg-gradient-to-b from-indigo-700 to-indigo-900 h-full shadow-xl transition-all duration-300 ease-in-out">
    <div class="flex items-center justify-center h-14 border-b border-indigo-600/50">
        <div class="text-white text-2xl font-bold flex items-center">
            <span>SiCekam</span>
        </div>
    </div>

    <div class="overflow-y-auto overflow-x-hidden flex-grow scrollbar-thin scrollbar-thumb-indigo-400 scrollbar-track-transparent">
        <ul class="flex flex-col py-4 px-3">

            <li class="mt-4 mb-1">
                <div class="h-px bg-indigo-500/30"></div>
            </li>

            <!-- Dashboard -->
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" id="dashboard-link"
                    class="relative flex items-center h-12 px-4 rounded-lg transition-colors duration-200 ease-in-out focus:outline-none hover:bg-white/10 {{ request()->routeIs('admin') ? 'active bg-white/20 border-r-4 border-white' : '' }}">
                    <span class="inline-flex justify-center items-center w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm font-medium tracking-wide text-white">Dashboard</span>
                </a>
            </li>

            <li class="my-1">
                <div class="h-px bg-indigo-500/30"></div>
            </li>

            <!-- Blok Kandang -->
            <li class="menu-item">
                <a href="{{ route('ayam') }}" id="ayam-link"
                    class="relative flex items-center h-12 px-4 rounded-lg transition-colors duration-200 ease-in-out focus:outline-none hover:bg-white/10 {{ request()->routeIs('ayam*') ? 'active bg-white/20 border-r-4 border-white' : '' }}">
                    <span class="inline-flex justify-center items-center w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm font-medium tracking-wide text-white">Blok Kandang</span>
                </a>
            </li>

            <li class="my-1">
                <div class="h-px bg-indigo-500/30"></div>
            </li>

            <!-- Manajemen Pengguna -->
            <li class="menu-item">
                <a href="{{ route('admin.akun') }}" id="akun-link"
                    class="relative flex items-center h-12 px-4 rounded-lg transition-colors duration-200 ease-in-out focus:outline-none hover:bg-white/10 {{ request()->routeIs('akun*') ? 'active bg-white/20 border-r-4 border-white' : '' }}">
                    <span class="inline-flex justify-center items-center w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm font-medium tracking-wide text-white">Manajemen Pengguna</span>
                </a>
            </li>

            <li class="mt-1 mb-2">
                <div class="h-px bg-indigo-400/30"></div>
            </li>
        </ul>
    </div>

    <li class="mt-1 mb-2">
        <div class="h-px bg-indigo-400/30"></div>
    </li>

    <!-- Logout -->
    <div class="px-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-between h-12 px-4 rounded-lg text-white transition-colors duration-200 ease-in-out focus:outline-none hover:bg-white/10">
                <div class="flex items-center">
                    <span class="inline-flex justify-center items-center w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V7.414l-4-4H3zM2 4a2 2 0 012-2h9.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0119 7.414V16a2 2 0 01-2 2H4a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                            <path d="M10 9l-3 3m0 0l3 3m-3-3h8" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm font-medium tracking-wide">Logout</span>
                </div>
                <span class="text-indigo-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;

        function setActiveMenu(linkElement) {
            if (linkElement) {
                document.querySelectorAll('.menu-item a').forEach(item => {
                    item.classList.remove('active', 'bg-white/20', 'border-r-4', 'border-white');
                });

                linkElement.classList.add('active', 'bg-white/20', 'border-r-4', 'border-white');

                linkElement.classList.add('shadow-md');
            }
        }

        if (currentPath.includes('dashboard')) {
            setActiveMenu(document.getElementById('dashboard-link'));
        } else if (currentPath.includes('ayam')) {
            setActiveMenu(document.getElementById('ayam-link'));
        } else if (currentPath.includes('akun')) {
            setActiveMenu(document.getElementById('akun-link'));
        } else {
            setActiveMenu(document.getElementById('dashboard-link'));
        }

        document.querySelectorAll('.menu-item a').forEach(item => {
            item.addEventListener('click', function() {
                setActiveMenu(this);
            });
        });
    });
</script>
