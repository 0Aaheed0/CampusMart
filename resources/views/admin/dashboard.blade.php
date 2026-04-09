<x-app-layout>
    <style>
        .dashboard-bg {
            background: #0f172a;
            min-h-screen;
            position: relative;
            overflow: hidden;
        }

        /* Background Effects */
        .dashboard-bg::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.2;
            transform: translate(150px, -150px);
        }

        .dashboard-bg::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #4c1d95, #6366f1);
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.2;
            transform: translate(-150px, 150px);
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 32px;
            position: relative;
            z-index: 10;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 32px;
        }

        .header-content h1 {
            font-size: 3.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 8px;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .header-content p {
            font-size: 1.125rem;
            color: #bfdbfe;
            font-weight: 500;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 14px 28px;
            border-radius: 14px;
            border: none;
            font-weight: 800;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (min-width: 640px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (min-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(4, 1fr); }
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 20px;
            padding: 24px;
            color: white;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #93c5fd;
            margin-bottom: 8px;
            display: block;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            color: #ffffff;
        }

        /* Controls Title */
        .controls-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 24px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .section-badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.4);
            color: #93c5fd;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Nav Grid */
        .nav-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 16px;
        }

        @media (min-width: 640px) {
            .nav-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (min-width: 1024px) {
            .nav-grid { grid-template-columns: repeat(4, 1fr); }
        }

        .nav-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 24px 20px;
            border-radius: 16px;
            font-weight: 800;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 18px;
        }

        .nav-button span {
            font-size: 2.5rem;
            display: block;
        }

        .nav-button:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-blue {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.2));
            color: #93c5fd;
        }

        .btn-blue:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(37, 99, 235, 0.3));
            box-shadow: 0 12px 40px rgba(59, 130, 246, 0.2);
        }

        .btn-green {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
            color: #6ee7b7;
        }

        .btn-green:hover {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.3), rgba(5, 150, 105, 0.3));
            box-shadow: 0 12px 40px rgba(16, 185, 129, 0.2);
        }

        .btn-orange {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(217, 119, 6, 0.2));
            color: #fcd34d;
        }

        .btn-orange:hover {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.3), rgba(217, 119, 6, 0.3));
            box-shadow: 0 12px 40px rgba(245, 158, 11, 0.2);
        }
    </style>

    <div class="dashboard-bg py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="header-container glass-container mb-8">
                <div class="header-content">
                    <h1>🎛️ Admin Dashboard</h1>
                    <p>Control and manage your CampusMart platform</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        🚪 Logout
                    </button>
                </form>
            </div>

            <!-- Statistics -->
            <div class="stats-grid mb-8">
                <div class="stat-card glass-container">
                    <span class="stat-label">👥 Total Users</span>
                    <div class="stat-number">5</div>
                </div>
                <div class="stat-card glass-container">
                    <span class="stat-label">📦 Total Products</span>
                    <div class="stat-number">15</div>
                </div>
                <div class="stat-card glass-container">
                    <span class="stat-label">✅ Available Items</span>
                    <div class="stat-number">15</div>
                </div>
                <div class="stat-card glass-container">
                    <span class="stat-label">🎁 Sold Items</span>
                    <div class="stat-number">0</div>
                </div>
            </div>

            <!-- Admin Controls -->
            <div class="glass-container mb-8">
                <div class="section-badge">⚙️ ADMIN CONTROLS</div>
                <h2 class="controls-title">Management Tools</h2>
                <div class="nav-grid">
                    <a href="{{ route('admin.products') }}" class="nav-button btn-blue">
                        <span>📦</span>
                        Products
                    </a>
                    <a href="{{ route('admin.reports') }}" class="nav-button btn-blue">
                        <span>📋</span>
                        Reports
                    </a>
                    <a href="{{ route('admin.faq') }}" class="nav-button btn-green">
                        <span>❓</span>
                        FAQ
                    </a>
                    <a href="{{ route('admin.users') }}" class="nav-button btn-green">
                        <span>👥</span>
                        Users
                    </a>
                    <a href="{{ route('admin.reviews') }}" class="nav-button btn-orange">
                        <span>⭐</span>
                        Reviews
                    </a>
                    <a href="{{ route('admin.history') }}" class="nav-button btn-orange">
                        <span>📜</span>
                        History
                    </a>
                </div>
            </div>

            <!-- Footer note -->
            <div class="glass-container text-center">
                <p class="text-blue-300 text-sm">
                    💡 Use the management tools above to control all aspects of your CampusMart platform
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
