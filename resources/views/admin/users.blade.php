@extends('admin.layout.app')

@section('title', 'Administration')

@section('content')
<div class="container-fluid px-0">

    <!-- Section Title & Action Buttons -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">System &amp; Administration</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">09</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">System &amp; Personnel Governance</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="bi bi-plus-lg"></i> Add Staff Member
            </button>
        </div>
    </div>

    <!-- Quick Metrics Row -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
        <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Total Personnel</div>
                <div class="value mt-1">{{ $totalUsers }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Across {{ $roleCount }} staff roles</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card" style="border-left: 3px solid #1C7C4C;">
                <div class="label text-success">Active Staff Accounts</div>
                <div class="value text-success mt-1">{{ $totalActiveUsers }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Enabled for login</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="label">System Health</div>
                <div class="value mt-1 gradient-text-gold">100%</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Database &amp; PMS operational</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card">
                <div class="label">Security Audit</div>
                <div class="value mt-1 text-success">0</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">No policy violations detected</div>
            </div>
        </div>
    </div>

    <!-- Main Layout: Left Staff Table (8 cols), Right System Settings (4 cols) -->
    <div class="row g-4">

        <!-- Left: Staff Members & Roles Table -->
        <div class="col-12 col-xl-8" data-aos="fade-up" data-aos-delay="300">
            <div class="admin-card p-0 overflow-hidden">
                <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Staff Directory & Permissions</h6>
                        <span class="text-muted small" style="font-size: 0.75rem;">Manage team credentials and portal authorization</span>
                    </div>
                    <input type="text" id="userTableSearch" class="form-control form-control-sm" placeholder="Search staff or role..." style="width: 200px;">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="usersTable">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Staff Member</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Account Status</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            @php
                            $roleBadges = [
                                'ADMIN'        => 'bg-danger text-white',
                                'MANAGER'      => 'bg-dark text-white',
                                'RECEPTIONIST' => 'bg-primary text-white',
                                'MAINTENANCE'  => 'bg-warning text-dark',
                                'SERVER'       => 'bg-info text-dark',
                            ];
                            @endphp
                            <tr class="user-row">
                                <td class="ps-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($user->full_name ?? $user->username, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->full_name }}</div>
                                            <small class="text-muted">&#64;{{ $user->username }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $roleBadges[$user->role] ?? 'bg-secondary' }}">{{ $user->role }}</span>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->is_active)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                                    @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-3">
                                    <div class="d-inline-flex gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary edit-user-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal"
                                            data-id="{{ $user->id }}"
                                            data-fullname="{{ $user->full_name }}"
                                            data-username="{{ $user->username }}"
                                            data-email="{{ $user->email }}"
                                            data-role="{{ $user->role }}"
                                            data-active="{{ $user->is_active ? '1' : '0' }}">
                                            Edit
                                        </button>

                                        @if(Auth::id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete user {{ $user->username }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">No users found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-3 bg-white border-top border-1 text-center">
                    <span class="text-muted small" style="font-size: 0.8rem;">
                        Showing {{ $users->count() }} staff members in Zhen Resort PMS
                    </span>
                </div>
            </div>
        </div>

        <!-- Right: Operational Policies & System Preferences -->
        <div class="col-12 col-xl-4 d-flex flex-column gap-3" data-aos="fade-up" data-aos-delay="350">

            <!-- Property Settings Toggles -->
            <div class="admin-card p-3">
                <h6 class="fw-bold text-dark mb-1">Resort Rules & Automation</h6>
                <p class="text-muted small mb-4" style="font-size: 0.75rem;">Global toggles affecting PMS workflow</p>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold small">Automatic Housekeeping Queue</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Dispatch rooms immediately on check-out</div>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" role="switch" checked>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <div>
                            <div class="fw-semibold small">Overbooking Buffer (2%)</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Permit peak season overflow holds</div>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" role="switch">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <div>
                            <div class="fw-semibold small">Guest Arrival SMS Dispatch</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Send concierge link 2h prior to check-in</div>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" role="switch" checked>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <div>
                            <div class="fw-semibold small">Daily Night Audit Auto-Run</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Close daily books at 03:00 AM</div>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" role="switch" checked>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Staff Activity -->
            <div class="admin-card p-3">
                <h6 class="fw-bold text-dark mb-1">Recent Staff Onboarding</h6>
                <p class="text-muted small mb-3" style="font-size: 0.75rem;">Latest team members added</p>

                <div class="d-flex flex-column gap-2 small">
                    @forelse($recentUsers as $rUser)
                    <div class="d-flex gap-2 {{ !$loop->first ? 'border-top pt-2' : '' }}">
                        <i class="bi bi-person-check text-success"></i>
                        <div>
                            <span class="fw-semibold text-dark">{{ $rUser->full_name }}</span> ({{ $rUser->role }})
                            <div class="text-muted" style="font-size: 0.68rem;">Joined {{ $rUser->created_at ? $rUser->created_at->diffForHumans() : 'Recently' }}</div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted small mb-0">No recent staff additions.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

@section('modals')
<!-- 1. CREATE USER MODAL -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.users.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-12">
                    <label class="form-label small fw-bold">Full Name</label>
                    <input type="text" name="full_name" class="form-control" placeholder="e.g. John Doe" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="e.g. jdoe" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="user@zhenresort.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="ADMIN">ADMIN</option>
                        <option value="MANAGER">MANAGER</option>
                        <option value="RECEPTIONIST">RECEPTIONIST</option>
                        <option value="MAINTENANCE">MAINTENANCE</option>
                        <option value="SERVER">SERVER</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Account Status</label>
                    <select name="is_active" class="form-select" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Create User</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT USER MODAL -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="editUserForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-12">
                    <label class="form-label small fw-bold">Full Name</label>
                    <input type="text" name="full_name" id="edit_full_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Username</label>
                    <input type="text" name="username" id="edit_username" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" id="edit_email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">New Password</label>
                    <input type="password" name="password" id="edit_password" class="form-control" placeholder="Leave blank to keep current">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Role</label>
                    <select name="role" id="edit_role" class="form-select" required>
                        <option value="ADMIN">ADMIN</option>
                        <option value="MANAGER">MANAGER</option>
                        <option value="RECEPTIONIST">RECEPTIONIST</option>
                        <option value="MAINTENANCE">MAINTENANCE</option>
                        <option value="SERVER">SERVER</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Account Status</label>
                    <select name="is_active" id="edit_is_active" class="form-select" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-user-btn');
        const form = document.getElementById('editUserForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                form.action = `/admin/users/${id}`;

                document.getElementById('edit_full_name').value = button.getAttribute('data-fullname') || '';
                document.getElementById('edit_username').value = button.getAttribute('data-username') || '';
                document.getElementById('edit_email').value = button.getAttribute('data-email') || '';
                document.getElementById('edit_password').value = '';
                document.getElementById('edit_role').value = button.getAttribute('data-role') || 'RECEPTIONIST';
                document.getElementById('edit_is_active').value = button.getAttribute('data-active') || '1';
            });
        });

        // In-table search
        const searchInput = document.getElementById('userTableSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', () => {
                const val = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('.user-row');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(val) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush