  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('/adminLTE/index3.html')}}" class="brand-link">
      <img src="{{ asset('/adminLTE/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Stuckoverflow</span>
    </a>

    <!-- Sidebar -->
    @if(Auth::user())
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/adminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="nav-icon fa fa-id-card-o"></i>
              <p>
                Score &nbsp;:&nbsp; {{ Auth::user()->reputation }}
              </p>
            </a>
          </li>
          <li class="nav-header">
            <a href="/thread">
              <h5>Forums</h5>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('question.index') }}" class="nav-link">
              Pertanyaan Anda
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('jawab.index') }}" class="nav-link">
              Jawaban Anda
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    @else
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="/login" class="nav-link">
              Login
            </a>
          </li>
        </ul>
      </nav>
    @endif
    <!-- /.sidebar -->
  </aside>