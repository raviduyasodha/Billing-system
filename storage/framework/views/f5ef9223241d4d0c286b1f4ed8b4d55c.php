<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Billing System'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --bg: #0f172a;
            --card-bg: #0b1120;
            --card-inner: #020617;
            --accent: #6366f1;
            --accent-soft: rgba(99,102,241,0.15);
            --accent-border: rgba(129,140,248,0.5);
            --text-main: #e5e7eb;
            --text-muted: #9ca3af;
            --border-soft: rgba(148,163,184,0.4);
            --danger: #ef4444;
            --success: #22c55e;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #1f2937 0, #020617 50%, #000 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .app-shell {
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px 16px 40px;
            width: 100%;
        }

        .app-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .app-title {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .app-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .app-nav {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s ease, border-color 0.15s ease, transform 0.08s ease;
            background: var(--accent-soft);
            border-color: var(--accent-border);
            color: var(--text-main);
        }

        .btn:hover {
            transform: translateY(-1px);
            background: rgba(99,102,241,0.25);
        }

        .btn-secondary {
            background: transparent;
            border-color: var(--border-soft);
            color: var(--text-muted);
        }

        .btn-secondary:hover {
            border-color: var(--accent-border);
            color: var(--text-main);
        }

        .btn-danger {
            background: rgba(248,113,113,0.08);
            border-color: rgba(248,113,113,0.5);
            color: #fecaca;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .badge-draft {
            background: rgba(148,163,184,0.12);
            color: #e5e7eb;
        }

        .badge-sent {
            background: rgba(59,130,246,0.12);
            color: #bfdbfe;
        }

        .badge-paid {
            background: rgba(34,197,94,0.12);
            color: #bbf7d0;
        }

        .badge-overdue {
            background: rgba(248,113,113,0.12);
            color: #fecaca;
        }

        .card {
            background: radial-gradient(circle at top left, #111827 0, #020617 60%);
            border-radius: 16px;
            border: 1px solid rgba(148,163,184,0.3);
            box-shadow:
                0 18px 40px rgba(0,0,0,0.7),
                0 0 0 1px rgba(15,23,42,0.95);
            padding: 18px 18px 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .card-subtitle {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .card-body {
            margin-top: 6px;
        }

        .alert {
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 0.85rem;
            margin-bottom: 12px;
        }

        .alert-success {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.4);
            color: #bbf7d0;
        }

        .alert-error {
            background: rgba(248,113,113,0.12);
            border: 1px solid rgba(248,113,113,0.5);
            color: #fecaca;
        }

        .alert-error ul {
            margin: 4px 0 0;
            padding-left: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
            gap: 12px 18px;
            margin-bottom: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .form-label {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid var(--border-soft);
            background: rgba(15,23,42,0.85);
            padding: 8px 10px;
            font-size: 0.85rem;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-border);
            box-shadow: 0 0 0 1px rgba(129,140,248,0.5);
            background: rgba(15,23,42,1);
        }

        .items-card {
            margin-top: 12px;
            border-radius: 14px;
            border: 1px solid rgba(31,41,55,1);
            background: linear-gradient(135deg, #020617 0, #020617 40%, #030712 100%);
            padding: 10px 10px 6px;
        }

        .items-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .items-title {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .items-rows {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .item-row {
            display: grid;
            grid-template-columns: 1fr 0.5fr 0.6fr auto;
            gap: 6px;
            align-items: center;
            padding: 6px 8px;
            border-radius: 10px;
            background: radial-gradient(circle at top left, rgba(30,64,175,0.24) 0, rgba(15,23,42,0.85) 55%);
            border: 1px solid rgba(30,64,175,0.5);
        }

        .item-row:nth-child(odd) {
            background: radial-gradient(circle at top left, rgba(99,102,241,0.23) 0, rgba(15,23,42,0.9) 60%);
        }

        .item-row input {
            width: 100%;
        }

        .item-remove-btn {
            background: transparent;
            border: none;
            color: #fecaca;
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0 4px;
        }

        .item-remove-btn:hover {
            color: #fee2e2;
        }

        .items-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .items-footer .btn {
            font-size: 0.8rem;
            padding: 6px 10px;
        }

        .summary {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(31,41,55,1);
            background: radial-gradient(circle at top right, rgba(6,95,70,0.2) 0, #020617 60%);
            font-size: 0.82rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .summary-label {
            color: var(--text-muted);
        }

        .summary-value {
            font-weight: 500;
        }

        .summary-total .summary-value {
            font-size: 1rem;
            color: #bbf7d0;
        }

        .form-actions {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        /* table for index */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .table thead {
            background: rgba(15,23,42,0.9);
        }

        .table th,
        .table td {
            padding: 8px 10px;
            border-bottom: 1px solid rgba(31,41,55,0.9);
            text-align: left;
        }

        .table th {
            font-weight: 500;
            color: var(--text-muted);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table tr:hover td {
            background: rgba(15,23,42,0.85);
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        @media (max-width: 720px) {
            .app-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .item-row {
                grid-template-columns: 1fr 0.6fr 0.7fr;
                grid-template-rows: auto auto;
                grid-auto-flow: row;
            }

            .item-row .item-remove-wrap {
                grid-column: 1 / -1;
                text-align: right;
            }
        }
    </style>

    <?php echo $__env->yieldContent('head'); ?>
</head>
<body>
<div class="app-shell">
    <header class="app-header">
        <div>
            <div class="app-title">Billing System</div>
            <div class="app-subtitle">Easy Billing for future</div>
        </div>
        <nav class="app-nav">
            <a href="<?php echo e(route('dashboard')); ?>" class="btn-secondary btn">Dashboard</a>
            <a href="<?php echo e(route('invoices.index')); ?>" class="btn-secondary btn">Invoices</a>
            <a href="<?php echo e(route('customers.index')); ?>" class="btn">Customers</a>
            <a href="<?php echo e(route('items.index')); ?>" class="btn-secondary btn">Items</a>
        </nav>
    </header>

    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html>
<?php /**PATH C:\Users\user\OneDrive\Desktop\laravel\billing-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>