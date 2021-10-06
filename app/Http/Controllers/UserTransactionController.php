<?php
namespace App\Http\Controllers;

use App\Models\UserTransaction;

class UserTransactionController extends Controller
{
    public function index ()
    {
        $start = 1;
        $end = 100;

        $transaction_ids = $this->getPrimaries((new UserTransaction())->getTable(), 'ID', $start, $end);
        $transactions = UserTransaction::whereIn('ID', $transaction_ids)->with(['patient', 'invoice', 'company'])->get();

        return view('user_transaction.index', [
            'transactions' => $transactions
        ]);
    }

    public function print($id)
    {
        $transaction = UserTransaction::where('ID', $id)->with(['patient', 'invoice', 'order.items.item'])->get();
        return view('user_transaction.print', [
            'transaction' => $transaction[0]
        ]);
    }
}