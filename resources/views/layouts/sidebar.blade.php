<aside class="left-sidebar with-vertical">
      <div><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="../main/index.html" class="text-nowrap logo-img">
            <img src="{{ asset('') }}assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
            <img src="{{ asset('') }}assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" />
          </a>
          <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
            <i class="ti ti-x"></i>
          </a>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul id="sidebarnav">
            <!-- ---------------------------------- -->
            <!-- Home -->
            <!-- ---------------------------------- -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Apps</span>
            </li>
            
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->routeIs('travels.*') ? 'active' : '' }}" href="{{ route('travels.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-bus"></i>
                </span>
                <span class="hide-menu">Perjalanan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->routeIs('tickets.*') ? 'active' : '' }}" href="{{ route('tickets.index') }}"  aria-expanded="false">
                <span>
                  <i class="ti ti-ticket"></i>
                </span>
                <span class="hide-menu">Tiket</span>
              </a>
            </li>
          </ul>
        </nav>

        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
      </div>
    </aside>