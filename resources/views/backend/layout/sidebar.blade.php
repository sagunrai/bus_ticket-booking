<div class="nav-left-sidebar sidebar-light">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('admin')}}"><i class="fa fa-fw fa-user-circle"></i>{{ Auth::user()->name }}</a>
                    </li>

                    <li class="nav-divider">
                        Bus Management
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'category') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">
                            <i class="far fa-flag"></i>Cities
                        </a>
                        <div id="submenu-3" class="collapse submenu {{ (request()->segment(2) == 'category') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'category') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/category">  Cities </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'subcategory') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-101" aria-controls="submenu-101">
                            <i class="far fa-flag"></i>Route management
                        </a>
                        <div id="submenu-101" class="collapse submenu {{ (request()->segment(2) == 'subcategory') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'subcategory') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/subcategory">  View routes </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'subcategory') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/subcategory/add"> Add route</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'bustype') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1011" aria-controls="submenu-1011">
                            <i class="far fa-flag"></i>Bus Type
                        </a>
                        <div id="submenu-1011" class="collapse submenu {{ (request()->segment(2) == 'bustype') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'bustype') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/bustype">  All BusType </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'bustype') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/bustype/add"> Add BusType</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'bus') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-102" aria-controls="submenu-102">
                            <i class="fas fa-bus"></i>All Bus
                        </a>
                        <div id="submenu-102" class="collapse submenu {{ (request()->segment(2) == 'bus') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'bus') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/bus">  View </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'bus') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/bus/add"> Add Bus</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('admin.bus.active')}}"><i class="fas fa-bus"></i>Active Bus</a>
                    </li>

                    <li class="nav-divider">
                        Customer Support
                    </li>


                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'passanger') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false" data-target="#submenu-71" aria-controls="submenu-71">
                            <i class="fas fa-user"></i> Bookings & Cancellation </a>
                        <div id="submenu-71" class="collapse submenu {{ (request()->segment(2) == 'passanger') ? 'show' : '' }}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'users') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ route('user.showpassangers.index') }}"> Bookings </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'users') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ route('user.showpassangers.cancelled') }}"> Cancellation </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('admin.digital.chalani')}}"><i class="fa fa-fw fa-user"></i>Digital Chalani</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('admin.digital.payment')}}"> <i class="fas fa-dollar-sign    "></i> Payment Management</a>
                    </li>

                    <li class="nav-divider">
                        General
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'bookings') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1220" aria-controls="submenu-1220">
                            <i class="far fa-flag"></i>eastbus Bookings
                        </a>
                        <div id="submenu-1220" class="collapse submenu {{ (request()->segment(2) == 'bookings') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'bookings') && (request()->segment(3) == null)) ? 'active' : '' }}" href="/admin/bookings">  Bookings </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->segment(2) == 'gallery') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4">
                            <i class="fas fa-images"></i>Gallery
                        </a>
                        <div id="submenu-4" class="collapse submenu {{ (request()->segment(2) == 'gallery') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'gallery') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/gallery') }}"> All Image </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'gallery') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/gallery/add') }}"> Add Image </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('admin.review.index')}}"><i class="fa fa-fw fa-user-circle"></i>Reviews</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('admin.offers')}}"><i class="fa fa-fw fa-user-circle"></i>Offers Management</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ route('admin.feedback.index')}}"><i class="fa fa-fw fa-user-circle"></i>Feedbacks</a>
                    </li>
                    @if(checkPermission(['Superadmin','Admin']))
                    {{--  <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'feedback') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-88" aria-controls="submenu-17">
                            <i class="far fa-clone"></i>Pages</a>
                        <div id="submenu-88" class="collapse submenu {{ (request()->segment(2) == 'feedback') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'feedback') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/aboutus') }}"> Aboutus </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'feedback') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/contactus') }}"> Contactus </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'feedback') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/privacypolicy') }}"> PrivacyPolicy </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'feedback') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/termsandconditions') }}"> Termsandconditions </a>
                                </li>
                            </ul>
                        </div>
                    </li>  --}}
                    <li class="nav-divider">
                        Users
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'users') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7">
                            <i class="fas fa-user"></i> Manage Users </a>
                        <div id="submenu-7" class="collapse submenu {{ (request()->segment(2) == 'users') ? 'show' : '' }}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'users') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/users') }}"> Users </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ (request()->segment(2) == 'setting') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11">
                            <i class="fas fa-cogs"></i> Setting </a>
                        <div id="submenu-11" class="collapse submenu {{ (request()->segment(2) == 'setting') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ ((request()->segment(2) == 'setting') && (request()->segment(3) == null)) ? 'active' : '' }}" href="{{ url('/admin/setting') }}"> Manage Site.all info. </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    @endif
                    {{--  <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('logout') }}" style="color:black;padding: 12px;background-color: white;text-align: left;"><i class="fas fa-power-off mr-2"></i>{{ __('Logout') }}</a>
                    </li>  --}}
                    <li class="nav-item" style="height: 70px">
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
