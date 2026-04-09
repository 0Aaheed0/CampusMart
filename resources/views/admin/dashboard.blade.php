<x-app-layout>
    <style>
        .page-bg {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: #3b82f6;
            filter: blur(140px);
            opacity: 0.15;
            border-radius: 50%;
            animation: move 20s infinite alternate;
        }

        .blob2 { right: -150px; bottom: -150px; background: #22c55e; }
        .blob3 { left: -150px; top: -150px; background: #60a5fa; }

        @keyframes move {
            from { transform: translate(0, 0) }
            to { transform: translate(80px, 60px) }
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .admin-table-container {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .admin-table thead {
            background: #f8fafc;
        }

        .admin-table th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #64748b;
            padding: 16px 24px;
            text-align: left;
        }

        .admin-table td {
            padding: 16px 24px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-available { background: #dcfce7; color: #166534; }
        .status-sold { background: #fee2e2; color: #991b1b; }
        .status-pending { background: #fef9c3; color: #854d0e; }

        .role-badge {
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
        }

        .role-admin { background: #1e3a8a; color: white; }
        .role-user { background: #e2e8f0; color: #475569; }
    </style>

    <div class="py-12 page-bg min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-10 flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-black text-white tracking-tight">Admin Dashboard</h1>
                    <p class="text-blue-100 mt-2">Manage users and products for CampusMart</p>
                </div>
            </div>

            <!-- Messages -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 mb-8 rounded-2xl shadow-xl flex items-center gap-3">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-4 mb-8 rounded-2xl shadow-xl flex items-center gap-3">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="stat-card">
                    <p class="text-blue-200 font-bold text-xs uppercase tracking-widest mb-1">Total Users</p>
                    <h2 class="text-4xl font-black text-white">{{ $totalUsers }}</h2>
                </div>
                <div class="stat-card">
                    <p class="text-blue-200 font-bold text-xs uppercase tracking-widest mb-1">Total Products</p>
                    <h2 class="text-4xl font-black text-white">{{ $totalProducts }}</h2>
                </div>
                <div class="stat-card">
                    <p class="text-green-300 font-bold text-xs uppercase tracking-widest mb-1">Available</p>
                    <h2 class="text-4xl font-black text-white">{{ $availableProducts }}</h2>
                </div>
                <div class="stat-card">
                    <p class="text-red-300 font-bold text-xs uppercase tracking-widest mb-1">Sold Items</p>
                    <h2 class="text-4xl font-black text-white">{{ $soldProducts }}</h2>
                </div>
            </div>

            <!-- Products Table -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-black text-white">All Product Listings</h2>
                </div>
                <div class="admin-table-container">
                    <div class="overflow-x-auto">
                        <table class="admin-table w-full">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Condition</th>
                                    <th>Poster</th>
                                    <th>Posted Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="font-bold">{{ $product->product_name }}</td>
                                        <td>{{ $product->product_type }}</td>
                                        <td class="font-bold text-blue-600">৳{{ number_format($product->price) }}</td>
                                        <td>{{ $product->condition }}</td>
                                        <td>
                                            <div class="flex flex-col">
                                                <span class="font-semibold">{{ $product->user->name ?? 'Anonymous' }}</span>
                                                <span class="text-xs text-gray-500">{{ $product->contact_number }}</span>
                                            </div>
                                        </td>
                                        <td class="text-gray-500">{{ $product->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $product->status }}">
                                                {{ $product->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition-colors">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-black text-white">Registered Users</h2>
                </div>
                <div class="admin-table-container">
                    <div class="overflow-x-auto">
                        <table class="admin-table w-full">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Joined Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-black text-xs uppercase">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <span class="font-bold">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? 'N/A' }}</td>
                                        <td>
                                            <span class="role-badge role-{{ $user->role }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($user->role !== 'admin')
                                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition-colors">Delete</button>
                                                </form>
                                            @else
                                                <span class="text-gray-300 font-bold italic">Protected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
