<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Item;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

   public function create()
{
    $customers = Customer::all();
    $items = Item::all();

    return view('invoices.create', compact('customers', 'items'));
}
   public function store(Request $request)
{
    $data = $request->validate([
        'customer_id'          => 'required|exists:customers,id',
        'invoice_date'         => 'required|date',
        'due_date'             => 'nullable|date',
        'items.*.item_id'      => 'required|exists:items,id',
        'items.*.quantity'     => 'required|integer|min:1',
        'items.*.unit_price'   => 'required|numeric|min:0',
        'tax_rate'             => 'nullable|numeric|min:0',
    ]);

    $itemsData = $data['items'];
    unset($data['items']);

    // ✅ NO & HERE
    $subtotal = 0;
    foreach ($itemsData as $itemData) {
        $qty   = $itemData['quantity'];
        $price = $itemData['unit_price'];
        $subtotal += $qty * $price;
    }

    $taxRate = $request->input('tax_rate', 0);  // e.g. 10 for 10%
    $tax     = $subtotal * ($taxRate / 100);
    $total   = $subtotal + $tax;

    $invoice = Invoice::create([
        'customer_id'    => $data['customer_id'],
        'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
        'invoice_date'   => $data['invoice_date'],
        'due_date'       => $data['due_date'] ?? null,
        'subtotal'       => $subtotal,
        'tax'            => $tax,
        'total'          => $total,
        'status'         => 'draft',
    ]);

    foreach ($itemsData as $itemData) {
        $itemModel = Item::find($itemData['item_id']);

        InvoiceItem::create([
            'invoice_id'  => $invoice->id,
            'description' => $itemModel ? $itemModel->name : 'Item',
            'quantity'    => $itemData['quantity'],
            'unit_price'  => $itemData['unit_price'],
            'line_total'  => $itemData['quantity'] * $itemData['unit_price'],
        ]);
    }

    return redirect()
        ->route('invoices.show', $invoice)
        ->with('success', 'Invoice created.');
}

    public function show(Invoice $invoice)
    {
        $invoice->load('customer', 'items');
        return view('invoices.show', compact('invoice'));
    }
    public function getItemPrice(Request $request)
{
    $description = $request->query('description');

    if (!$description) {
        return response()->json(['price' => null]);
    }

    // Find the most recent item with this description
    $item = InvoiceItem::where('description', $description)
        ->orderByDesc('id')
        ->first();

    return response()->json([
        'price' => $item ? $item->unit_price : null,
    ]);
}

}
