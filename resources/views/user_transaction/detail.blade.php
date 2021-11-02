<div style="display: flex; justify-content: center">
    <div style="max-width: 1080px">
        <div style="text-align: center">
            <h2>RASUMI MEDIPHARMA SDN BHD</h2>
            <div>162-1, JALAN S2 B22, PUSAT DAGANGAN SEREMBAN 2</div>
            <div>70300 SEREMBAN 2, NEGERI SEMBILAN</div>
            <div>Tel: 06-602 0343</div>
            <div>pharmacy@rasumi.com.my</div>
        </div>
        <div style="text-align: center; margin-top: 30px;">
            <h1>TAX INVOICE</h1>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 30px;">
            <div>
                <table>
                    <tr>
                        <td>Patient IC</td>
                        <td>:</td>
                        <td>{{$transaction->patient->ICNo}}</td>
                    </tr>
                    <tr>
                        <td>DN No.</td>
                        <td>:</td>
                        <td>{{$transaction->DispensingNoteNo}}</td>
                    </tr>
                    <tr>
                        <td>Patient Name</td>
                        <td>:</td>
                        <td>{{$transaction->patient->Name}}</td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td>{{(new \Carbon\Carbon($transaction->invoice->InvoiceDate))->translatedFormat('d/m/Y')}}</td>
                    </tr>
                    <tr>
                        <td>GST No.</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Tax Invoice No.</td>
                        <td>:</td>
                        <td>{{$transaction->invoice->InvoiceNo}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <table style="width: 100%;" cellspacing="0" cellpadding="6">
                <thead style="background-color: lightgray;">
                <tr>
                    <th style="border: 1px solid black;">No.</th>
                    <th style="border: 1px solid black;">Item Description</th>
                    <th style="border: 1px solid black;">UOM</th>
                    <th style="border: 1px solid black;">GST Code</th>
                    <th style="border: 1px solid black;">Qty</th>
                    <th style="border: 1px solid black;">Unit Price (RM)</th>
                    <th style="border: 1px solid black;">Total Excl. GST (RM)</th>
                    <th style="border: 1px solid black;">Total GST (RM)</th>
                    <th style="border: 1px solid black;">Total Incl. GST (RM)</th>
                </tr>
                </thead>
                <tbody>
                @php($no = 1)
                @php($totalProviderTotalPrice = 0)
                @php($totalGSTAmount = 0)
                @php($totalTotalPrice = 0)
                @foreach($transaction->order->items AS $item)
                    <tr>
                        <td style="text-align: center; border-left: 1px solid black; border-right: 1px solid black;">
                            {{$no}}
                        </td>
                        <td style="text-align: left; border-left: 1px solid black; border-right: 1px solid black;">
                            {{$item->item->Description}}
                        </td>
                        <td style="text-align: center; border-left: 1px solid black; border-right: 1px solid black;">
                            {{$item->UOM}}
                        </td>
                        <td style="text-align: center; border-left: 1px solid black; border-right: 1px solid black;">
                            {{$item->GSTRate}}
                        </td>
                        <td style="text-align: center; border-left: 1px solid black; border-right: 1px solid black;">
                            {{$item->Quantity}}
                        </td>
                        <td style="text-align: right; border-left: 1px solid black; border-right: 1px solid black;">
                            {{number_format($item->ProviderPrice, 2)}}
                        </td>
                        <td style="text-align: right; border-left: 1px solid black; border-right: 1px solid black;">
                            {{number_format($item->ProviderTotalPrice, 2)}}
                        </td>
                        <td style="text-align: right; border-left: 1px solid black; border-right: 1px solid black;">
                            {{number_format($item->GSTAmount, 2)}}
                        </td>
                        <td style="text-align: right; border-left: 1px solid black; border-right: 1px solid black;">
                            {{number_format($item->TotalPrice, 2)}}
                        </td>
                    </tr>
                    @php($no++)
                    @php($totalProviderTotalPrice += $item->ProviderTotalPrice)
                    @php($totalGSTAmount += $item->GSTAmount)
                    @php($totalTotalPrice += $item->TotalPrice)
                @endforeach
                <tr>
                    <td style="text-align: right; border: 1px solid black" colspan="6">
                        <strong>TOTAL AMOUNT</strong>
                    </td>
                    <td style="text-align: right; border: 1px solid black">
                        {{number_format($totalProviderTotalPrice, 2)}}
                    </td>
                    <td style="text-align: right; border: 1px solid black">
                        {{number_format($totalGSTAmount, 2)}}
                    </td>
                    <td style="text-align: right; border: 1px solid black">
                        {{number_format($totalTotalPrice, 2)}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td colspan="2" style="text-align: right; border: 1px solid black;">
                        <strong>TOTAL PAYABLE<br/> INCL. GST</strong>
                    </td>
                    <td style="text-align: right; border: 1px solid black;">
                        {{number_format($totalTotalPrice, 2)}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>