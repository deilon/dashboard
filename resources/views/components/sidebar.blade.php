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
        {{-- <li class="menu-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li> --}}

        <!-- Sales Revenue Report -->
        <li class="menu-item {{ (request()->is('admin/sales/month')) || (request()->is('admin/sales/all')) ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Sales Revenue Report">Sales Revenue Report</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('admin/sales/month')) ? 'active' : '' }}">
                    <a href="{{ url('admin/sales/month') }}" class="menu-link">
                        <div data-i18n="Current Month">Current Month</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('admin/sales/today')) ? 'active' : '' }}">
                    <a href="{{ url('admin/sales/today') }}" class="menu-link">
                        <div data-i18n="Today">Today</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('admin/sales/all')) ? 'active' : '' }}">
                    <a href="{{ url('admin/sales/all') }}" class="menu-link">
                      <div data-i18n="All">All</div>
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


        {{-- Users Records --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Users records</span>
        </li>
        <li class="menu-item {{ (request()->is('admin/records/admin')) ? 'active' : '' }}">
            <a href="{{ url('admin/records/admin') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Admins">Admins</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('admin/users/staff')) ? 'active' : '' }}">
            <a href="{{ url('admin/users/staff') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Staff">Staff</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('admin/users-records/member')) ? 'active' : '' }}">
            <a href="{{ url('admin/users-records/member') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Members">Registered Users</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('admin/subscribers')) ? 'active' : '' }}">
            <a href="{{ url('admin/subscribers') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Registered">Gym Subscribers</div>
            </a>
        </li>


        {{-- Actions --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Actions</span>
        </li>
        <li class="menu-item {{ (request()->is('admin/subscription-arrangements')) ? 'active' : '' }}">
            <a href="{{ url('admin/subscription-arrangements') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Subscription settings">Subscription Arrangements</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('admin/announcements-promotions')) ? 'active' : '' }}">
            <a href="{{ url('admin/announcements-promotions') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-megaphone"></i>
                <div data-i18n="Announcements and Promotions">Announcements and Promotions</div>
            </a>
        </li>
        {{-- <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Logs">Logs</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Archives">Archives</div>
            </a>
        </li> --}}
    </ul>
</aside>
<!-- / Menu -->