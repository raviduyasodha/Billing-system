

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Dashboard</div>
                <div class="card-subtitle">Quick overview and shortcuts</div>
            </div>
        </div>

        <div class="card-body">
            <div style="display: grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap: 14px;">
                
                <div class="summary" style="background: radial-gradient(circle at top left, rgba(59,130,246,0.18) 0, #020617 60%);">
                    <div class="summary-row">
                        <span class="summary-label">Customers</span>
                        <span class="summary-value"><?php echo e($customerCount); ?></span>
                    </div>
                    <div style="margin-top: 8px; display:flex; gap:8px;">
                        <a href="<?php echo e(route('customers.index')); ?>" class="btn-secondary btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            View all
                        </a>
                        <a href="<?php echo e(route('customers.create')); ?>" class="btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            + New customer
                        </a>
                    </div>
                </div>

                
                <div class="summary" style="background: radial-gradient(circle at top left, rgba(16,185,129,0.18) 0, #020617 60%);">
                    <div class="summary-row">
                        <span class="summary-label">Invoices</span>
                        <span class="summary-value"><?php echo e($invoiceCount); ?></span>
                    </div>
                    <div style="margin-top: 8px; display:flex; gap:8px;">
                        <a href="<?php echo e(route('invoices.index')); ?>" class="btn-secondary btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            View all
                        </a>
                        <a href="<?php echo e(route('invoices.create')); ?>" class="btn" style="padding: 4px 10px; font-size: 0.8rem;">
                            + New invoice
                        </a>
                    </div>
                </div>
            </div>

            <div style="margin-top: 18px; font-size: 0.85rem; color: var(--text-muted);">
                From here you mainly use:
                <ul style="margin-top: 6px; padding-left: 18px;">
                    <li><strong>Customers</strong> to register clients</li>
                    <li><strong>Invoices</strong> to create invoices with items</li>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/dashboard.blade.php ENDPATH**/ ?>