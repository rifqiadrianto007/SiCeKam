<nav x-data="{
    isOpen: false,
    activeSection: 'home',
    sections: ['home', 'fitur'],
    init() {
        if (window.location.hash) {
            this.activeSection = window.location.hash.substring(1);
        } else {
            this.activeSection = 'home';
            window.history.replaceState(null, null, '#home');
        }

        this.setupScrollHandler();
    },
    setupScrollHandler() {
        let ticking = false;

        const checkSections = () => {
            const scrollPosition = window.scrollY + (window.innerHeight / 3);

            this.sections.forEach(section => {
                const el = document.getElementById(section);
                if (el) {
                    const { offsetTop, offsetHeight } = el;
                    if (scrollPosition >= offsetTop && scrollPosition < offsetTop + offsetHeight) {
                        if (this.activeSection !== section) {
                            this.activeSection = section;
                            window.history.replaceState(null, null, `#${section}`);
                        }
                    }
                }
            });

            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(checkSections);
                ticking = true;
            }
        }, { passive: true });
    },
    scrollTo(section) {
        this.activeSection = section;
        const el = document.getElementById(section);
        if (el) {
            window.scrollTo({
                top: el.offsetTop,
                behavior: 'smooth'
            });
            window.history.replaceState(null, null, `#${section}`);
        }
    }
}" class="fixed top-0 left-0 right-0 w-full bg-white bg-opacity-50 backdrop-blur-sm z-50 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center h-12 w-12">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
                </div>
                <span class="font-bold text-2xl">SiCekam</span>
            </div>

            <div class="hidden md:flex space-x-10 items-center font-medium">
                <a href="#home" class="relative group"
                   @click.prevent="scrollTo('home')"
                   :class="{ 'text-indigo-700': activeSection === 'home' }">
                    <span class="hover:text-indigo-700 transition">Home</span>
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-indigo-600 transition-all duration-300"
                          :class="activeSection === 'home' ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <a href="#fitur" class="relative group"
                   @click.prevent="scrollTo('fitur')"
                   :class="{ 'text-indigo-700': activeSection === 'fitur' }">
                    <span class="hover:text-indigo-700 transition">Fitur</span>
                    <span class="absolute -bottom-1 left-0 h-0.5 bg-indigo-600 transition-all duration-300"
                          :class="activeSection === 'fitur' ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>
            </div>

            <div class="hidden md:flex items-center">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="ml-4">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 mt-4 rounded-full font-medium hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-full font-medium hover:bg-indigo-700 transition">
                        Login
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>
