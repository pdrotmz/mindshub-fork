<header class="bg-white border-b shadow-sm p-2 md:p-4 flex justify-between items-center gap-4">

  <!-- Menu Mobile Button -->
  <button id="mobile-menu-btn" class="md:hidden text-slate-900 text-2xl hover:text-blue-600 transition">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Formulário de busca -->
  <form action="{{ route('dashboard') }}" method="GET" class="flex items-center gap-2 flex-1 md:flex-none">
    <input 
      type="text" 
      name="search" 
      value="{{ request('search') }}" 
      placeholder="Buscar"
      class="border border-gray-300 rounded px-3 py-1 w-full sm:w-64 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
    >
    <button 
      type="submit"
      class="bg-blue-600 text-white px-2 md:px-3 py-1 rounded hover:bg-blue-700 transition text-sm"
    >
      <i class="fas fa-search hidden sm:inline"></i>
      <span class="sm:hidden">OK</span>
    </button>
  </form>

  <!-- Lado direito: perfil, nome, ícones -->
  <div class="flex items-center gap-2 md:gap-6">

    <!-- Nome e papel do usuário -->
    <div class="text-xs md:text-sm font-medium text-gray-700 hidden md:block whitespace-nowrap">
      @auth
        @if (Auth::user()->role === 'student')
          Aluno: {{ Auth::user()->name }}
        @else
          Professor: {{ Auth::user()->name }}
        @endif
      @else
        Você não está logado
      @endauth
    </div>

    <!-- Foto de perfil -->
    @auth
      <div class="w-8 md:w-10 h-8 md:h-10">
        @if (Auth::user()->profile_photo)
          <img 
            src="{{ asset(Auth::user()->profile_photo) }}" 
            alt="Foto de perfil"
            class="w-full h-full rounded-full object-cover border border-gray-300 shadow"
          >
        @else
          <img 
            src="{{ asset('assets/profile_photos/default.png') }}" 
            alt="Imagem padrão" 
            class="w-full h-full rounded-full object-cover border border-gray-300 shadow"
          >
        @endif
      </div>
    @endauth

    <!-- Ícones de ação -->
    <div class="flex items-center gap-2 md:gap-4 text-blue-600 text-lg md:text-xl">

      <!-- Notificação -->
    <div class="relative" x-data="{ open: false }">
        <a href="#" @click.prevent="open = !open" class="relative">
            <i class="fas fa-bell"></i>
            @if(Auth::check() && $unreadNotifications->count() > 0)
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-4 h-4 md:w-5 md:h-5 flex items-center justify-center animate-pulse text-xs md:text-xs">
                    {{ $unreadNotifications->count() }}
                </span>
            @endif
        </a>

        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-72 md:w-80 bg-white rounded shadow-lg p-4 z-50 max-h-96 overflow-y-auto">
            <h4 class="text-base md:text-lg font-bold mb-2">Notificações</h4>
            <form action="{{ route('notifications.markAllRead') }}" method="POST" class="text-right mb-2">
                  @csrf
                  <button type="submit" class="text-xs md:text-sm text-blue-600 hover:underline">
                      Marcar todas como lidas
                  </button>
            </form>
            @forelse($unreadNotifications as $notification)
                  <div class="mb-2 border-b pb-3 flex items-start gap-3">
                      {{-- Ícone da medalha --}}
                      <div class="w-12 md:w-16 h-12 md:h-16 flex items-center justify-center flex-shrink-0">
                          <img src="{{ asset($notification->data['icon']) }}" alt="Medal Icon" class="w-10 md:w-14 h-10 md:h-14 object-contain">
                      </div>
                      {{-- Conteúdo da notificação --}}
                      <div class="flex-1 min-w-0">
                        <a href="{{ route('notifications.read', $notification->id) }}" class="block hover:bg-gray-50 p-2 rounded transition">
                            <p class="text-xs md:text-sm font-semibold text-gray-800">
                                Medalha conquistada: <span class="text-blue-600">{{ $notification->data['name'] }}</span>
                            </p>
                            <p class="text-xs md:text-sm text-gray-600">
                                {{ $notification->data['description'] }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                Recebida em {{ $notification->created_at->format('d/m/Y H:i') }}
                            </p>
                          </a>
                      </div>
                  </div>
              @empty
                  <p class="text-gray-500 text-xs md:text-sm">Sem notificações novas.</p>
              @endforelse
        </div>
    </div>


      <!-- Logout -->
      <a 
        href="#" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="hover:text-red-600 transition transform hover:translate-x-0.5"
      >
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
      </a>

      <!-- Formulário de logout -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
      </form>
    </div>

  </div>
</header>

<script>
  // Mobile menu button handler
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const sidebarMobileNav = document.getElementById('sidebar-mobile-nav');
  const sidebarMobileBackdrop = document.getElementById('sidebar-mobile-backdrop');

  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', function() {
      sidebarMobileNav.classList.remove('-translate-x-full');
      sidebarMobileBackdrop.classList.remove('hidden');
    });
  }
</script>
