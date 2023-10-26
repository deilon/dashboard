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
        <li class="menu-item {{ (request()->is('member/dashboard')) ? 'active' : '' }}">
            <a href="{{ url('member/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-run"></i>
                <div data-i18n="Layouts">Fitness Progress</div>
                {{-- <div data-i18n="Layouts">Layouts</div> --}}
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                        <div data-i18n="Without menu">Today</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                        <div data-i18n="Without navbar">Completed</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-container.html" class="menu-link">
                        <div data-i18n="Container">Queues</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-container.html" class="menu-link">
                        <div data-i18n="Container">All</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Your account</span>
        </li>
        <li class="menu-item {{ (request()->is('member/account-settings')) || (request()->is('member/change-password')) ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('member/account-settings')) ? 'active' : '' }}">
                    <a href="{{ url('member/account-settings') }}" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('member/change-password')) ? 'active' : '' }}">
                    <a href="{{ url('member/change-password') }}" class="menu-link">
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

        {{-- Membership --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Membership</span>
        </li>
        <li class="menu-item">
            <a href="{{ url('member/membership-details') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-id-card"></i>
                <div data-i18n="Membership details">Membership Details</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('member/available-packages')) ? 'active' : '' }}">
            <a href="{{ url('member/available-packages') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Available Packages">Available Packages</div>
            </a>
        </li>

        {{-- Actions --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Actions</span>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Payment history">Payment History</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Fitness progress history">Fitness Progress History</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Logs">Logs</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->