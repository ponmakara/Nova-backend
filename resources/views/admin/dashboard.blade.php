@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted mb-0">Welcome back, Admin! Here's what's happening today.</p>
    </div>
    <div class="text-end">
        <small class="text-muted">{{ now()->format('l, F j, Y') }}</small>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card bg-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">
                        <i class="bi bi-arrow-up"></i> 12%
                    </span>
                </div>
                <h6 class="text-muted mb-2">Total Users</h6>
                <h2 class="fw-bold mb-0">{{ $stats['total_users'] }}</h2>
                <small class="text-muted">from last month</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-box"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">
                        <i class="bi bi-arrow-up"></i> 8%
                    </span>
                </div>
                <h6 class="text-muted mb-2">Total Products</h6>
                <h2 class="fw-bold mb-0">{{ $stats['total_products'] }}</h2>
                <small class="text-muted">from last month</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-cart"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">
                        <i class="bi bi-arrow-up"></i> 24%
                    </span>
                </div>
                <h6 class="text-muted mb-2">Total Orders</h6>
                <h2 class="fw-bold mb-0">{{ $stats['total_orders'] }}</h2>
                <small class="text-muted">from last month</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success">
                        <i class="bi bi-arrow-up"></i> 18%
                    </span>
                </div>
                <h6 class="text-muted mb-2">Total Revenue</h6>
                <h2 class="fw-bold mb-0">${{ number_format($stats['total_revenue'], 2) }}</h2>
                <small class="text-muted">from last month</small>
            </div>
        </div>
    </div>
</div>

<!-- Sales Overview & Platform Health -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="card stat-card bg-white border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Sales Overview</h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary active">Weekly</button>
                        <button type="button" class="btn btn-outline-primary">Monthly</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px;">
                    <div class="text-center text-white">
                        <i class="bi bi-graph-up fs-1 mb-2"></i>
                        <p class="mb-0 fw-bold">Live Sales Visualization Active</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card stat-card bg-white border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h5 class="fw-bold mb-0">Platform Health</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center p-3 bg-light rounded">
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-check-circle text-success"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Server Optimization</h6>
                            <small class="text-muted">Complete</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center p-3 bg-light rounded">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-exclamation-triangle text-warning"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Inventory Alert</h6>
                            <small class="text-muted">5 items low stock</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center p-3 bg-light rounded">
                        <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-check text-info"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">New Merchant</h6>
                            <small class="text-muted">Verification pending</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card stat-card bg-white mb-4">
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Recent Orders</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All Orders</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ORDER ID</th>
                        <th>CUSTOMER</th>
                        <th>DATE</th>
                        <th>TOTAL</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td><span class="fw-bold text-primary">#{{ $order->order_number }}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span>{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @if($order->status == 'completed')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> Completed
                                    </span>
                                @elseif($order->status == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                        <i class="bi bi-clock me-1"></i> Pending
                                    </span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                                        <i class="bi bi-arrow-repeat me-1"></i> Processing
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i> Cancelled
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                <p class="text-muted mb-0">No orders yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
