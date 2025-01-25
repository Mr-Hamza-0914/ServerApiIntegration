<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{url('/dashboard')}}">
            <img src="{{asset('asset/images/icon/logo.png')}}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">

                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{url('/dashboard')}}">
                        <i class="fas fa-home"></i>Home</a>
                </li>
                
                <li class="{{ request()->is('servers') ? 'active' : '' }}">
                    <a href="{{url('servers')}}">
                        <i class="fas fa-server"></i>
                        Servers
                    </a>
                </li>
                
                <li class="{{ request()->is('server/template') ? 'active' : '' }}">
                    <a href="{{url('server/template')}}">
                        <i class="fas fa-server"></i>
                        Server Template
                    </a>
                </li>
                
                <li class="{{ request()->is('server/os') ? 'active' : '' }}">
                    <a href="{{url('server/os')}}">
                        <i class="fas fa-server"></i>
                        Operating System
                    </a>
                </li>
                
                <li class="{{ request()->is('regions') ? 'active' : '' }}">
                    <a href="{{url('regions')}}">
                        <i class="fas fa-server"></i>
                        Regions
                    </a>
                </li>
                
                <li class="{{ request()->is('credit') ? 'active' : '' }}">
                    <a href="{{url('credit')}}">
                        <i class="fas fa-bank"></i>
                        Credit & Upcoming
                    </a>
                </li>
                
            </ul>
        </nav>
    </div>
</aside>