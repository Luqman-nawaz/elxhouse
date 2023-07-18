 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @include('common.dashboard_logo')

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('customer.dashboard') }}" class="nav-link {{ request()->route()->getName()=='customer.dashboard'?'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Views To Broker
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('cusomer.conversaction') }}" class="nav-link {{ request()->route()->getName()=='cusomer.conversaction'?'active':'' }}">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Conversaction
                
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('customer.application') }}" class="nav-link {{ request()->route()->getName()=='customer.application'?'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Application
                
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('customer.profile') }}" class="nav-link {{ request()->route()->getName()=='customer.profile'?'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Edit Profile
                
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="{{ route('customer.logout') }}" class="nav-link {{ request()->route()->getName()=='customer.application'?'active':'' }}">
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