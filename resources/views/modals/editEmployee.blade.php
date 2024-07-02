<!-- Modal for Edit Employee -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" maxlength="20" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" maxlength="20" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" name="NIK" id="nik" maxlength="6" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="departmentID" required>
                                <option value="" hidden>Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->departmentName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="jobTitle">Job Title</label>
                            <option value="" hidden>Select Job</option>
                            <select class="form-control" id="jobTitle" name="jobTitleID" required>
                                @foreach ($jobTitles as $jobTitle)
                                    <option value="{{ $jobTitle->id }}">{{ $jobTitle->jobTitleName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="M" required>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="F" required>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="placeOfBirth">Place of Birth</label>
                            <input type="text" class="form-control" name="placeOfBirth" id="placeOfBirth" maxlength="100" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" class="form-control" name="dateOfBirth" id="dateOfBirth" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hireDate">Hire Date</label>
                            <input type="date" class="form-control" name="hireDate" id="hireDate" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" name="phone" id="phone" maxlength="20" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>