 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png')}}" alt="elxhouse Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">elxHouse</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} ({{ Auth::user()->adminRole->name }})</a>
        </div>
      </div>
  
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               {{-- {{ request()->route()}} --}}
          <li class="nav-item menu-open">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->route()->getName()=='admin.dashboard'?'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.regions') }}" class="nav-link {{ request()->route()->getName()=='admin.regions'?'active':'' }}">
              <i class="nav-icon fas fa-asterisk"></i>
              <p>
                Region
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.customers') }}" class="nav-link {{ request()->route()->getName()=='admin.customers'?'active':'' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customers
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.disabled.customers') }}" class="nav-link {{ request()->route()->getName()=='admin.disabled.customers'?'active':'' }}">
              <i class="nav-icon fas fa-ban"></i>
              <p>
                Disabled Customers
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.brokers') }}" class="nav-link {{ request()->route()->getName()=='admin.brokers'?'active':'' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Brokers
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.broker.conversaction') }}" class="nav-link {{ request()->route()->getName()=='admin.broker.conversaction'?'active':'' }}">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Conversactions
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.customer.applications') }}" class="nav-link {{ request()->route()->getName()=='admin.customer.applications'?'active':'' }}">
              <i class="nav-icon fas fa-microchip"></i>
              <p>
                Applications
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.staff.member') }}" class="nav-link {{ request()->route()->getName()=='admin.staff.member'?'active':'' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Staff Member
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('admin.logout') }}" class="nav-link {{ request()->route()->getName()=='admin.logout'?'active':'' }}">
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