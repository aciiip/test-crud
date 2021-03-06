<?php
namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\UserTransaction;
use App\Repositories\OdbcRepository;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{

    private $odbc;

    public function __construct(OdbcRepository $odbcRepository)
    {
        $this->odbc = $odbcRepository;
    }

    public function index (Request $request)
    {
        $dnNo = $request->get('dn_no');
        $transactions = $this->odbc->model(UserTransaction::class);
        if ($dnNo) {
            $transactions = $transactions->where('DispensingNoteNo', '%'.$dnNo.'%', 'LIKE');
        } else {
            $transactions = $transactions->where('Status', 'PS');
        }
        $transactions = $transactions
            ->where('PrescriptionNo', null, '!=')
            ->orderBy('CreatedDate', 'DESC')
            ->limit(1, 100)
            ->build()
            ->with(['patient', 'invoice', 'company', 'order.items'])
            ->orderBy('CreatedDate', 'DESC')
            ->get();

        return view('user_transaction.index', [
            'transactions' => $transactions,
            'dn_no' => $dnNo
        ]);
    }

    public function detail($id)
    {
        $transaction = UserTransaction::where('ID', $id)->with(['patient', 'invoice', 'order.items.item'])->get();
        return view('user_transaction.detail', [
            'transaction' => $transaction[0]
        ]);
    }

    public function print($id)
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
                'duration' => $item->duration->Code,
                'quantity' => $item->Quantity,
                'prescription_instruction' => $item->DoseQuantity.' '.$item->UOM.' '.$item->instruction->Description.' '.$item->frequency->Description
            ];
        }

        return view('user_transaction.print', [
            'patient_name' => $transaction->patient->Name,
            'order_date' => $transaction->order->OrderDate,
            'dispensing_note_no' => $transaction->DispensingNoteNo,
            'labels' => $data,
        ]);
    }

    public function printConfirm (Request $request)
    {
        $posts = $request->get('data');
        $data = [];
        foreach ($posts AS $post) {
            $temp = $post;
            $temp['created_at'] = now();
            $temp['updated_at'] = now();
            $data[] = $temp;
        }
        return Label::insert($data);
    }
}