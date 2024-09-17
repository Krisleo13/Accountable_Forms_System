@extends('Layouts.app')

@section('sub_header')
   <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('Users.subheader')
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Users</h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-primary">
                            <h2 class="text-primary"> Create </h2>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-row-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-header align-items-center flex-wrap py-5 h-auto">
                                <h1 class="text-success"> <i class="flaticon-file-2 icon-2x text-success"></i>Users List
                                </h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <table
                                         class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                                        style="text-align: center" id="class_list">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Update User details Modal --}}
    <div class="modal fade" id="Update_Details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">User Info <i
                            class="flaticon-avatar icon-lg text-success"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">

                    <form onsubmit="UpdateUser(event)" method="post">
                        @csrf
                        <!--begin::Body-->
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Name</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Position</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" name="position" id="position" required>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Branch</label>
                            </div>
                            <div class="col-8">
                                <select name="branch" class="custom-select form-control" id="branch" required>
                                    <option value="">Select Department</option>
                                    @foreach ($department->GetDeparment() as $res)
                                        <option value="{{ $res->id }}">{{ $res->BranchName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Email</label>
                            </div>
                            <div class="col-8">
                                <input type="email" name="email" id="email" class="form-control" required />
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Password</label>
                            </div>
                            <div class="col-8">
                                <input type="password" name="password" class="form-control" />
                            </div>
                        </div>
                        <hr>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Active</label>
                            </div>
                            <div class="col-8">
                                <select name="active" class="custom-select form-control" id="active" required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        {{-- end::Body --}}
                        <input type="hidden" name="uid" id="uid" />
                        <div class="row my-5">
                            <div class="col-5">
                            </div>
                            <div class="col-3">
                                <input type="submit" name="submit" value="Update" class="btn btn-light-success" />
                            </div>
                        </div>


                    </form>

                </div>
                {{-- end table --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- Update User Roles Modal --}}
    <div class="modal fade" id="Update_Roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">User Roles <i
                            class="flaticon-list icon-lg text-success"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">

                    <form onsubmit="UpdateUserRoles(event)" method="post">

                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Name:</label>
                            </div>
                            <div class="col-8">
                                <b class="text-primary" id="user_name" style="size: 24px"></b>
                            </div>
                        </div>

                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Incharge</label>
                            </div>
                            <div class="col-8">
                                <select name="incharge" class="custom-select form-control" id="incharge" required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Branch Manager</label>
                            </div>
                            <div class="col-8">
                                <select name="branch_manager" class="custom-select form-control" id="branch_manager"
                                    required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Regional Manager</label>
                            </div>
                            <div class="col-8">
                                <select name="regional_manager" class="custom-select form-control" id="regional_manager"
                                    required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Admin</label>
                            </div>
                            <div class="col-8">
                                <select name="admin" class="custom-select form-control" id="admin" required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="role_id" id="role_id" />
                        <div class="row my-5">
                            <div class="col-5">
                            </div>
                            <div class="col-3">
                                <input type="submit" name="submit" value="Update" class="btn btn-light-success" />
                            </div>
                        </div>


                    </form>

                </div>
                {{-- end table --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- Assign User Roles Modal --}}
    <div class="modal fade" id="Assign_Roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Assign User Roles <i
                            class="flaticon-list icon-lg text-success"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">

                    <form onsubmit="AssignRoles(event)" method="post">

                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Name:</label>
                            </div>
                            <div class="col-8">
                                <b class="text-primary" id="uname" style="size: 24px"></b>
                            </div>
                        </div>

                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Incharge</label>
                            </div>
                            <div class="col-8">
                                <select name="incharge" class="custom-select form-control" id="role-incharge" required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Branch Manager</label>
                            </div>
                            <div class="col-8">
                                <select name="branch_manager" class="custom-select form-control" id="role-branch_manager"
                                    required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Regional Manager</label>
                            </div>
                            <div class="col-8">
                                <select name="regional_manager" class="custom-select form-control"
                                    id="role-regional_manager" required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-2">
                                <label for="">Admin</label>
                            </div>
                            <div class="col-8">
                                <select name="admin" class="custom-select form-control" id="role-admin" required>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="uid" id="user_id" />
                        <div class="row my-5">
                            <div class="col-5">
                            </div>
                            <div class="col-3">
                                <input type="submit" name="submit" value="Update" class="btn btn-light-success" />
                            </div>
                        </div>


                    </form>

                </div>
                {{-- end table --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(async function() {
            getUsers();

        });
        let classifications = [];
        let classifications_table = $('#class_list').DataTable({
            responsive: false,
            Destroy: true,
            paging: true,
            searching: false,
            scrollX: true,
            pageLength: 5,
            lengthMenu: [
                [5, 30, 50, 100, 250, 500, -1],
                [5, 30, 50, 100, 250, 500, "All"]
            ],
            order: [0, 'desc'],
            columns: [{
                    data: null,
                    title: "<b>Name</b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.name}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Position </b>",
                    render: function(data, type, row) {

                        return `<b class='text-dark'>${data.position}</b>`;


                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Branch </b>",
                    render: function(data, type, row) {

                        return `<b class='text-dark'>${data.BranchName}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'>Added At</b>",
                    render: function(data, type, row) {

                        return `<b class='text-warning'>${moment(data.created_at).format("MMMM DD, YYYY HH:mm A")}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'>Action</b>",
                    render: function(data, type, row) {
                        let btn = ``;

                        btn = `
                            <button onclick='userDetails(${JSON.stringify(data)})'  data-toggle='modal' data-target='#Update_Details' class='btn btn-success font-weight-bolder mr-2'><i class="flaticon-edit icon-1x"></i></button>
                            `;
                        if (data.role_id != null) {
                            btn +=
                                ` <button onclick='UserRoles(${JSON.stringify(data)})' data-toggle='modal' data-target='#Update_Roles' class='btn btn-danger font-weight-bolder mr-2'><i class="flaticon-signs-1 icon-1x"></i></button>`;
                        } else {
                            btn +=
                                `<button onclick='AssignUserRoles(${JSON.stringify(data)})' data-toggle='modal' data-target='#Assign_Roles' class='btn btn-info font-weight-bolder mr-2'><i class="flaticon-file-1 icon-1x"></i></button>`;
                        }
                        return btn;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'>Active?</b>",
                    render: function(data, type, row) {

                        return data.active == 1 ? `<b class='text-danger'>Active</b>` :
                            `<b class='text-dark-500'>Disabled</b>`;
                    }
                }


            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [1],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [2],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [3],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [4],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [5],
                    className: "text-nowrap col-1"
                }
            ]
        });

        function submitGroup(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data
            $("#btn-class").prop("disabled", true);


            axios.post('/add-group', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    $("#btn-class").prop("disabled", false);
                    getGroup();
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });


        }

        function getUsers() {
            axios.get('/get-all-users').then(function(response) {
                classifications_table.search('').columns().search('').clear().draw();
                classifications_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }

        function UpdateUser(event) {
            try {
                event.preventDefault();
                var form = event.target; // Get the form element
                var formData = new FormData(form); // Get form values

                axios.post('/update-user-details', formData).then(function(response) {
                        Swal.fire('Created Successfully', response.data, 'success');
                        console.log(response.data);
                        getUsers();
                        $(`#Update_Details`).modal('hide');
                    })
                    .catch(function(error) {
                        Swal.fire({
                            title: "ERROR",
                            text: error,
                            icon: 'error'
                        })
                    });

            } catch (error) {
                console.log(error);
            }

        }

        function UpdateUserRoles(event) {
            try {
                event.preventDefault();
                var form = event.target; // Get the form element
                var formData = new FormData(form); // Get form values

                axios.post('/update-user-roles', formData).then(function(response) {
                        Swal.fire('Created Successfully', response.data, 'success');
                        console.log(response.data);
                        getUsers();
                        $(`#Update_Roles`).modal('hide');

                    })
                    .catch(function(error) {
                        Swal.fire({
                            title: "ERROR",
                            text: error,
                            icon: 'error'
                        })
                    });

            } catch (error) {
                console.log(error);
            }

        }

        function AssignRoles(event) {
            try {
                event.preventDefault();
                var form = event.target; // Get the form element
                var formData = new FormData(form); // Get form values

                axios.post('/assign-user-roles', formData).then(function(response) {
                        Swal.fire('Created Successfully', response.data, 'success');
                        console.log(response.data);
                        getUsers();
                        $(`#Assign_Roles`).modal('hide');

                    })
                    .catch(function(error) {
                        Swal.fire({
                            title: "ERROR",
                            text: error,
                            icon: 'error'
                        })
                    });
            } catch (error) {
                console.log(error);
            }

        }


        function userDetails(data) {

            $('#name').val(data.name);
            $('#position').val(data.position);
            $('#branch').val(data.dept_id);
            $('#email').val(data.email);
            $('#active').val(data.active);
            $('#uid').val(data.id);
        }

        function UserRoles(data) {

            $('#user_name').html(data.name);
            $('#incharge').val(data.incharge);
            $('#branch_manager').val(data.branch_manager);
            $('#regional_manager').val(data.regional_manager);
            $('#admin').val(data.admin);
            $('#role_id').val(data.role_id);
        }

        // function UserRoles(data) {

        //     $('#name').html(data.name);
        //     $('#incharge').val(data.incharge);
        //     $('#branch_manager').val(data.branch_manager);
        //     $('#regional_manager').val(data.regional_manager);
        //     $('#admin').val(data.admin);
        //     $('#role_id').val(data.role_id);
        // }

        function AssignUserRoles(data) {
            $('#uname').html(data.name);
            $('#user_id').val(data.id);

        }
    </script>
@endsection
