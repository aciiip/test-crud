@extends('layouts.home')
@section('title', 'Item')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <div>
                    <h4>
                        List of ORX Inventory
                    </h4>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Transaction Type</th>
                            <th>Date</th>
                            <th>Reference No.</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="7" class="text-center">No Data</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection