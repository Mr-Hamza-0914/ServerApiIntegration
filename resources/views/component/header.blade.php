<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="">
                    <img src="{{asset('asset/images/icon/logo.png')}}" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
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
        </div>
    </nav>
</header>