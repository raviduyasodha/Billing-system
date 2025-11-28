

<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Customers</div>
                <div class="card-subtitle">Registered customers</div>
            </div>
            <a href="<?php echo e(route('customers.create')); ?>" class="btn">
                + New customer
            </a>
        </div>

        <div class="card-body">
            <?php if($customers->isEmpty()): ?>
                <p style="color: var(--text-muted); font-size: 0.9rem;">
                    No customers yet. Add your first customer.
                </p>
            <?php else: ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($customer->name); ?></td>
                            <td><?php echo e($customer->email); ?></td>
                            <td><?php echo e($customer->phone ?? '-'); ?></td>
                            <td><?php echo e($customer->created_at->format('Y-m-d')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div style="margin-top: 10px;">
                    <?php echo e($customers->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/customers/index.blade.php ENDPATH**/ ?>