<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Sistem Cek Kandang Ayam - Registration Page">
  <title>SiCekam</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    .gradient {
      background: linear-gradient(135deg, #713fe5 0%, #4361ee 100%);
      background-attachment: fixed;
    }
    body {
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }
    .input-icon {
      @apply absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/70;
    }
    .input-field {
      @apply w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-[#4361ee]/50 focus:border-[#4361ee]/50 transition;
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen" style="background-image: url('{{ Vite::asset('resources/images/kandang.png') }}')">
  <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" aria-hidden="true"></div>

  <div class="relative z-10 w-full max-w-md mx-4">
    <div class="relative bg-white/10 backdrop-blur-lg rounded-2xl border border-white/20 overflow-hidden shadow-2xl">
      <div class="p-8">
        <header class="flex flex-col items-center mb-8">
          <div class="w-16 h-16 rounded-full gradient flex items-center justify-center mb-4 shadow-lg" aria-hidden="true">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="SiCekam Logo" class="h-12 w-auto" loading="eager" />
          </div>
          <h1 class="text-2xl font-bold text-white">Sign Up</h1>
        </header>

        <form class="space-y-5" action="#" method="POST" autocomplete="on">
          <!-- Name field -->
          <div>
            <label for="nama" class="block text-sm font-medium text-white mb-1">Nama Lengkap</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-white/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
              </div>
              <input id="nama" name="nama" type="nama" required autocomplete="nama" class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-[#4361ee]/50 focus:border-[#4361ee]/50 transition" placeholder="Masukkan Nama" aria-required="true">
            </div>
          </div>

          <!-- Email field -->
          <div>
            <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-white/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
              </div>
              <input id="email" name="email" type="email" required autocomplete="email" class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-[#4361ee]/50 focus:border-[#4361ee]/50 transition" placeholder="Masukkan Email" aria-required="true">
            </div>
          </div>

            <!-- Password field -->
            <div>
                <label for="email" class="block text-sm font-medium text-white mb-1">Password</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-white/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <input id="email" name="email" type="email" required autocomplete="email" class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-[#4361ee]/50 focus:border-[#4361ee]/50 transition" placeholder="Masukkan Password" aria-required="true">
                </div>
              </div>

          <button
            type="submit"
            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#713fe5]/50 transition-all duration-300">
            Daftar Sekarang
          </button>
        </form>

        <footer class="mt-6 text-center text-sm text-white/80">
          Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-white hover:text-white/80 transition hover:underline focus:outline-none focus:underline">Masuk</a>
        </footer>
      </div>
    </div>
  </div>
</body>
</html>
