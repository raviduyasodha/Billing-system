<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->paginate(10);

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'unit_price'  => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Item::create($data);

        return redirect()
            ->route('items.index')
            ->with('success', 'Item created.');
    }
}
