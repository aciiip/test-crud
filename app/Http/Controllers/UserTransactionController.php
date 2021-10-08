<?php
namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\UserTransaction;
use App\Repositories\OdbcRepository;

class UserTransactionController extends Controller
{

    private $odbc;

    public function __construct(OdbcRepository $odbcRepository)
    {
        $this->odbc = $odbcRepository;
    }

    public function index ()
    {
        $transactions = $this->odbc
            ->model(UserTransaction::class)
            ->where('Status', null, '!=')
            ->where('Status', 'PN', '!=')
            ->where('PrescriptionNo', null, '!=')
            ->orderBy('CreatedDate', 'DESC')
            ->limit(1, 50)
            ->build()
            ->with(['patient', 'invoice', 'company'])
            ->orderBy('CreatedDate', 'DESC')
            ->get();

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

    public function download($id)
    {
        $transactions = UserTransaction::where('ID', $id)->with([
            'patient',
            'invoice',
            'order.items.item',
            'order.items.instruction',
            'order.items.frequency',
            'order.items.duration',
        ])->get();
        $transaction = $transactions[0];
        $data = [];
        foreach ($transaction->order->items AS $item) {
            $data[] = [
                'item_description' => $item->item->Description,
                'patient_name' => $transaction->patient->Name,
                'order_date' => $transaction->order->OrderDate,
                'dispensing_note_no' => $transaction->DispensingNoteNo,
                'dose_quantity' => $item->DoseQuantity,
                'uom_dosage_code' => $item->UOM,
                'instruction' => $item->instruction->Description,
                'frequency' => $item->frequency->Description,
                'duration' => $item->duration->Description,
                'quantity' => $item->Quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Label::insert($data);
        return redirect()->route('user_transaction');
    }
}