<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="dashboard-title">My Dashboard</h1>
            
            <div class="buyer-stats">
                <div class="stat-card">
                    <h3>My Motors</h3>
                    <p class="stat-number">{{ $myMotors }}</p>
                </div>
                <div class="stat-card">
                    <h3>Saved Motors</h3>
                    <p class="stat-number">{{ $savedMotors }}</p>
                </div>
            </div>

            <div class="buyer-actions">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <a href="{{ route('motor.saved') }}" class="btn btn-secondary">View Saved</a>
                    <a href="{{ route('motor.index') }}" class="btn btn-primary">Browse Motors</a>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>