<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link mx-auto">
            <span class="app-brand-logo demo">
                <img src="{{ asset('storage/assets/img/logo/logo.svg') }}" alt="triangle with all three sides equal" height="auto" width="130" />
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Sales Record</div>
                {{-- <div data-i18n="Layouts">Layouts</div> --}}
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                <a href="layouts-without-menu.html" class="menu-link">
                    <div data-i18n="Without menu">Without menu</div>
                </a>
                </li>
                <li class="menu-item">
                <a href="layouts-without-navbar.html" class="menu-link">
                    <div data-i18n="Without navbar">Without navbar</div>
                </a>
                </li>
                <li class="menu-item">
                <a href="layouts-container.html" class="menu-link">
                    <div data-i18n="Container">Container</div>
                </a>
                </li>
                <li class="menu-item">
                <a href="layouts-fluid.html" class="menu-link">
                    <div data-i18n="Fluid">Fluid</div>
                </a>
                </li>
                <li class="menu-item">
                <a href="layouts-blank.html" class="menu-link">
                    <div data-i18n="Blank">Blank</div>
                </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Your account</span>
        </li>
        <li class="menu-item {{ (request()->is('admin/account-settings')) || (request()->is('admin/change-password')) ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('admin/account-settings')) ? 'active' : '' }}">
                    <a href="{{ url('admin/account-settings') }}" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('admin/change-password')) ? 'active' : '' }}">
                    <a href="{{ url('admin/change-password') }}" class="menu-link">
                      <div data-i18n="Change Password">Change Password</div>
                    </a>
                </li>
                {{-- <li class="menu-item">
                    <a href="pages-account-settings-connections.html" class="menu-link">
                        <div data-i18n="Connections">Connections</div>
                    </a>
                </li> --}}
            </ul>
        </li>
    </ul>
</aside>
<!-- / Menu -->