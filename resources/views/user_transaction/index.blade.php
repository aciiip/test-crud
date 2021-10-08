@extends('layouts.home')
@section('title', 'Transaction')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <div>
                    <h4>
                        List of ORX Transaction
                    </h4>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>GL No. / AC Code</th>
                            <th>Prescription No.</th>
                            <th>Patient Name</th>
                            <th>IC Number</th>
                            <th>Corporate Client</th>
                            <th>Invoice</th>
                            <th>Print</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions AS $transaction)
                            <tr>
                                <td>{{$transaction->GLNo}}</td>
                                <td>{{$transaction->PrescriptionNo}}</td>
                                <td>{{$transaction->patient->Name}}</td>
                                <td>{{$transaction->patient->ICNo}}</td>
                                <td>{{$transaction->company->Name}}</td>
                                <td class="text-center">
                                    <a href="{{route('print_transaction', $transaction->ID)}}" class="text-black" target="_blank">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('user_transaction_download', $transaction->ID)}}" class="text-black">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection