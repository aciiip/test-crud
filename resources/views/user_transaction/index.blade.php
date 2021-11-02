@extends('layouts.home')
@section('title', 'Transaction')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>
                        List of ORX Transaction
                    </h4>
                    <div>
                        <form>
                            <div class="input-group">
                                <input autocomplete="off" value="{{$dn_no}}" type="text" name="dn_no" placeholder="Dispensing Note No." class="form-control" />
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th nowrap>GL No. / AC Code</th>
                            <th nowrap>Prescription No.</th>
                            <th nowrap>Patient Name</th>
                            <th nowrap>IC Number</th>
                            <th nowrap>Corporate Client</th>
                            <th nowrap>Total Item</th>
                            <th nowrap>Total Price (RM)</th>
                            <th nowrap>Invoice</th>
                            <th nowrap>Print</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( count($transactions) > 0 )
                            @foreach($transactions AS $transaction)
                                @php($totalItem = 0)
                                @php($totalPrice = 0)
                                @if ($transaction->order && $transaction->order->items)
                                    @php($totalItem = count($transaction->order->items))
                                    @foreach($transaction->order->items AS $item)
                                        @php($totalPrice += $item->TotalPrice)
                                    @endforeach
                                @endif
                                <tr>
                                    <td>{{$transaction->GLNo}}</td>
                                    <td>{{$transaction->PrescriptionNo}}</td>
                                    <td>{{$transaction->patient->Name}}</td>
                                    <td>{{$transaction->patient->ICNo}}</td>
                                    <td>{{$transaction->company->Name}}</td>
                                    <td class="text-center">{{$totalItem}}</td>
                                    <td class="text-end">{{number_format($totalPrice, 2)}}</td>
                                    <td class="text-center">
                                        <a href="{{route('detail_transaction', $transaction->ID)}}" class="text-black" target="_blank">
                                            <i class="fas fa-file-invoice"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('print_transaction', $transaction->ID)}}" class="text-black">
                                            <i class="fas fa-file-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">No Data</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection