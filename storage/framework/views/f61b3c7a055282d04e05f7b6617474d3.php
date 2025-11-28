

<?php $__env->startSection('title', 'New customer'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">New customer</div>
                <div class="card-subtitle">Register a customer for future invoices</div>
            </div>
        </div>

        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-error">
                    <strong>There were some problems:</strong>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('customers.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="<?php echo e(old('name')); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?php echo e(old('email')); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="<?php echo e(old('phone')); ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea name="address"
                                  class="form-control"
                                  rows="2"><?php echo e(old('address')); ?></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?php echo e(route('customers.index')); ?>" class="btn-secondary btn">Cancel</a>
                    <button type="submit" class="btn">Save customer</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/customers/create.blade.php ENDPATH**/ ?>