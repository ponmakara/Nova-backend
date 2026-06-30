<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Categories</h2>
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Category
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($category->id); ?></td>
                            <td>
                                <?php if($category->image): ?>
                                    <img src="<?php echo e(asset($category->image)); ?>" alt="<?php echo e($category->name); ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted">No image</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($category->name); ?></td>
                            <td><?php echo e(Str::limit($category->description, 50)); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($category->is_active ? 'success' : 'danger'); ?>">
                                    <?php echo e($category->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MAKARA.PON\Desktop\Frontend-E-commerce\backend\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>