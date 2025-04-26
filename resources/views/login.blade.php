<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Sistem Cek Kandang Ayam - Login Page">
  <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
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
  </style>
</head>

<body class="flex items-center justify-center min-h-screen" style="background-image: url('{{ Vite::asset('resources/images/kandang.png') }}')">
  <!-- Background overlay with improved accessibility -->
  <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" aria-hidden="true"></div>

  <!-- Login Card -->
  <div class="relative z-10 w-full max-w-md mx-4">
    <div class="relative bg-white/10 backdrop-blur-lg rounded-2xl border border-white/20 overflow-hidden shadow-2xl">
      <!-- Card content -->
      <div class="p-8">
        <!-- Logo/Header with better semantic structure -->
        <header class="flex flex-col items-center mb-8">
          <div class="w-16 h-16 rounded-full gradient flex items-center justify-center mb-4 shadow-lg" aria-hidden="true">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="SiCekam Logo" class="h-12 w-auto" loading="eager" />
          </div>
          <h1 class="text-2xl font-bold text-white">Sign In</h1>
        </header>

        <!-- Form with proper attributes -->
        <form class="space-y-5" action="#" method="POST" autocomplete="on">
          <!-- Email field with better accessibility -->
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

          <div>
            <label for="password" class="block text-sm font-medium text-white mb-1">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-white/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
              </div>
              <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full pl-10 pr-11 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-[#4361ee]/50 focus:border-[#4361ee]/50 transition" placeholder="Password" aria-required="true">
              <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" aria-label="Toggle password visibility">
                <svg class="h-5 w-5 text-white/50 hover:text-white transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>
          </div>

          <button
          type="submit"
          class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white gradient hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#713fe5]/50 transition-all duration-300"
          onclick="window.location.href='{{ route('main') }}'">
          Sign In
          </button>
        </form>

        <footer class="mt-6 text-center text-sm text-white/80">
          Belum punya akun? <a href="{{ ("register") }}" class="font-medium text-white hover:text-white/80 transition hover:underline focus:outline-none focus:underline">Registrasi</a>
        </footer>
      </div>
    </div>
  </div>
</body>
</html>
