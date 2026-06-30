<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products</h2>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Product
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
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($product->id); ?></td>
                            <td>
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted">No image</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->category->name); ?></td>
                            <td>$<?php echo e(number_format($product->price, 2)); ?></td>
                            <td><?php echo e($product->stock); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($product->is_active ? 'success' : 'danger'); ?>">
                                    <?php echo e($product->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" style="display: inline;">
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

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MAKARA.PON\Desktop\Frontend-E-commerce\backend\resources\views/admin/products/index.blade.php ENDPATH**/ ?>