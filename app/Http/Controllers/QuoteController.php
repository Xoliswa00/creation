<?php

namespace App\Http\Controllers;

use App\Models\quote;
use App\Http\Requests\StorequoteRequest;
use App\Http\Requests\UpdatequoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $quotes = auth()->user()->currentCompany->quotes()->latest()->get();
        return response()->json($quotes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $quote = DB::transaction(function() use ($validated) {
            $quote = auth()->user()->currentCompany->quotes()->create([
                'client_id' => $validated['client_id'],
                'quote_number' => 'Q-' . Str::upper(Str::random(6)),
                'status' => 'draft',
                'total' => 0,
            ]);

            $total = 0;
            foreach ($validated['items'] as $item) {
                $product = auth()->user()->currentCompany->products()->findOrFail($item['product_id']);
                $vat = $product->price * ($product->vat_rate / 100);
                $lineTotal = ($product->price + $vat) * $item['quantity'];
                $total += $lineTotal;

                $quote->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'vat_amount' => $vat,
                    'total' => $lineTotal,
                ]);
            }

            $quote->update(['total' => $total]);
            return $quote;
        });

        return response()->json($quote, 201);
    }
}
