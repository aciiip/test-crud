@extends('layouts.main')
@section('content')
    <div>
        <div style="display: flex; justify-content: end;">
            <a href="{{route('create')}}">
                Create
            </a>
        </div>
        <div style="margin-top: 20px;">
            <table border="1" style="width: 100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td align="center">
                        <a href="{{route('edit', 1)}}">Edit</a> |
                        <a href="{{route('delete', 1)}}">Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
