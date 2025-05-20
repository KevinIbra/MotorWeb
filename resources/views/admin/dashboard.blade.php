<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <p class="stat-number">{{ $totalUsers }}</p>
                </div>
                <div class="stat-card">
                    <h3>Total Motors</h3>
                    <p class="stat-number">{{ $totalMotors }}</p>
                </div>
                <div class="stat-card">
                    <h3>Pending Approvals</h3>
                    <p class="stat-number">{{ $pendingApprovals }}</p>
                </div>
            </div>

            <div class="admin-actions">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <a href="{{ route('admin.users') }}" class="btn btn-primary">Manage Users</a>
                    <a href="{{ route('admin.motors') }}" class="btn btn-primary">Manage Motors</a>
                    <a href="{{ route('admin.approvals') }}" class="btn btn-warning">Review Approvals</a>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>