@extends('layouts.home')
@section('title', 'Transaction')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>
                        Transaction
                    </h4>
                    <div>
                        <button class="btn btn-primary" id="btn-print">
                            <span id="btn-print-loader" class="spinner-border spinner-border-sm d-none"></span>
                            <i class="fa fa-check d-none" id="btn-print-success"></i>
                            <span id="btn-print-text">Print</span>
                        </button>
                    </div>
                </div>
                <hr />
                <div>
                    <table class="table table-borderless">
                        <tr>
                            <td>Dispensing Note No.</td>
                            <td>:</td>
                            <td>{{$dispensing_note_no}}</td>
                        </tr>
                        <tr>
                            <td>Patient Name</td>
                            <td>:</td>
                            <td>{{$patient_name}}</td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>:</td>
                            <td>{{$order_date}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>
                        Transaction Item
                    </h4>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th nowrap>No</th>
                            <th nowrap>Description</th>
                            <th nowrap>Duration</th>
                            <th nowrap>Quantity</th>
                            <th nowrap>Instruction</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no = 1)
                        @foreach($labels AS $index => $label)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$label['item_description']}}</td>
                                <td>{{$label['duration']}}</td>
                                <td class="text-end">{{$label['quantity']}}</td>
                                <td class="d-flex justify-content-between gap-3">
                                    <span id="prescription-instruction-{{$index}}">
                                        {{$label['prescription_instruction']}}
                                    </span>
                                    <a
                                        href="#"
                                        class="edit_instruction"
                                        data-index="{{$index}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @php($no++)
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="instruction-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instruction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modal-instruction-index">
                    <input type="text" class="form-control" id="modal-instruction-instruction">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="modal-instruction-save">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Toast -->
    <div
        style="z-index: 2; top: 70px; right: 10px;"
        class="toast align-items-center text-white bg-danger border-0 position-fixed"
        id="toast-error"
        role="alert"
        aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Failed to print transaction
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function () {
            let data = [];

            @foreach($labels AS $index => $label)
                data[{{$index}}] = {
                    patient_name: "{{$patient_name}}",
                    order_date: "{{$order_date}}",
                    dispensing_note_no: "{{$dispensing_note_no}}",
                    item_description: '{{$label['item_description']}}',
                    duration: "{{$label['duration']}}",
                    quantity: "{{$label['quantity']}}",
                    prescription_instruction: "{{$label['prescription_instruction']}}",
                };
            @endforeach

            const modal = new bootstrap.Modal($('#instruction-modal'));
            document.getElementById('instruction-modal').addEventListener('shown.bs.modal', function () {
                $('#modal-instruction-instruction').focus();
            });

            $('.edit_instruction').click(function (e) {
                e.preventDefault();
                const index = $(this).data('index');
                const instruction = $('#prescription-instruction-' + index).text().trim();
                modal.show();
                $('#modal-instruction-index').val(index);
                $('#modal-instruction-instruction').val(instruction);
            });

            $('#modal-instruction-save').click(function () {
                const index = $('#modal-instruction-index').val();
                const instruction = $('#modal-instruction-instruction').val();
                data[index].prescription_instruction = instruction;
                $('#prescription-instruction-' + index).text(instruction);
                modal.hide();
            });

            const toast = new bootstrap.Toast($('#toast-error'));

            $('#btn-print').click(function () {
                $('#btn-print').attr('disabled', 'disabled');
                $('#btn-print-loader').removeClass('d-none');
                $('#btn-print-text').addClass('d-none');
                $.post('{{route('print_confirm_transaction')}}', {
                    "_token": "{{ csrf_token() }}",
                    'data': data
                }).then(response => {
                    if (response === '1') {
                        $('#btn-print-loader').addClass('d-none');
                        $('#btn-print-success').removeClass('d-none');
                        window.location.href = '{{route('user_transaction')}}';
                    } else {
                        $('#btn-print').removeAttr('disabled');
                        $('#btn-print-text').removeClass('d-none');
                        $('#btn-print-success').addClass('d-none');
                        $('#btn-print-loader').addClass('d-none');
                    }
                }).catch(() => {
                    toast.show();
                    $('#btn-print').removeAttr('disabled');
                    $('#btn-print-text').removeClass('d-none');
                    $('#btn-print-success').addClass('d-none');
                    $('#btn-print-loader').addClass('d-none');
                });
            });
        })
    </script>
@endsection