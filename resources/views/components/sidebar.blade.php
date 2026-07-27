{{-- Sidebar Compacta (Desktop) --}}
<aside id="sidebar" class="hidden md:flex fixed top-0 left-0 bottom-0 w-20 bg-slate-900 flex flex-col items-center transition-all duration-500 overflow-hidden z-40">
  <a href="{{ route('dashboard') }}">
    <img id="sidebar-logo" class="w-14 py-3" src="{{ asset('assets/images/logoSideBar.svg') }}" alt="Logo">
  </a>

  <nav class="mt-14 px-6">
    <div class="flex items-center text-white flex-col gap-8">
      <button id="menu-toggle" class="text-blue-500 text-xl hover:scale-125 hover:text-white transition duration-300">
        <i class="fas fa-bars"></i>
      </button>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('dashboard') }}">
        <i class="fas fa-home"></i>
      </a>

      @can('is-teacher')
        <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('disciplines.page') }}">
          <i class="fa-solid fa-chalkboard"></i>
        </a>
      @endcan

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('disciplines.participating') }}">
        <i class="fas fa-book"></i>
      </a>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('ranking.global') }}">
        <i class="fas fa-trophy"></i>
      </a>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('trails.show') }}">
        <i class="fas fa-flag"></i>
      </a>

      <a class="hover:translate-x-1 hover:text-blue-500 transition text-xl" href="{{ route('profile.show') }}">
        <i class="fas fa-cog"></i>
      </a>
    </div>
  </nav>
</aside>

{{-- Sidebar Expandida (Desktop) --}}
<aside id="sidebar-expanded" class="hidden md:flex fixed top-0 left-0 bottom-0 w-48 bg-slate-900 flex flex-col transition-all duration-500 overflow-hidden z-40">
  <img id="sidebar-logo-expanded" class="w-36 py-3 mx-auto" src="{{ asset('assets/images/logoSideBarOpen.svg') }}" alt="Logo Expandido">

  <nav class="mt-14 px-6">
    <div class="flex flex-col text-white gap-8 text-lg">

      <button id="menu-close" class="flex items-center gap-3 text-blue-500 text-xl hover:text-white hover:translate-x-1 transition">
        <i class="fas fa-bars"></i> <span class="font-bold">Menu</span>
      </button>

      <a href="{{ route('dashboard') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-home text-xl"></i> Dashboard
      </a>

      @can('is-teacher')
        <a href="{{ route('disciplines.page') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
          <i class="fa-solid fa-chalkboard text-xl"></i> Gerenciar
        </a>
      @endcan

      <a href="{{ route('disciplines.participating') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-book text-xl"></i> Disciplinas
      </a>

      <a href="{{ route('ranking.global') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-trophy text-xl"></i> Ranking
      </a>

      <a href="{{ route('trails.show') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-flag text-xl"></i> Trilhas
      </a>

      <a href="{{ route('profile.show') }}" class="flex items-center gap-4 hover:scale-105 hover:text-blue-500 transition font-bold">
        <i class="fas fa-cog text-xl"></i> Perfil
      </a>
    </div>
  </nav>
</aside>

{{-- Sidebar Mobile Backdrop (Mobile only) --}}
<div id="sidebar-mobile-backdrop" class="fixed inset-0 bg-black bg-opacity-50 md:hidden hidden z-30"></div>

{{-- Sidebar Mobile (Mobile only) --}}
<nav id="sidebar-mobile-nav" class="fixed top-0 left-0 bottom-0 w-64 bg-slate-900 flex flex-col transition-transform duration-500 -translate-x-full md:hidden z-40">
  <div class="flex justify-between items-center p-4 border-b border-slate-700">
    <img class="w-10" src="{{ asset('assets/images/logoSideBar.svg') }}" alt="Logo">
    <button id="mobile-menu-close" class="text-white text-2xl hover:text-blue-500">
      <i class="fas fa-times"></i>
    </button>
  </div>

  <nav class="mt-6 px-4 flex-1">
    <div class="flex flex-col text-white gap-4 text-lg">
      <a href="{{ route('dashboard') }}" class="flex items-center gap-4 p-3 rounded hover:bg-slate-800 hover:text-blue-500 transition font-bold">
        <i class="fas fa-home text-xl"></i> Dashboard
      </a>

      @can('is-teacher')
        <a href="{{ route('disciplines.page') }}" class="flex items-center gap-4 p-3 rounded hover:bg-slate-800 hover:text-blue-500 transition font-bold">
          <i class="fa-solid fa-chalkboard text-xl"></i> Gerenciar
        </a>
      @endcan

      <a href="{{ route('disciplines.participating') }}" class="flex items-center gap-4 p-3 rounded hover:bg-slate-800 hover:text-blue-500 transition font-bold">
        <i class="fas fa-book text-xl"></i> Disciplinas
      </a>

      <a href="{{ route('ranking.global') }}" class="flex items-center gap-4 p-3 rounded hover:bg-slate-800 hover:text-blue-500 transition font-bold">
        <i class="fas fa-trophy text-xl"></i> Ranking
      </a>

      <a href="{{ route('trails.show') }}" class="flex items-center gap-4 p-3 rounded hover:bg-slate-800 hover:text-blue-500 transition font-bold">
        <i class="fas fa-flag text-xl"></i> Trilhas
      </a>

      <a href="{{ route('profile.show') }}" class="flex items-center gap-4 p-3 rounded hover:bg-slate-800 hover:text-blue-500 transition font-bold">
        <i class="fas fa-cog text-xl"></i> Perfil
      </a>
    </div>
  </nav>
</nav>

{{-- Script para alternar entre os menus --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const menuClose = document.getElementById('menu-close');
    const sidebar = document.getElementById('sidebar');
    const sidebarExpanded = document.getElementById('sidebar-expanded');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const sidebarMobileNav = document.getElementById('sidebar-mobile-nav');
    const sidebarMobileBackdrop = document.getElementById('sidebar-mobile-backdrop');

    // Desktop menu toggle
    if (menuToggle) {
      menuToggle.addEventListener('click', function() {
        sidebar.classList.add('hidden');
        sidebarExpanded.classList.remove('hidden');
      });
    }

    // Desktop menu close
    if (menuClose) {
      menuClose.addEventListener('click', function() {
        sidebarExpanded.classList.add('hidden');
        sidebar.classList.remove('hidden');
      });
    }

    // Mobile menu close
    if (mobileMenuClose) {
      mobileMenuClose.addEventListener('click', function() {
        sidebarMobileNav.classList.add('-translate-x-full');
        sidebarMobileBackdrop.classList.add('hidden');
      });
    }

    // Mobile menu backdrop close
    if (sidebarMobileBackdrop) {
      sidebarMobileBackdrop.addEventListener('click', function() {
        sidebarMobileNav.classList.add('-translate-x-full');
        sidebarMobileBackdrop.classList.add('hidden');
      });
    }
  });
</script>
