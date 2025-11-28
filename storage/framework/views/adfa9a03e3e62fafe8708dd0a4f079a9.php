

<?php $__env->startSection('title', 'Create Invoice'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Create Invoice</div>
                <div class="card-subtitle">Fill customer details and add line items</div>
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

            <form action="<?php echo e(route('invoices.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-select" required>
                            <option value="">Select customer</option>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($customer->id); ?>" <?php if(old('customer_id') == $customer->id): echo 'selected'; endif; ?>>
                                    <?php echo e($customer->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Invoice date</label>
                        <input type="date"
                               name="invoice_date"
                               class="form-control"
                               value="<?php echo e(old('invoice_date', now()->toDateString())); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Due date</label>
                        <input type="date"
                               name="due_date"
                               class="form-control"
                               value="<?php echo e(old('due_date')); ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Discount (%)</label>
                        <input type="number"
                               step="0.01"
                               name="tax_rate"
                               class="form-control"
                               value="<?php echo e(old('tax_rate', 0)); ?>">
                    </div>
                </div>

                <div class="items-card">
                    <div class="items-header">
                        <div class="items-title">Items</div>
                        <button type="button" class="btn" style="padding: 4px 10px; font-size: 0.78rem;" onclick="addItemRow()">
                            + Add item
                        </button>
                    </div>

                    <div id="items-wrapper" class="items-rows">
                        <?php
                            $oldItems = old('items', [
                             ['item_id' => '', 'quantity' => 1, 'unit_price' => '']]);
                        ?>


                        <?php $__currentLoopData = $oldItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item-row" data-index="<?php echo e($index); ?>">
    <select name="items[<?php echo e($index); ?>][item_id]"
            class="form-select item-select"
            required>
        <option value="">Select item</option>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($product->id); ?>"
                    data-price="<?php echo e($product->unit_price); ?>"
                    <?php if(($item['item_id'] ?? '') == $product->id): echo 'selected'; endif; ?>>
                <?php echo e($product->name); ?> (<?php echo e(number_format($product->unit_price, 2)); ?>)
            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <input type="number"
           name="items[<?php echo e($index); ?>][quantity]"
           placeholder="Qty"
           min="1"
           class="form-control"
           value="<?php echo e($item['quantity'] ?? 1); ?>"
           required>

    <input type="number"
           step="0.01"
           name="items[<?php echo e($index); ?>][unit_price]"
           placeholder="Unit price"
           class="form-control item-unit-price"
           value="<?php echo e($item['unit_price'] ?? ''); ?>"
           required>

    <div class="item-remove-wrap">
        <button type="button" class="item-remove-btn" onclick="removeItemRow(this)">
            ✕
        </button>
    </div>
</div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="items-footer">
                        <span>Tip: description + quantity + unit price. You can remove a row with the ✕ button.</span>
                        <button type="button" class="btn-secondary btn" style="padding: 4px 10px; font-size: 0.78rem;" onclick="addItemRow()">
                            + Add another item
                        </button>
                    </div>
                </div>

                <div class="summary">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value" id="summary-subtotal">0.00</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Estimated tax</span>
                        <span class="summary-value" id="summary-tax">0.00</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span class="summary-label">Estimated total</span>
                        <span class="summary-value" id="summary-total">0.00</span>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn-secondary btn">Cancel</a>
                    <button type="submit" class="btn">Save invoice</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let itemIndex = <?php echo e(count($oldItems)); ?>;

    function addItemRow() {
        const wrapper = document.getElementById('items-wrapper');
        const row = document.createElement('div');
        row.classList.add('item-row');
        row.setAttribute('data-index', itemIndex);

        row.innerHTML = `
            <select name="items[${itemIndex}][item_id]"
                    class="form-select item-select"
                    required>
                <option value="">Select item</option>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>"
                            data-price="<?php echo e($product->unit_price); ?>">
                        <?php echo e($product->name); ?> (<?php echo e(number_format($product->unit_price, 2)); ?>)
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <input type="number"
                   name="items[${itemIndex}][quantity]"
                   placeholder="Qty"
                   min="1"
                   class="form-control"
                   value="1"
                   required>

            <input type="number"
                   step="0.01"
                   name="items[${itemIndex}][unit_price]"
                   placeholder="Unit price"
                   class="form-control item-unit-price"
                   required>

            <div class="item-remove-wrap">
                <button type="button"
                        class="item-remove-btn"
                        onclick="removeItemRow(this)">
                    ✕
                </button>
            </div>
        `;

        wrapper.appendChild(row);
        itemIndex++;
        attachChangeListeners();
        attachSelectListeners();
        recalcSummary();
    }

    function removeItemRow(button) {
        const row = button.closest('.item-row');
        const wrapper = document.getElementById('items-wrapper');

        if (wrapper.children.length <= 1) {
            row.querySelectorAll('input').forEach(input => input.value = '');
            row.querySelectorAll('select').forEach(sel => sel.value = '');
            recalcSummary();
            return;
        }

        row.remove();
        recalcSummary();
    }

    function attachChangeListeners() {
        const wrapper = document.getElementById('items-wrapper');
        wrapper.querySelectorAll('input').forEach(input => {
            input.removeEventListener('input', recalcSummary);
            input.addEventListener('input', recalcSummary);
        });

        const taxField = document.querySelector('input[name="tax_rate"]');
        if (taxField) {
            taxField.removeEventListener('input', recalcSummary);
            taxField.addEventListener('input', recalcSummary);
        }
    }

    function attachSelectListeners() {
        const wrapper = document.getElementById('items-wrapper');

        wrapper.querySelectorAll('.item-select').forEach(select => {
            select.removeEventListener('change', handleItemSelectChange);
            select.addEventListener('change', handleItemSelectChange);
        });
    }

    function handleItemSelectChange(event) {
        const select = event.target;
        const row = select.closest('.item-row');
        const priceInput = row.querySelector('.item-unit-price');

        const selectedOption = select.options[select.selectedIndex];
        const price = selectedOption.getAttribute('data-price');

        if (price !== null && price !== undefined && price !== '') {
            // Always fill / override when item changes
            priceInput.value = parseFloat(price).toFixed(2);
            recalcSummary();
        }
    }

    function recalcSummary() {
        const wrapper = document.getElementById('items-wrapper');
        let subtotal = 0;

        wrapper.querySelectorAll('.item-row').forEach(row => {
            const qtyInput = row.querySelector('input[name*="[quantity]"]');
            const priceInput = row.querySelector('input[name*="[unit_price]"]');

            const qty = parseFloat(qtyInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;

            subtotal += qty * price;
        });

        const taxRateField = document.querySelector('input[name="tax_rate"]');
        const taxRate = taxRateField ? (parseFloat(taxRateField.value) || 0) : 0;

        const tax = subtotal * (taxRate / 100);
        const total = subtotal + tax;

        document.getElementById('summary-subtotal').textContent = subtotal.toFixed(2);
        document.getElementById('summary-tax').textContent = tax.toFixed(2);
        document.getElementById('summary-total').textContent = total.toFixed(2);
    }

    // Init
    attachChangeListeners();
    attachSelectListeners();
    recalcSummary();
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/invoices/create.blade.php ENDPATH**/ ?>