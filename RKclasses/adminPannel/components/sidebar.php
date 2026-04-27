<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>/public/index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($activePage === 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= BASE_URL ?>/public/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Interface</div>

    <!-- Nav Item - Components Collapse Menu -->
    <li class="nav-item <?= in_array($activePage, ['buttons', 'cards']) ? 'active' : '' ?>">
        <a class="nav-link <?= in_array($activePage, ['buttons', 'cards']) ? '' : 'collapsed' ?>"
            href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="<?= in_array($activePage, ['buttons', 'cards']) ? 'true' : 'false' ?>"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse <?= in_array($activePage, ['buttons', 'cards']) ? 'show' : '' ?>"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item <?= ($activePage === 'buttons') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/buttons.php">Buttons</a>
                <a class="collapse-item <?= ($activePage === 'cards') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/cards.php">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?= in_array($activePage, ['colors', 'borders', 'animations', 'other']) ? 'active' : '' ?>">
        <a class="nav-link <?= in_array($activePage, ['colors', 'borders', 'animations', 'other']) ? '' : 'collapsed' ?>"
            href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="<?= in_array($activePage, ['colors', 'borders', 'animations', 'other']) ? 'true' : 'false' ?>"
            aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse <?= in_array($activePage, ['colors', 'borders', 'animations', 'other']) ? 'show' : '' ?>"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item <?= ($activePage === 'colors') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/utilities-color.php">Colors</a>
                <a class="collapse-item <?= ($activePage === 'borders') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/utilities-border.php">Borders</a>
                <a class="collapse-item <?= ($activePage === 'animations') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/utilities-animation.php">Animations</a>
                <a class="collapse-item <?= ($activePage === 'other') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/utilities-other.php">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Addons</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= in_array($activePage, ['login', 'register', 'forgot-password', '404', 'blank']) ? 'active' : '' ?>">
        <a class="nav-link <?= in_array($activePage, ['login', 'register', 'forgot-password', '404', 'blank']) ? '' : 'collapsed' ?>"
            href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="<?= in_array($activePage, ['login', 'register', 'forgot-password', '404', 'blank']) ? 'true' : 'false' ?>"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse <?= in_array($activePage, ['login', 'register', 'forgot-password', '404', 'blank']) ? 'show' : '' ?>"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item <?= ($activePage === 'login') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/login.php">Login</a>
                <a class="collapse-item <?= ($activePage === 'register') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/register.php">Register</a>
                <a class="collapse-item <?= ($activePage === 'forgot-password') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/forgot-password.php">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item <?= ($activePage === '404') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/404.php">404 Page</a>
                <a class="collapse-item <?= ($activePage === 'blank') ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>/public/blank.php">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= ($activePage === 'charts') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= BASE_URL ?>/public/charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= ($activePage === 'tables') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= BASE_URL ?>/public/tables.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="<?= BASE_URL ?>/img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>
<!-- End of Sidebar -->
