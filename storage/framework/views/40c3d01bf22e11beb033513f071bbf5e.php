

<?php $__env->startSection('title', 'Invoices'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Invoices</div>
                <div class="card-subtitle">Overview of all invoices</div>
            </div>
            <a href="<?php echo e(route('invoices.create')); ?>" class="btn">+ New Invoice</a>
        </div>

        <div class="card-body">
            <?php if($invoices->isEmpty()): ?>
                <p style="color: var(--text-muted); font-size: 0.9rem;">No invoices yet. Create your first one.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($invoice->invoice_number); ?></td>
                            <td><?php echo e($invoice->customer->name ?? 'N/A'); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d')); ?></td>
                            <td>
                                <?php $s = $invoice->status; ?>
                                <span class="badge badge-<?php echo e($s); ?>">
                                    <?php echo e(strtoupper($s)); ?>

                                </span>
                            </td>
                            <td class="text-right">
                                <?php echo e(number_format($invoice->total, 2)); ?>

                            </td>
                            <td class="text-right">
                                <a href="<?php echo e(route('invoices.show', $invoice)); ?>" class="btn-secondary btn" style="padding: 4px 10px; font-size: 0.78rem;">View</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div style="margin-top: 10px;">
                    <?php echo e($invoices->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/invoices/index.blade.php ENDPATH**/ ?>