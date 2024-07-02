@extends('layout')

@section('content')
<div class="card" style="width: max-content">
    <div class="card-header d-flex justify-content-between align-items-center mt-2">
        <h3 class="mb-0">Employee Directory</h3>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addEmployeeModal">Add Employee</button>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table id="employeeTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Job Title</th>
                    <th>Hire Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic content will be loaded here -->
            </tbody>
        </table>
    </div>
</div>

@include('modals.addEmployee')
@include('modals.editEmployee')
@include('modals.showEmployee')
@include('modals.deleteEmployee')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#employeeTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 5,  
        lengthMenu: [5, 10, 25, 50, 100],
        ajax: '{{ route('employees.data') }}',  // URL untuk mengambil data dari server
        columns: [
            { data: 'firstName', name: 'firstName' },
            { data: 'lastName', name: 'lastName' },
            { data: 'email', name: 'email' },
            { data: 'department.departmentName', name: 'department.departmentName' },
            { data: 'jobTitle.jobTitleName', name: 'jobTitle.jobTitleName' },
            { data: 'hireDate', name: 'hireDate' },
            {
                data: 'id',
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-info show-btn" data-id="${data}" title="Show">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-warning edit-btn" data-id="${data}" data-toggle="modal" data-target="#editEmployeeModal" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete-btn" data-id="${data}" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                },
                orderable: false,
                searchable: false
            }
        ]
    });

    // Show Add Employee Modal
    $('#addEmployeeModal').on('show.bs.modal', function() {
        $('#addEmployeeForm')[0].reset();
        $('#addEmployeeForm').attr('action', '{{ route('employees.store') }}');
    });

    // Show Edit Employee Modal
    $('#employeeTable').on('click', '.edit-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/employees/' + id + '/edit',
            type: 'GET',
            success: function(employee) {
                // Populate modal fields with employee data
                $('#editEmployeeModal #editEmployeeForm').attr('action', '/employees/' + id);
                $('#editEmployeeModal #edit_firstName').val(employee.firstName);
                $('#editEmployeeModal #edit_lastName').val(employee.lastName);
                $('#editEmployeeModal #edit_nik').val(employee.NIK);
                $('#editEmployeeModal #edit_jobTitle').val(employee.jobTitleID);
                $('#editEmployeeModal input[name="gender"][value="' + employee.gender + '"]').prop('checked', true);
                $('#editEmployeeModal #edit_placeOfBirth').val(employee.placeOfBirth);
                $('#editEmployeeModal #edit_dateOfBirth').val(employee.dateOfBirth);
                $('#editEmployeeModal #edit_hireDate').val(employee.hireDate);
                $('#editEmployeeModal #edit_address').val(employee.address);
                $('#editEmployeeModal #edit_phone').val(employee.phone);
                $('#editEmployeeModal #edit_email').val(employee.email);
                $('#editEmployeeModal #edit_department').val(employee.department ? employee.department.id : '');
                $('#editEmployeeModal').modal('show');
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
    });

    // Show Employee
    $('#employeeTable').on('click', '.show-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/employees/' + id,
            type: 'GET',
            success: function(employee) {
                console.log(employee);  // Tambahkan ini untuk debugging
                $('#showFirstName').text(employee.firstName);
                $('#showLastName').text(employee.lastName);
                $('#showNIK').text(employee.NIK);
                $('#showEmail').text(employee.email);
                $('#showDepartment').text(employee.department ? employee.department.departmentName : 'N/A');
                $('#showJobTitle').text(employee.job_title ? employee.job_title.jobTitleName : 'N/A');
                $('#showGender').text(employee.gender === 'M' ? 'Male' : 'Female');
                $('#showPlaceOfBirth').text(employee.placeOfBirth);
                $('#showDateOfBirth').text(employee.dateOfBirth);
                $('#showHireDate').text(employee.hireDate);
                $('#showAddress').text(employee.address);
                $('#showPhone').text(employee.phone);
                $('#showEmployeeModal').modal('show');
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
    });

    // Update Employee
    $('#employeeTable').on('click', '.edit-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/employees/' + id + '/edit',
            type: 'GET',
            success: function(employee) {
                console.log(employee);
                // Populate modal fields with employee data
                $('#editEmployeeModal #editEmployeeForm').attr('action', '/employees/' + id);
                $('#editEmployeeModal #firstName').val(employee.firstName);
                $('#editEmployeeModal #lastName').val(employee.lastName);
                $('#editEmployeeModal #nik').val(employee.NIK);
                $('#editEmployeeModal #jobTitle').val(employee.jobTitleID);
                $('#editEmployeeModal input[name="gender"][value="' + employee.gender + '"]').prop('checked', true);
                $('#editEmployeeModal #placeOfBirth').val(employee.placeOfBirth);
                $('#editEmployeeModal #dateOfBirth').val(employee.dateOfBirth);
                $('#editEmployeeModal #hireDate').val(employee.hireDate);
                $('#editEmployeeModal #address').val(employee.address);
                $('#editEmployeeModal #phone').val(employee.phone);
                $('#editEmployeeModal #email').val(employee.email);
                $('#editEmployeeModal #department').val(employee.department ? employee.department.id : '');
                $('#editEmployeeModal').modal('show');
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
    });

    // Delete Employee
    $('#employeeTable').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#deleteEmployeeId').val(id);
        $('#deleteEmployeeModal').modal('show');
    });

    // Handle confirm delete action
    $('#confirmDelete').on('click', function() {
        var id = $('#deleteEmployeeId').val();
        $.ajax({
            url: '/employees/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#employeeTable').DataTable().ajax.reload();
                $('#deleteEmployeeModal').modal('hide');
            },
            error: function(xhr) {
                $('#deleteEmployeeModal').modal('hide');
                alert('Something went wrong!');
            }
        });
    });
});
</script>
@endsection
