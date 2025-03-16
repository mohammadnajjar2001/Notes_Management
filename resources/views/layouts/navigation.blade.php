<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar Example</title>
    <!-- استدعاء Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* أسس عامة */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f9fafb;
}

/* شريط التنقل */
.navbar {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
}

.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 64px;
}

/* الشعار */
.logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: #111827;
    text-decoration: none;
    transition: color 0.3s;
}

.logo:hover {
    color: #2563eb;
}

/* روابط التنقل (سطح المكتب) */
.nav-links {
    display: flex;
    gap: 40px; /* زيادة المسافة بين العناصر */
}

.nav-item {
    text-decoration: none;
    color: #374151;
    font-weight: 500;
    transition: color 0.3s;
    padding: 8px 12px; /* إضافة padding لتعزيز المسافات */
}

.nav-item:hover {
    color: #2563eb;
}

/* قائمة المستخدم */
.user-menu {
    display: flex;
    align-items: center;
    gap: 16px;
}

.username {
    font-weight: 600;
    color: #111827;
}

.logout-btn {
    background-color: #dc2626;
    color: #ffffff;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.logout-btn:hover {
    background-color: #b91c1c;
}

/* زر القائمة للهواتف */
.menu-btn {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
}

.icon {
    width: 24px;
    height: 24px;
    stroke: #111827;
    fill: none;
}

/* القائمة الجانبية للهواتف */
.mobile-menu {
    display: none;
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    padding: 8px 0;
}

.mobile-item {
    display: block;
    padding: 10px 16px;
    text-decoration: none;
    color: #374151;
    transition: background-color 0.3s;
}

.mobile-item:hover {
    background: #f3f4f6;
}

.divider {
    border-top: 1px solid #e5e7eb;
    margin: 8px 0;
}

.mobile-logout {
    background-color: #dc2626;
    color: #ffffff;
    border: none;
    width: 100%;
    text-align: left;
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.mobile-logout:hover {
    background-color: #b91c1c;
}

/* استجابة للهواتف */
@media (max-width: 640px) {

    .nav-links,
    .user-menu {
        display: none;
    }

    .menu-btn {
        display: block;
    }

    .mobile-menu {
        display: none;
    }

    .mobile-menu.open {
        display: block;
    }
}

    </style>
</head>

<body>
    <!-- شريط التنقل -->
    <nav x-data="{ open: false }" class="navbar">
        <div class="container">
            <div class="nav-content">
                <!-- الشعار -->
                <a href="{{ route('dashboard') }}" class="logo">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- روابط التنقل (سطح المكتب) -->
                <div class="nav-links hidden sm:flex">
                    <a href="{{ route('dashboard') }}" class="nav-item">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="nav-item">Profile</a>
                </div>

                <!-- قائمة المستخدم -->
                <div class="user-menu hidden sm:flex">
                    <span class="username">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Log Out</button>
                    </form>
                </div>

                <!-- زر القائمة للهواتف -->
                <button @click="open = !open" class="menu-btn sm:hidden">
                    <svg x-show="!open" class="icon" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="icon" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- القائمة الجانبية للهواتف -->
        <div :class="{ 'open': open }" class="mobile-menu sm:hidden">
            <a href="{{ route('dashboard') }}" class="mobile-item">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="mobile-item">Profile</a>
            <div class="divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mobile-logout">Log Out</button>
            </form>
        </div>
    </nav>
</body>

</html>
