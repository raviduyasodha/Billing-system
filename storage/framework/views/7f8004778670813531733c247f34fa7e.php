

<?php $__env->startSection('title', 'Invoice ' . $invoice->invoice_number); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">
                    Invoice <?php echo e($invoice->invoice_number); ?>

                </div>
                <div class="card-subtitle">
                    <?php echo e($invoice->customer->name ?? 'No customer'); ?>

                </div>
            </div>

            <div style="text-align: right; font-size: 0.8rem;">
                <div>
                    Status:
                    <?php $s = $invoice->status; ?>
                    <span class="badge badge-<?php echo e($s); ?>"><?php echo e(strtoupper($s)); ?></span>
                </div>
                <div style="margin-top: 4px; color: var(--text-muted);">
                    Date: <?php echo e(\Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d')); ?><br>
                    <?php if($invoice->due_date): ?>
                        Due: <?php echo e(\Carbon\Carbon::parse($invoice->due_date)->format('Y-m-d')); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card-body">
            
            <div class="summary" style="margin-bottom: 14px;">
                <div class="summary-row">
                    <span class="summary-label">Customer</span>
                    <span class="summary-value">
                        <?php echo e($invoice->customer->name ?? '-'); ?>

                    </span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Email</span>
                    <span class="summary-value">
                        <?php echo e($invoice->customer->email ?? '-'); ?>

                    </span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Phone</span>
                    <span class="summary-value">
                        <?php echo e($invoice->customer->phone ?? '-'); ?>

                    </span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Address</span>
                    <span class="summary-value">
                        <?php echo e($invoice->customer->address ?? '-'); ?>

                    </span>
                </div>
            </div>

            
            <div class="items-card">
                <div class="items-header">
                    <div class="items-title">Items</div>
                </div>

                <?php if($invoice->items->isEmpty()): ?>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 8px 0 0;">
                        No items added.
                    </p>
                <?php else: ?>
                    <table class="table" style="margin-bottom: 0;">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Unit price</th>
                            <th class="text-right">Line total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->description); ?></td>
                                <td class="text-right"><?php echo e($item->quantity); ?></td>
                                <td class="text-right"><?php echo e(number_format($item->unit_price, 2)); ?></td>
                                <td class="text-right"><?php echo e(number_format($item->line_total, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            
            <div class="summary" style="margin-top: 14px; max-width: 320px; margin-left: auto;">
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value"><?php echo e(number_format($invoice->subtotal, 2)); ?></span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Tax</span>
                    <span class="summary-value"><?php echo e(number_format($invoice->tax, 2)); ?></span>
                </div>
                <div class="summary-row summary-total">
                    <span class="summary-label">Total</span>
                    <span class="summary-value"><?php echo e(number_format($invoice->total, 2)); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?php echo e(route('invoices.index')); ?>" class="btn-secondary btn">Back to invoices</a>
                <a href="<?php echo e(route('invoices.create')); ?>" class="btn">Create another invoice</a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/invoices/show.blade.php ENDPATH**/ ?>