

<?php $__env->startSection('title', 'Items'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Items</div>
                <div class="card-subtitle">Registered items for invoices</div>
            </div>
            <a href="<?php echo e(route('items.create')); ?>" class="btn">
                + New item
            </a>
        </div>

        <div class="card-body">
            <?php if($items->isEmpty()): ?>
                <p style="color: var(--text-muted); font-size: 0.9rem;">
                    No items yet. Create your first item.
                </p>
            <?php else: ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-right">Unit price</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->name); ?></td>
                            <td style="max-width: 260px;">
                                <span style="font-size: 0.8rem; color: var(--text-muted);">
                                    <?php echo e(\Illuminate\Support\Str::limit($item->description, 80)); ?>

                                </span>
                            </td>
                            <td class="text-right"><?php echo e(number_format($item->unit_price, 2)); ?></td>
                            <td><?php echo e($item->created_at->format('Y-m-d')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div style="margin-top: 10px;">
                    <?php echo e($items->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/items/index.blade.php ENDPATH**/ ?>