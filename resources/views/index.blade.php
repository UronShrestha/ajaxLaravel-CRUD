<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <!-- Bootstrap Icon CSS -->
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <!-- Datatables  CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

    <title>Hello, world!</title>
</head>

<body>

    {{-- add new employee modal start --}}
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="fname">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name"
                                    required>
                            </div>

                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter E-mail"
                                required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone"
                                required>
                        </div>
                        <div class="my-2">
                            <label for="post">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                required>
                        </div>
                        <div class="my-2">
                            <label for="post">Position</label>
                            <input type="text" name="position" class="form-control" placeholder="Enter Postion"
                                required>
                        </div>
                        <div class="my-2">
                            <label for="avatar">Select Avatar</label>
                            <input type="file" name="avatar" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new employee modal end --}}

    {{-- edit employee modal start --}}
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="update_employee_form" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="id" class="form-control" required>


                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="fname">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Name" required>
                            </div>

                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter E-mail" required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control"
                                placeholder="Enter Phone" required>
                        </div>
                        <div class="my-2">
                            <label for="post">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                placeholder="Enter Address" required>
                        </div>
                        <div class="my-2">
                            <label for="post">Position</label>
                            <input type="text" name="position" id="post" class="form-control"
                                placeholder="Enter Postion" required>
                        </div>
                        <div class="my-2">
                            <label for="avatar">Select Avatar</label>
                            <input type="file" name="avatar" id="avatar" class="form-control" required>
                        </div>
                        <div class="t-2" id="avatar"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="update_employee_btn" class="btn btn-primary">Update
                            Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit employee modal end --}}

    <body class="bg-light">
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                            <h3 class="text-light">Manage Employees</h3>
                            <button class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#addEmployeeModal"><i class="bi-plus-circle me-2"></i>Add New
                                Employee</button>
                        </div>
                        <div class="card-body" id="show_all_employees">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jquery  -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
        <!-- Datatables  JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
        <!-- sweetalert2@11  JS -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script>
            //add new employees ajax request
            $("#add_employeee_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_employee_btn").text("Adding...");
                $.ajax({
                    url: "{{ route('store') }}",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(res) {
                          console.log(res); // Handle successful response
                            // Reset form or update UI as needed
                            $("#add_employee_btn").text("Add Employee");
                    }
                });
            })
        </script> --}}

        {{-- <script>
            $(document).ready(function() {

                //fetch all employees using ajax request
                fetchAllEmployees();

                function fetchAllEmployees() {
                    $.ajax({
                        url: "{{ route('fetchAll') }}",
                        method: 'get',
                        success: function(res) {
                            console.log(res);
                        }
                    });
                }
                // Add new employees AJAX request
                $("#add_employee_form").submit(function(e) {
                    e.preventDefault();

                    // Create FormData object
                    const fd = new FormData(this);

                    // Change button text to indicate processing
                    $("#add_employee_btn").text("Adding...");

                    $.ajax({
                        url: "{{ route('store') }}", // Ensure this is the correct route
                        method: 'POST',
                        data: fd,
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    title: 'Added!',
                                    text: 'Employee added successfully',
                                    icon: 'success'
                                });
                                $('#add_employee_btn').text('Add Employee');
                                $('#add_employee_form')[0].reset();
                                $('#addEmployeeModal').modal('hide');
                            }
                        },
                    });
                });
            });
        </script> --}}

        <script>
            $(document).ready(function() {
                // Fetch all employees
                fetchAllEmployees();

                function fetchAllEmployees() {
                    $.ajax({
                        url: '{{ route('fetchAll') }}',
                        method: 'GET',
                        success: function(res) {
                            $("#show_all_employees").html(res);
                            $("#table").DataTable({
                                order: [0, 'asc']
                            });
                        }
                    });
                }



                // Add new employee AJAX request
                $("#add_employee_form").submit(function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("#add_employee_btn").text("Adding...");
                    $.ajax({
                        url: "{{ route('store') }}",
                        method: 'POST',
                        data: fd,
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    title: 'Added!',
                                    text: 'Employee added successfully',
                                    icon: 'success'
                                });
                                $('#add_employee_btn').text('Add Employee');
                                $('#add_employee_form')[0].reset();
                                $('#addEmployeeModal').modal('hide');
                                fetchAllEmployees();
                            }
                        },
                    });
                });

                // Edit employee ajax request
                $(document).on('click', '.editIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('edit', ['id' => '__id__']) }}'.replace('__id__', id),
                        method: 'GET',
                        success: function(res) {
                            $("#id").val(res.id);
                            $("#name").val(res.name);
                            $("#email").val(res.email);
                            $("#phone").val(res.phone);
                            $("#address").val(res.address);
                            $("#post").val(res.position);
                            $("#avatar").html(
                                `<img src="storage/images/${res.avatar}" width="100" class="img-fluid img-thumbnail">`
                            );
                            $('#editEmployeeModal').modal('show');
                        }
                    });
                });


                // Update employee ajax request
                $(document).on('submit', '#update_employee_form', function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("update_employee_btn").text('Updating...');
                    $.ajax({
                        url: '{{ route('update') }}',
                        method: 'POST',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            // console.log(res);
                            fetchAllEmployees();
                            $('#editEmployeeModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Employee Updated Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });

                // Delete employee ajax request
                $(document).on('click', '.deleteIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('delete') }}',
                                method: 'POST',
                                data: {
                                    id: id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(res) {
                                    fetchAllEmployees();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Employee Deleted Successfully',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                        }
                    });
                });



            });
        </script>

    </body>

</html>
