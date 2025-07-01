<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <img src="{{ asset('assets/images/Logo.png') }}" alt="logo" width="120" />
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">web apps</li>

            <li
                class="nav-item {{ active_class(['area/*', 'unit/*', 'region/*', 'users/*', 'vendor/*', 'project/*', 'support/*', 'deviceinterference/*', 'networkinterference/*', 'device-brand/*', 'device_stock/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#masterdata" role="button"
                    aria-expanded="{{ is_active_route(['area/*', 'unit/*', 'region/*', 'users/*', 'vendor/*', 'project/*', 'support/*', 'deviceinterference/*', 'networkinterference/*', 'device-brand/*', 'device_stock/*']) }}"
                    aria-controls="masterdata">
                    <i class="link-icon" data-feather="file"></i>
                    <span class="link-title">Master Data</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['area/*', 'popicon/*', 'unit/*', 'region/*', 'users/*', 'vendor/*', 'project/*', 'support/*', 'deviceinterference/*', 'networkinterference/*', 'device-brand/*', 'device_stock/*']) }}"
                    id="masterdata">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/support') }}" class="nav-link {{ active_class(['support/*']) }}">IT
                                Support</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ url('/area') }}" class="nav-link {{ active_class(['area/*']) }}">Area</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/unit') }}" class="nav-link {{ active_class(['unit/*']) }}">Unit</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="{{ url('/employee') }}"
                                class="nav-link {{ active_class(['employee/*']) }}">Pegawai</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ url('/region') }}"
                                class="nav-link {{ active_class(['region/*']) }}">Unit Pelaksana</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/users') }}" class="nav-link {{ active_class(['users/*']) }}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/vendor') }}"
                                class="nav-link {{ active_class(['vendor/*']) }}">Vendor</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/device-brand') }}"
                                class="nav-link {{ active_class(['device-brand/*']) }}">Merek
                                Perangkat</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/device_stock') }}"
                                class="nav-link {{ active_class(['device_stock/*']) }}">Stok
                                Perangkat</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/networkinterference') }}"
                                class="nav-link {{ active_class(['networkinterference/*']) }}">Kategori Gangguan
                                Jaringan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/deviceinterference') }}"
                                class="nav-link {{ active_class(['deviceinterference/*']) }}">Kategori Gangguan
                                Perangkat</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/vulnerability-level') }}"
                                class="nav-link {{ active_class(['vulnerability-level/*']) }}">Tingkat Kerawanan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/network-contract-icon') }}"
                                class="nav-link {{ active_class(['network-contract-icon/*']) }}">Kontrak Jaringan Icon+</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/popicon') }}"
                                class="nav-link {{ active_class(['popicon/*']) }}">Pop Icon+</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ active_class(['laptops/*', 'computers/*', 'appslocal/*','handphone/*','television/*','mobil-dinas/*','motor-dinas/*','access-point/*','cctv/*','starlink/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#inventory" role="button"
                    aria-expanded="{{ is_active_route(['area/*', 'unit/*', 'region/*', 'users/*', 'vendor/*', 'project/*','handphone/*','television/*','mobil-dinas/*','motor-dinas/*','access-point/*','cctv/*','starlink/*']) }}"
                    aria-controls="masterdata">
                    <i class="link-icon" data-feather="server"></i>
                    <span class="link-title">Inventory</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['laptops/*', 'appslocal/*','handphone/*','television/*','mobil-dinas/*','motor-dinas/*','access-point/*','cctv/*','starlink/*']) }}" id="inventory">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/laptops') }}"
                                class="nav-link {{ active_class(['laptops/*']) }}">Laptop</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/computers') }}"
                                class="nav-link {{ active_class(['computers/*']) }}">Computer</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/servers') }}"
                                class="nav-link {{ active_class(['servers/*']) }}">Server</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/network-devices') }}"
                                class="nav-link {{ active_class(['network-devices/*']) }}">Network Device</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/appslocal') }}"
                                class="nav-link {{ active_class(['appslocal/*']) }}">Aplikasi</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/monitors') }}"
                                class="nav-link {{ active_class(['monitors/*']) }}">Monitor</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/printers') }}"
                                class="nav-link {{ active_class(['printers/*']) }}">Printer / Scanner</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/handphone') }}"
                                class="nav-link {{ active_class(['handphone/*']) }}">HP</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/television') }}"
                                class="nav-link {{ active_class(['television/*']) }}">TV</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/mobil-dinas') }}"
                                class="nav-link {{ active_class(['mobil-dinas/*']) }}">Mobil Dinas</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/motor-dinas') }}"
                                class="nav-link {{ active_class(['motor-dinas/*']) }}">Motor Dinas</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/access-point') }}"
                                class="nav-link {{ active_class(['access-point/*']) }}">WIFI / Access Point</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/cctv') }}"
                                class="nav-link {{ active_class(['cctv/*']) }}">CCTV</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/starlink') }}"
                                class="nav-link {{ active_class(['starlink/*']) }}">Starlink</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/gedung') }}"
                                class="nav-link {{ active_class(['gedung/*']) }}">Gedung UP (SEWA)</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ active_class(['reports/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#report" role="button"
                    aria-expanded="{{ is_active_route(['reports/*']) }}"
                    aria-controls="report">
                    <i class="link-icon" data-feather="file"></i>
                    <span class="link-title">Reports</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['reports/*']) }}" id="report">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/reports') }}"
                                class="nav-link {{ active_class(['reports/*']) }}">Reports</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Version:</h6>
            <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
                <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
            </a>
            <h6 class="text-muted mb-2">Dark Version:</h6>
            <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
                <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
            </a>
        </div>
    </div>
</nav>
