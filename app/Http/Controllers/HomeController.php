<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index ()
    {
        return DB::connection('odbc')->table('TEST_CRUD')->get();
        return view('home');
    }

    public function create ()
    {
        return view('form');
    }

    public function edit ($id)
    {
        return view('form');
    }

    public function destroy ($id)
    {
        return 'delete';
    }
}
