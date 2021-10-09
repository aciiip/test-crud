<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Repositories\OdbcRepository;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    private $odbc;

    public function __construct(OdbcRepository $odbc)
    {
        $this->odbc = $odbc;
    }

    public function index ()
    {
        $data['items'] = $this->odbc
            ->model(Item::class)
            ->orderBy('ID')
            ->limit(1, 100)
            ->build()
            ->orderBy('ID')
            ->get();
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
