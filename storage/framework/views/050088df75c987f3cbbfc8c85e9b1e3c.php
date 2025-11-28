

<?php $__env->startSection('title', 'New item'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">New item</div>
                <div class="card-subtitle">Register an item with default price</div>
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

            <form action="<?php echo e(route('items.store')); ?>" method="POST">
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
                        <label class="form-label">Unit price</label>
                        <input type="number"
                               step="0.01"
                               name="unit_price"
                               class="form-control"
                               value="<?php echo e(old('unit_price')); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description (optional)</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3"><?php echo e(old('description')); ?></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?php echo e(route('items.index')); ?>" class="btn-secondary btn">Cancel</a>
                    <button type="submit" class="btn">Save item</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/items/create.blade.php ENDPATH**/ ?>