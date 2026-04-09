<x-app-layout>
    @section('styles')
    <style>
        /* Admin Dashboard Theme Styling */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .dashboard-container {
            min-h-screen;
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            padding: 40px 0;
            position: relative;
            overflow: hidden;
        }

        /* Design elements matching CampusMart style */
        .header-section {
            margin-bottom: 40px;
            color: white;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-bottom: 8px;
        }

        .header-section p {
            font-size: 1.125rem;
            color: #bfdbfe;
        }

        /* Statistics Cards Styling */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        @media (min-width: 640px) {
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (min-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 24px;
            color: white;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
            display: block;
        }

        .stat-number {
            font-size: 2.25rem;
            font-weight: 800;
        }

        /* Admin Controls Navigation Styling */
        .controls-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .controls-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 24px;
        }

        .nav-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 16px;
        }

        @media (min-width: 640px) {
            .nav-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (min-width: 1024px) {
            .nav-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }

        .nav-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            filter: brightness(110%);
        }

        .btn-blue { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
        .btn-green { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .btn-orange { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }

        /* Product Listings Table Styling */
        .listings-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .listings-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 24px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th {
            padding: 12px 16px;
            background: #f9fafb;
            color: #6b7280;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e5e7eb;
        }

        .admin-table td {
            padding: 16px;
            color: #1f2937;
            font-size: 0.875rem;
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.3s ease;
        }

        .admin-table tr:hover td {
            background: #f9fafb;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-available { background-color: #d1fae5; color: #065f46; }
        .badge-sold { background-color: #fee2e2; color: #7f1d1d; }

        .btn-delete {
            color: #ef4444;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .btn-delete:hover {
            color: #dc2626;
        }
    </style>
    @endsection

    @section('content')
    <div class="dashboard-container">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- 1. Header Section -->
            <div class="header-section">
                <h1>Admin Dashboard</h1>
                <p>Manage users, products, and platform analytics</p>
            </div>

            <!-- 2. Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total Users</span>
                    <div class="stat-number">5</div>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Total Products</span>
                    <div class="stat-number">15</div>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Available Items</span>
                    <div class="stat-number">15</div>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Sold Items</span>
                    <div class="stat-number">0</div>
                </div>
            </div>

            <!-- 3. Navigation Section -->
            <div class="controls-card">
                <h2 class="controls-title">Admin Controls</h2>
                <div class="nav-grid">
                    <a href="{{ route('admin.users') }}" class="nav-button btn-blue">
                        <span>👥</span> Manage Users
                    </a>
                    <a href="{{ route('admin.products') }}" class="nav-button btn-blue">
                        <span>📦</span> Manage Products
                    </a>
                    <a href="{{ route('admin.analytics') }}" class="nav-button btn-green">
                        <span>📊</span> Analytics
                    </a>
                    <a href="{{ route('admin.categories') }}" class="nav-button btn-green">
                        <span>🏷️</span> Categories
                    </a>
                    <a href="{{ route('admin.reports') }}" class="nav-button btn-orange">
                        <span>📋</span> Reports
                    </a>
                    <a href="{{ route('admin.settings') }}" class="nav-button btn-orange">
                        <span>⚙️</span> Settings
                    </a>
                </div>
            </div>

            <!-- 4. Product Listings Section -->
            <div class="listings-card">
                <h2 class="listings-title">Recent Product Listings</h2>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Condition</th>
                                <th>Poster</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Row 1 -->
                            <tr>
                                <td class="font-bold">Math note</td>
                                <td>Books</td>
                                <td>৳1,000</td>
                                <td>Used-Excellent</td>
                                <td>Yousha Shahid</td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td><a href="#" class="btn-delete">Delete</a></td>
                            </tr>
                            <!-- Sample Row 2 -->
                            <tr>
                                <td class="font-bold">Casio Scientific Calculator</td>
                                <td>Electronics</td>
                                <td>৳1,200</td>
                                <td>Used-Excellent</td>
                                <td>Yasir Ahmed</td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td><a href="#" class="btn-delete">Delete</a></td>
                            </tr>
                            <!-- Sample Row 3 -->
                            <tr>
                                <td class="font-bold">Data Structures & Algorithms Book</td>
                                <td>Books</td>
                                <td>৳350</td>
                                <td>Used-Good</td>
                                <td>Nadia Islam</td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td><a href="#" class="btn-delete">Delete</a></td>
                            </tr>
                            <!-- Sample Row 4 -->
                            <tr>
                                <td class="font-bold">HP 15s Laptop</td>
                                <td>Electronics</td>
                                <td>৳45,000</td>
                                <td>Used-Good</td>
                                <td>Ahmed Khan</td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td><a href="#" class="btn-delete">Delete</a></td>
                            </tr>
                            <!-- Sample Row 5 -->
                            <tr>
                                <td class="font-bold">Ergonomic Mesh Office Chair</td>
                                <td>Furniture</td>
                                <td>৳3,500</td>
                                <td>Used-Good</td>
                                <td>Raisa Rana</td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td><a href="#" class="btn-delete">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @endsection

    {{-- Render styles and content because layout uses $slot but prompt asked for @section --}}
    @yield('styles')
    @yield('content')
</x-app-layout>
