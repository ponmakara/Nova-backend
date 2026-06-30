<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products</h2>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Product
    </a>
</div>

<div class="row g-4">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
                <div class="position-relative">
                    <?php if($product->image): ?>
                        <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">No image</span>
                        </div>
                    <?php endif; ?>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-3">-25%</span>
                    <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-3 rounded-circle" style="width: 35px; height: 35px;">
                        <i class="bi bi-heart"></i>
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($product->name); ?></h5>
                    <p class="card-text text-muted small"><?php echo e(Str::limit($product->description ?? 'No description', 80)); ?></p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fw-bold fs-5 text-danger">$<?php echo e(number_format($product->price, 2)); ?></span>
                        <span class="text-muted text-decoration-line-through ms-2">$<?php echo e(number_format($product->price * 1.25, 2)); ?></span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-muted small ms-2">(120)</span>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <div class="d-flex flex-column gap-2">
                        <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-primary w-100">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<style>
.product-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MAKARA.PON\Desktop\NovarMart\backend\resources\views/admin/products/index.blade.php ENDPATH**/ ?>