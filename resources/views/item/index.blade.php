@extends('layouts.home')
@section('content')
    <div class="container-fluid">
        <div class="table-responsive" style="margin-top: 20px;">
            <table class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>MDCCode</th>
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
                        <td align="center">
                            <a href="{{route('edit', $item['ID'])}}">Edit</a> |
                            <a href="#" class="btn-delete" data-id="{{$item['ID']}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                window.location = '{{route('delete')}}/' + deleteId;
            });
        });
    </script>
@endsection
