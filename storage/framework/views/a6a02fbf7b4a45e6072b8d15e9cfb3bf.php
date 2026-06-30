<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted mb-0">Welcome back, Admin! Here's what's happening today.</p>
    </div>
    <div class="text-end">
        <small class="text-muted"><?php echo e(now()->format('l, F j, Y')); ?></small>
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
                <h2 class="fw-bold mb-0"><?php echo e($stats['total_users']); ?></h2>
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
                <h2 class="fw-bold mb-0"><?php echo e($stats['total_products']); ?></h2>
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
                <h2 class="fw-bold mb-0"><?php echo e($stats['total_orders']); ?></h2>
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
                <h2 class="fw-bold mb-0">$<?php echo e(number_format($stats['total_revenue'], 2)); ?></h2>
                <small class="text-muted">from last month</small>
            </div>
        </div>
    </div>
</div>

<!-- Pending Orders Alert -->
<?php if($stats['pending_orders'] > 0): ?>
<div class="alert alert-warning border-0 shadow-sm mb-4">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
        <div>
            <h6 class="alert-heading mb-1">You have <?php echo e($stats['pending_orders']); ?> pending orders</h6>
            <p class="mb-0">Please review and process them as soon as possible.</p>
        </div>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-warning ms-auto">View Orders</a>
    </div>
</div>
<?php endif; ?>

<!-- Recent Orders Table -->
<div class="card stat-card bg-white mb-4">
    <div class="card-header bg-white border-0 pt-4 pb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Recent Orders</h5>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="fw-bold text-primary"><?php echo e($order->order_number); ?></span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span><?php echo e($order->user->name); ?></span>
                                </div>
                            </td>
                            <td class="fw-bold">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                            <td>
                                <?php if($order->status == 'completed'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> Completed
                                    </span>
                                <?php elseif($order->status == 'pending'): ?>
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                        <i class="bi bi-clock me-1"></i> Pending
                                    </span>
                                <?php elseif($order->status == 'processing'): ?>
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                                        <i class="bi bi-arrow-repeat me-1"></i> Processing
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i> Cancelled
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted"><?php echo e($order->created_at->format('M d, Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                <p class="text-muted mb-0">No orders yet</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-md-12">
        <div class="card stat-card bg-white">
            <div class="card-header bg-white border-0 pt-4 pb-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-plus-circle me-2"></i> Add New Category
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-outline-success w-100 mb-2">
                            <i class="bi bi-plus-circle me-2"></i> Add New Product
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline-info w-100 mb-2">
                            <i class="bi bi-cart-check me-2"></i> Manage Orders
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-warning w-100 mb-2">
                            <i class="bi bi-people me-2"></i> View All Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MAKARA.PON\Desktop\Frontend-E-commerce\backend\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>