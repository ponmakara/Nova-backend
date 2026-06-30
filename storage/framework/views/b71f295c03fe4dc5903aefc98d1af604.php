<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> - NovaMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .sidebar {
            min-height: 100vh;
            background: #ffffff;
            color: #333;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background: #e0f2f7;
            color: #007bff;
        }
        .sidebar .nav-link.active {
            background: #007bff;
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }
        .main-content {
            padding: 30px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .footer-section {
            background: #ffffff;
            border-top: 1px solid #e9ecef;
            margin: 40px -30px -30px;
            color: #202124;
        }
        .footer-title,
        .footer-brand {
            color: #111827;
            font-weight: 800;
            letter-spacing: 0;
        }
        .footer-text,
        .footer-links li,
        .footer-contact {
            color: #5f6673;
            font-size: 0.92rem;
            line-height: 1.6;
        }
        .footer-main {
            padding: 44px 30px 34px;
        }
        .footer-brand {
            font-size: 2rem;
            line-height: 1;
        }
        .footer-slogan {
            color: #ff2d1f;
            font-weight: 700;
            margin-top: 8px;
        }
        .footer-divider {
            width: min(100%, 260px);
            border-top: 2px solid #1f2937;
            margin: 38px 0 18px;
        }
        .footer-socials {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        .footer-socials a {
            width: 34px;
            height: 34px;
            border: 1px solid #cfd4dc;
            border-radius: 50%;
            color: #111827;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .footer-socials a:hover,
        .footer-socials a.active {
            background: #ff2d1f;
            border-color: #ff2d1f;
            color: #ffffff;
        }
        .footer-title {
            font-size: 1.2rem;
            margin-bottom: 22px;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .footer-links li::before {
            content: "+";
            color: #111827;
            font-weight: 700;
        }
        .footer-contact strong {
            display: block;
            color: #202124;
            margin-top: 2px;
        }
        .footer-contact {
            overflow-wrap: anywhere;
        }
        .footer-thanks {
            border: 2px solid #4b5563;
            border-radius: 5px;
            color: #111827;
            font-weight: 800;
            padding: 12px 20px;
            text-align: center;
            width: min(100%, 620px);
            margin-top: 34px;
        }
        .footer-map {
            min-height: 210px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            background:
                linear-gradient(145deg, transparent 0 43%, rgba(32, 132, 255, 0.6) 44% 51%, transparent 52%),
                linear-gradient(28deg, transparent 0 46%, rgba(39, 173, 216, 0.55) 47% 55%, transparent 56%),
                linear-gradient(90deg, rgba(255,255,255,0.92) 1px, transparent 1px),
                linear-gradient(0deg, rgba(255,255,255,0.92) 1px, transparent 1px),
                #dfe8df;
            background-size: 100% 100%, 100% 100%, 28px 28px, 28px 28px, 100% 100%;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.05);
        }
        .footer-map::before,
        .footer-map::after {
            content: "";
            position: absolute;
            background: rgba(132, 204, 22, 0.35);
            border-radius: 6px;
        }
        .footer-map::before {
            width: 66px;
            height: 38px;
            top: 20px;
            right: 18px;
            transform: rotate(-8deg);
        }
        .footer-map::after {
            width: 74px;
            height: 46px;
            left: 18px;
            bottom: 20px;
            transform: rotate(12deg);
        }
        .map-pin {
            position: absolute;
            top: 50%;
            left: 52%;
            width: 34px;
            height: 34px;
            transform: translate(-50%, -90%) rotate(45deg);
            background: #ff2d1f;
            border-radius: 50% 50% 50% 0;
            box-shadow: 0 8px 16px rgba(255, 45, 31, 0.28);
            z-index: 1;
        }
        .map-pin::after {
            content: "";
            position: absolute;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: #ffffff;
            top: 11px;
            left: 11px;
        }
        @media (max-width: 767.98px) {
            .main-content {
                padding: 20px;
            }
            .footer-section {
                margin: 32px -20px -20px;
            }
            .footer-main {
                padding-left: 20px;
                padding-right: 20px;
            }
            .footer-brand {
                font-size: 1.7rem;
            }
            .footer-map {
                min-height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0 d-flex flex-column">
                <div class="p-4 border-bottom">
                    <h4 class="fw-bold text-primary"><i class="bi bi-shop"></i> NovaMart</h4>
                    <small class="text-muted">Admin Panel</small>
                </div>
                <nav class="nav flex-column mt-3 flex-grow-1">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.categories.index')); ?>">
                        <i class="bi bi-tags"></i> Categories
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.products.index')); ?>">
                        <i class="bi bi-box"></i> Products
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.orders.index')); ?>">
                        <i class="bi bi-cart"></i> Orders
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users.index')); ?>">
                        <i class="bi bi-people"></i> Users
                    </a>
                </nav>
                <div class="p-3 border-top">
                    <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                    <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <div class="input-group" style="max-width: 300px;">
                            <form action="<?php echo e(route('admin.products.index')); ?>" method="GET" id="searchForm">
                                <span class="input-group-text border-0" style="background-color: #f8f9fa; border-radius: 8px 0 0 8px; padding: 8px 12px; border-right: none;">
                                    <i class="bi bi-search" style="color: #6c757d;"></i>
                                </span>
                                <input type="text" class="form-control border-0" style="background-color: #f8f9fa; border-radius: 0 8px 8px 0; border-left: none;" placeholder="Search products..." name="search" id="searchInput" value="<?php echo e(request('search')); ?>">
                            </form>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <h5 class="fw-bold mb-0 text-primary">Dashboard</h5>
                        <a href="#" class="btn btn-light position-relative rounded-circle text-decoration-none" style="width: 40px; height: 40px;">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-circle" style="font-size: 10px; padding: 4px 6px;">3</span>
                        </a>
                        <div class="d-flex align-items-center gap-2">
                            <a href="#" class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 40px; height: 40px;">
                                <i class="bi bi-person text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="flex-grow-1">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchValue = e.target.value;
                    if (searchValue.length >= 2) {
                        fetch(`<?php echo e(route('admin.products.search')); ?>?q=${encodeURIComponent(searchValue)}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log('Search results:', data);
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\MAKARA.PON\Desktop\NovarMart\backend\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>