<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ (strpos(Route::currentRouteName(), 'home') === 0) ? 'active' : '' }}"
          href="{{ route('home')}}">
            <i class="fas fa-home"></i>
            <span>Home</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('event*')) ? 'active' : '' }}" 
            href="{{ route('event.index')}}">
            <i class="fas fa-gift"></i>
            <span>Lottery Event</span>
          </a>
        </li>
        </li>

        <li class="nav-item {{ (request()->is('winner*')) ? 'active' : '' }}">
          <a class="nav-link" href="#">
            <i class="fas fa-user-check"></i>
            <span>Winner</span>
          </a>
        </li>
      </ul>      
    </div>
</nav>