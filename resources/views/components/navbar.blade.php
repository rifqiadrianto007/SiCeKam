<nav x-data="{ isOpen: false, activeSection: 'home' }" class="fixed w-full bg-white bg-opacity-50 backdrop-blur-sm z-50 shadow"
    x-init="() => {
        activeSection = window.location.hash ? window.location.hash.substring(1) : 'home';

        window.addEventListener('scroll', () => {
            const sections = ['home', 'fitur'];
            const current = sections.find(section => {
                const el = document.getElementById(section);
                if (el) {
                    const rect = el.getBoundingClientRect();
                    return rect.top <= 100 && rect.bottom >= 100;
                }
                return false;
            }) || 'home';

            activeSection = current;
        });
    }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center h-12 w-12">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
                </div>
                <span class="font-bold text-2xl">SiCekam</span>
            </div>

            <div class="hidden md:flex space-x-10 items-center font-medium">
                <a href="#home" class="relative group" @click="activeSection = 'home'"
                    :class="{ 'text-indigo-700': activeSection === 'home' }">
                    <span class="hover:text-indigo-700 transition">Home</span>
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-indigo-600 transition-all"
                        :class="activeSection === 'home' ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <a href="#fitur" class="relative group" @click="activeSection = 'fitur'"
                    :class="{ 'text-indigo-700': activeSection === 'fitur' }">
                    <span class="hover:text-indigo-700 transition">Fitur</span>
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-indigo-600 transition-all"
                        :class="activeSection === 'fitur' ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 text-white px-3 py-1 rounded-lg font-medium hover:opacity-90 transition">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="bg-indigo-600 text-white px-3 py-1 rounded-lg font-medium hover:opacity-90 transition">
                        Login
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>
