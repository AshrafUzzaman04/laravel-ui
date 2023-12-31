<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("admin.view")}}" class="brand-link">
      <img src="{{asset("backend")}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" loading="lazy" />
      <span class="brand-text font-weight-light">{{__("msg.AdminPanel")}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("backend")}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" loading="lazy">
        </div>
        <div class="info">
          <a href="{{route("admin.view")}}" class="d-block">{{Auth::user()->name_email}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
                <a href="{{route("admin.view")}}" class="nav-link @if (Route::currentRouteName() === "admin.view")
                    active
                @endif">
                    <p>
                        {{__("msg.Dashboard")}}
                    </p>
                  </a>
          </li>
          <li class="nav-item @if (Route::currentRouteName() === "category.index" ||
          Route::currentRouteName() === "category.create")
          menu-open
         @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("category.index")}}" class="nav-link @if (Route::currentRouteName() === "category.index")
                active
                @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("category.create")}}" class="nav-link @if (Route::currentRouteName() === "category.create")
                active
                @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @if (Route::currentRouteName() === "sub-categories.index" ||
           Route::currentRouteName() === "sub-categories.create")
           menu-open
          @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sub Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("sub-categories.index")}}" class="nav-link @if (Route::currentRouteName() === "sub-categories.index")
                active
                @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("sub-categories.create")}}" class="nav-link @if (Route::currentRouteName() === "sub-categories.create")
                active
                @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Sub Category</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @if (Route::currentRouteName() === "post.index" ||
           Route::currentRouteName() === "post.create")
           menu-open
          @endif">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Posts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("post.index")}}" class="nav-link @if (Route::currentRouteName() === "post.index")
                active
                @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("post.create")}}" class="nav-link @if (Route::currentRouteName() === "post.create")
                active
                @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Post</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
