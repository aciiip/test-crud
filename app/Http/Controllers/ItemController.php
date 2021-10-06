<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index ()
    {
        $ids = $this->getPrimaries((new Item())->getTable(), 'ID', 1, 100);
        $data['items'] = Item::whereIn('ID', $ids)->orderBy('ID')->get();
        return view('item.index', $data);
    }

    public function edit ($id)
    {
        $items = Item::where('ID', $id)->get();
        if (!$items) {
            return redirect(route('home'));
        }

        $data['item'] = $items[0];
        $data['action'] = route('item_action', $id);
        return view('item.form', $data);
    }

    public function formAction (Request $request, $id = null)
    {
        $post = $request->all();
        if ($id) {
            $this->editItem($id, $post);
        }
        return redirect(route('home'));
    }

    private function editItem ($id, $post)
    {
        unset($post['_token']);
        Item::where('ID', $id)->update($post);
    }

    public function destroy ($id)
    {
        // Item::where('ID', $id)->delete();
        return redirect(route('home'));
    }
}
