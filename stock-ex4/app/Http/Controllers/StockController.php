<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Events\StockUpdated;

class StockController extends Controller
{
    public function index(){
$stocks=Stock::all();
return view('stocks',compact('stocks'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $stock = Stock::create([
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
        ]);

        broadcast(new StockUpdated($stock))->toOthers();

        //return response()->json(['message' => 'Produit ajouté avec succès', 'stock' => $stock]);

        return redirect()->back();

    }
    public function update(Request $request,$id){
        $stocks=Stock::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $stocks=Stock::update($validated);
        broadcast(new StockUpdated($stock))->toOthers();

        return response()->json(['message' => 'Produit mis à jour avec succès', 'stock' => $stock]);
    }
    public function destroy($id)
    {
        $stock=Stock::findOrFail($id);
        $stock->delete();
        broadcast(new StockUpdated($stock))->toOthers();
       // return response()->json(['message' => 'Produit supprimé avec succès', 'stock' => $stock]);

       return redirect()->back();
        
    }

}
