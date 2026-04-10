<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }
        .user-row {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .user-row:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .user-table thead {
            background: rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .user-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #bfdbfe;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .user-table td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #e0e7ff;
            font-size: 0.875rem;
            cursor: pointer;
        }
        .user-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }
        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .role-admin {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .role-user {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        .delete-btn {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .delete-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.5);
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 50;
            animation: fadeIn 0.3s ease;
        }
        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .modal-content {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 32px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #e0e7ff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            font-size: 20px;
        }
        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }
        .modal-header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .modal-header h2 {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }
        .modal-section {
            margin-bottom: 24px;
        }
        .modal-section-title {
            color: #93c5fd;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }
        .modal-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .modal-info-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 12px;
        }
        .modal-info-label {
            color: #bfdbfe;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .modal-info-value {
            color: #e0e7ff;
            font-size: 0.95rem;
            font-weight: 500;
        }
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-top-color: #93c5fd;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="text-4xl font-black text-white mb-2">👥 Users Management</h1>
                <p class="text-blue-200">View and manage all users. Click on any user to see their profile details.</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Total Users</p>
                    <p class="text-3xl font-black text-white">{{ $totalUsers }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Admin Users</p>
                    <p class="text-3xl font-black text-red-400">{{ $adminUsers }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Regular Users</p>
                    <p class="text-3xl font-black text-blue-400">{{ $regularUsers }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Today's Users</p>
                    <p class="text-3xl font-black text-white">{{ $todayUsers }}</p>
                </div>
            </div>

            <!-- Users Table -->
            <div class="glass-container p-8 rounded-3xl overflow-x-auto">
                @if($users->count() > 0)
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Name</th>
                                <th style="width: 20%;">Email</th>
                                <th style="width: 12%;">Phone</th>
                                <th style="width: 10%;">Role</th>
                                <th style="width: 15%;">Registered</th>
                                <th style="width: 18%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="user-row" data-user-id="{{ $user->id }}" onclick="openUserProfile({{ $user->id }})">
                                    <td class="font-semibold text-white">{{ $user->name }}</td>
                                    <td class="text-blue-300">{{ $user->email }}</td>
                                    <td class="text-gray-300">{{ $user->phone ?? 'N/A' }}</td>
                                    <td>
                                        <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td onclick="event.stopPropagation();">
                                        @if($user->role !== 'admin')
                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">Delete User</button>
                                            </form>
                                        @else
                                            <span class="text-gray-500 text-xs">Admin - Cannot Delete</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12">
                                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M19 12a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <p class="text-gray-400 text-lg font-semibold">No users found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($users instanceof \Illuminate\Pagination\Paginator)
                        <div class="mt-8">
                            {{ $users->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M19 12a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <p class="text-gray-400 text-lg font-semibold">No users found</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- User Profile Modal -->
        <div id="profileModal" class="modal-overlay" onclick="if(event.target === this) closeUserProfile()">
            <div class="modal-content">
                <button class="modal-close" onclick="closeUserProfile()">×</button>
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 id="userNameDisplay">Loading...</h2>
                    <p id="userEmailDisplay" class="text-blue-300 text-sm mt-2">Loading...</p>
                </div>

                <!-- User Information Section -->
                <div class="modal-section">
                    <div class="modal-section-title">User Account Information</div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Email</div>
                            <div class="modal-info-value" id="userEmail">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Phone</div>
                            <div class="modal-info-value" id="userPhone">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Role</div>
                            <div class="modal-info-value" id="userRole">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Registered</div>
                            <div class="modal-info-value" id="userCreated">-</div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information Section -->
                <div class="modal-section" id="profileSection" style="display: none;">
                    <div class="modal-section-title">Profile Details</div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-label">Student ID</div>
                            <div class="modal-info-value" id="profileStudentId">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Department</div>
                            <div class="modal-info-value" id="profileDepartment">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Year</div>
                            <div class="modal-info-value" id="profileYear">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Semester</div>
                            <div class="modal-info-value" id="profileSemester">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Batch</div>
                            <div class="modal-info-value" id="profileBatch">-</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-label">Gender</div>
                            <div class="modal-info-value" id="profileGender">-</div>
                        </div>
                    </div>
                </div>

                <!-- No Profile Section -->
                <div class="modal-section" id="noProfileSection" style="display: none;">
                    <div class="text-center py-8">
                        <p class="text-gray-400">No profile information available for this user.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openUserProfile(userId) {
            const modal = document.getElementById('profileModal');
            modal.classList.add('active');

            // Show loading state
            document.getElementById('userNameDisplay').textContent = 'Loading...';
            document.getElementById('userEmailDisplay').textContent = 'Fetching profile details...';

            // Fetch profile data via AJAX
            fetch(`/admin/users/${userId}/profile`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch user profile');
                    }
                    return response.json();
                })
                .then(data => {
                    populateUserModal(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('userNameDisplay').textContent = 'Error Loading Profile';
                    document.getElementById('userEmailDisplay').textContent = 'Unable to fetch user data. Please try again.';
                });
        }

        function closeUserProfile() {
            const modal = document.getElementById('profileModal');
            modal.classList.remove('active');
        }

        function populateUserModal(data) {
            const user = data.user;
            const profile = data.profile;

            // Populate user information
            document.getElementById('userNameDisplay').textContent = user.name;
            document.getElementById('userEmailDisplay').textContent = user.email;
            document.getElementById('userEmail').textContent = user.email;
            document.getElementById('userPhone').textContent = user.phone || 'N/A';
            document.getElementById('userRole').textContent = user.role.charAt(0).toUpperCase() + user.role.slice(1);
            document.getElementById('userCreated').textContent = user.created_at;

            // Populate profile information or show no profile message
            if (profile) {
                document.getElementById('profileSection').style.display = 'block';
                document.getElementById('noProfileSection').style.display = 'none';

                document.getElementById('profileStudentId').textContent = profile.student_id || 'N/A';
                document.getElementById('profileDepartment').textContent = profile.department || 'N/A';
                document.getElementById('profileYear').textContent = profile.year || 'N/A';
                document.getElementById('profileSemester').textContent = profile.semester || 'N/A';
                document.getElementById('profileBatch').textContent = profile.batch || 'N/A';
                document.getElementById('profileGender').textContent = profile.gender || 'N/A';
            } else {
                document.getElementById('profileSection').style.display = 'none';
                document.getElementById('noProfileSection').style.display = 'block';
            }
        }

        // Close modal when Escape key is pressed
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeUserProfile();
            }
        });
    </script>
</x-app-layout>
