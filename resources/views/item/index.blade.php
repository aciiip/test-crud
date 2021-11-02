@extends('layouts.home')
@section('title', 'Item')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <div>
                    <h4>
                        List of ORX Items
                    </h4>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>MDCCode</th>
                            <th>Current Stock</th>
                            <th>Stock Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items AS $item)
                            <tr>
                                <td>{{$item['ID']}}</td>
                                <td>{{$item['Code']}}</td>
                                <td>{{$item['Description']}}</td>
                                <td>{{$item['MDCCode']}}</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm" href="{{route('create_purchase', $item['ID'])}}">Create Purchase</a>
                                    <a class="btn btn-outline-success btn-sm" href="{{route('item_edit', $item['ID'])}}">Edit</a>
                                    <a class="btn btn-outline-danger btn-delete btn-sm" href="#" data-id="{{$item['ID']}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="btn-confirm-delete" type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function () {
            const modal = new bootstrap.Modal($('#delete-modal'));
            let deleteId = null;
            $('.btn-delete').click(function (event) {
                event.preventDefault();
                deleteId = $(this).attr('data-id');
                modal.show();
            });
            $('#btn-confirm-delete').click(function () {
                modal.hide();
                window.location = '{{route('item_delete')}}/' + deleteId;
            });
        });
    </script>
@endsection
