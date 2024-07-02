@extends('layout')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center mt-2 mb-1">
        <h2 class="mb-0">Department List</h2>
    </div>
    <div class="card-body">
        <table id="employeeTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Abbreviation</th>
                    <th>Department Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataDepartment as $key => $item)
                <tr>
                    <td>{{ intval($key) + 1 }}</td>
                    <td>{{$item->abbreviation}}</td>
                    <td>{{$item->departmentName}}</td>
                </tr>                    
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection