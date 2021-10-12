<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemTransaction;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function create ($itemId)
    {
        $items = Item::where('ID', $itemId)->with(['purchase_uom', 'price'])->get();
        return view('purchase.create', [
            'item' => $items[0]
        ]);
    }

    public function insert (Request $request)
    {
        $post = $request->all();
        unset($post['_token']);
        $post['transaction_type'] = 'purchase';
        $post['date'] = now();
        $post['created_at'] = now();
        $post['updated_at'] = now();
        ItemTransaction::insert($post);
        return redirect()->route('item');
    }

}