@extends('layouts.home')
@section('title', 'Create Purchase')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <div>
                    <h4>
                        Create Purchase
                    </h4>
                </div>
                <hr/>
                <form action="{{route('insert_purchase')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="item_id" id="item_id" value="{{$item->ID}}">
                    <table class="table table-borderless">
                        <tr>
                            <td>PO Number</td>
                            <td>:</td>
                            <td>
                                <input class="form-control" name="reference_no" id="reference_no" placeholder="PO Number" required autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <td>Item</td>
                            <td>:</td>
                            <td>
                                <input class="form-control" readonly value="{{$item->Description}}" />
                            </td>
                        </tr>
                        <tr>
                            <td>Unit Price</td>
                            <td>:</td>
                            <td>
                                <input class="form-control" name="unit_price" id="unit_price" readonly value="{{$item->price->Amount}}" />
                            </td>
                        </tr>
                        <tr>
                            <td>Purchase UOM</td>
                            <td>:</td>
                            <td>
                                <input class="form-control" readonly value="{{$item->purchase_uom->Code}}" />
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>:</td>
                            <td>
                                <input class="form-control" name="quantity" id="quantity" placeholder="Quantity" required autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <td>Total Price</td>
                            <td>:</td>
                            <td>
                                <input class="form-control" id="total_price" readonly value="0" />
                            </td>
                        </tr>
                        {{--
                        <tr>
                            <td>Sales Person</td>
                            <td>:</td>
                            <td>
                                <select class="form-select">
                                    <option>asdjfhds</option>
                                </select>
                            </td>
                        </tr>
                        --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-end">
                                <button class="btn btn-primary mt-2" type="submit">Save</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function () {
            $('#quantity').keyup(function () {
                const quantity = parseInt($(this).val());
                const price = parseFloat($('#unit_price').val());
                let total = price * quantity;
                if (isNaN(total)) {
                    total = 0;
                }
                $('#total_price').val(total);
            });
        });
    </script>
@endsection