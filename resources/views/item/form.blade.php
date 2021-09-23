@extends('layouts.home')
@section('content')
    <div class="container-fluid">
        <div class="card p-4 mt-2">
            <form action="{{$action}}" method="post">
                {{ csrf_field() }}
                <table class="table table-borderless">
                    <tr>
                        <td>Code</td>
                        <td>:</td>
                        <td>
                            <input class="form-control" name="Code" placeholder="Code" value="{{$item['Code'] ?? ''}}" />
                        </td>
                    </tr>
                    <tr>
                        <td>GenericName</td>
                        <td>:</td>
                        <td>
                            <input class="form-control" name="GenericName" placeholder="GenericName" value="{{$item['GenericName'] ?? ''}}" />
                        </td>
                    </tr>
                    <tr>
                        <td>MDCCode</td>
                        <td>:</td>
                        <td>
                            <input class="form-control" name="MDCCode" placeholder="MDCCode" value="{{$item['MDCCode'] ?? ''}}" />
                        </td>
                    </tr>
                    <tr>
                        <td>PBM</td>
                        <td>:</td>
                        <td>
                            <input class="form-control" name="PBM" placeholder="PBM" value="{{$item['PBM'] ?? ''}}" />
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>:</td>
                        <td>
                            <textarea class="form-control" name="Description" placeholder="Description">{{$item['Description'] ?? ''}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
