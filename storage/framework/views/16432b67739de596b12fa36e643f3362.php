<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>
<h2>Users</h2>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Orders</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->phone ?? '-'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($user->is_admin ? 'danger' : 'primary'); ?>">
                                    <?php echo e($user->is_admin ? 'Admin' : 'User'); ?>

                                </span>
                            </td>
                            <td><?php echo e($user->orders->count()); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.users.show', $user)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MAKARA.PON\Desktop\NovarMart\backend\resources\views/admin/users/index.blade.php ENDPATH**/ ?>