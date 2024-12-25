  <!-- Topbar Start -->
  <header class="app-header flex items-center px-4 gap-3">
      <!-- Sidenav Menu Toggle Button -->
      <button id="button-toggle-menu" class="nav-link p-2">
          <span class="sr-only">Menu Toggle Button</span>
          <span class="flex items-center justify-center h-6 w-6">
              <i class="mgc_menu_line text-xl"></i>
          </span>
      </button>

      <!-- Topbar Brand Logo -->
      <a href="index.html" class="logo-box">
          <!-- Light Brand Logo -->
          <div class="logo-light">
              <img src="assets/images/logo-light.png" class="logo-lg h-6" alt="Light logo">
              <img src="assets/images/logo-sm.png" class="logo-sm" alt="Small logo">
          </div>

          <!-- Dark Brand Logo -->
          <div class="logo-dark">
              <img src="assets/images/logo-dark.png" class="logo-lg h-6" alt="Dark logo">
              <img src="assets/images/logo-sm.png" class="logo-sm" alt="Small logo">
          </div>
      </a>

      <!-- Topbar Search Modal Button -->
      <button type="button" data-fc-type="modal" data-fc-target="topbar-search-modal" class="nav-link p-2 me-auto">
          <span class="sr-only">Search</span>
          <span class="flex items-center justify-center h-6 w-6">
              <i class="mgc_search_line text-2xl"></i>
          </span>
      </button>

      <!-- Fullscreen Toggle Button -->
      <div class="md:flex hidden">
          <button data-toggle="fullscreen" type="button" class="nav-link p-2">
              <span class="sr-only">Fullscreen Mode</span>
              <span class="flex items-center justify-center h-6 w-6">
                  <i class="mgc_fullscreen_line text-2xl"></i>
              </span>
          </button>
      </div>



      <!-- Light/Dark Toggle Button -->
      <div class="flex">
          <button id="light-dark-mode" type="button" class="nav-link p-2">
              <span class="sr-only">Light/Dark Mode</span>
              <span class="flex items-center justify-center h-6 w-6">
                  <i class="mgc_moon_line text-2xl"></i>
              </span>
          </button>
      </div>

      <!-- Profile Dropdown Button -->
      <div class="relative">
         <livewire:auth.logout>

      </div>
  </header>
  <!-- Topbar End -->