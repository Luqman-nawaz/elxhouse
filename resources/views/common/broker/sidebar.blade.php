 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('common.dashboard_logo')

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('broker.profile') }}" class="nav-link {{ request()->route()->getName()=='broker.profile'?'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Profile
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('broker.customers') }}" class="nav-link {{ request()->route()->getName()=='broker.customers'?'active':'' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customers
                
              </p>
            </a>
            
          <li class="nav-item menu-open">
            <a href="{{ route('broker.conversaction') }}" class="nav-link {{ request()->route()->getName()=='broker.conversaction'?'active':'' }}">
              <i class="nav-icon fas fa-microchip"></i>
              <p>
                Conversactions
                
              </p>
            </a>
            
          </li>
          {{-- <li class="nav-item menu-open">
            <a href="{{ route('broker.profile') }}" class="nav-link {{ request()->route()->getName()=='broker.profile'?'active':'' }}">
              <i class="nav-icon fas fa-microchip"></i>
              <p>
                Profile
                
              </p>
            </a>
            
          </li> --}}
          <li class="nav-item menu-open">
            <a href="{{ route('broker.logout') }}" class="nav-link {{ request()->route()->getName()=='broker.logout'?'active':'' }}">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
                
              </p>
            </a>
            
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>