@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('Tools.subheader')
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Tools</h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-primary">
                            <h2 class="text-primary"> Employee </h2>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" >
        <div class="d-flex flex-row-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                                <h1 class="text-success"> <i class="flaticon-file-1 icon-2x text-success"></i> Add Employee
                                </h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <form class="my-5" method="POST" onsubmit="submitEmployee(event)"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">First Name:</label>
                                            <span class="col-5">
                                               <input type="text" name="fname" class="form-control"  placeholder="First Name" required>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Last name:</label>
                                            <span class="col-5">
                                                <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                                            </span>
                                        </div>
                                          <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Email:</label>
                                            <span class="col-5">
                                                <input type="email" name="email" class="form-control" placeholder="@Email" required>
                                            </span>
                                        </div>
                                          <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Position:</label>
                                            <span class="col-5">
                                                <input type="text" name="position" class="form-control" placeholder="Ex. Manager, Programmer" required>
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-5">
                                                <input type="hidden" name="dept_id" value="{{ session()->get('user')->branch }}">
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Active:</label>
                                            <span class="col-5">
                                                <select name="active" name="role" class="form-control" id="" required>
                                                    <option value="" selected disabled>--- Select Status ---</option>
                                                    <option value="0">False</option>
                                                    <option value="1">True</option>

                                                </select>
                                            </span>
                                        </div>

                                        <br>
                                        <input id="btn-items" style="margin-left: 50%;margin-right: 50%" type="submit"
                                            value="Submit" class="btn btn-success" >
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-row-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                                <h1 class="text-success"> <i class="flaticon-file-2 icon-2x text-success"></i>List
                                </h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <table
                                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                                        style="text-align: center" id="department_list">
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(async function() {
            getEmployee();
            getCompany();

        });

        let req_items = [];
        let bu = [];
        let company = [];
        let employee_table = $('#department_list').DataTable({
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
                    title: "<b>First Name</b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.first_name}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>Last Name </b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.last_name}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>Last Name </b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.position}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Active </b>",
                    render: function(data, type, row) {
                        let item_class = "";

                        return data.active==1?`<b class='text-success'>Yes</b>`:`<b class='text-danger'>No</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Account </b>",
                    render: function(data, type, row) {
                        let item_class = "";

                        return data.user_id != null?`<b class='text-success'>Registered</b>`:`<b class='text-danger'>UnRegistered</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function(data, type, row) {

                        return `<button class='btn btn-success font-weight-bolder mr-2'><i class="flaticon-edit icon-1x"></i></button>`;
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



        function submitEmployee(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data
            $("#btn-items").prop("disabled", true);


            axios.post('/add-employee', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    $("#btn-items").prop("disabled", false);
                    getEmployee()
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });


        }

        function onchangeBU(value) {
            let filtered = company.filter(function(item) {
                return item.bu_id === parseInt(value);
            });
            $(filtered).each((index, value) => {

                $(`#company`).append(`<option value="${value.id}">${value.name} </option>`);
            });



        }

        function getEmployee() {
            axios.get(`/get-employee/{{session()->get('user')->branch}}`).then(function(response) {
                renderEmployeeTbl(response.data);
            }).catch(function(error) {});
        }

        function renderEmployeeTbl(data){
            employee_table.search('').columns().search('').clear().draw();
            employee_table.rows.add(data).draw(true);
        }

        function getBusinessUnit() {
            axios.get('/get-business-unit').then(function(response) {
                bu = response.data;

            }).catch(function(error) {});
        }

        function getCompany() {
            axios.get('/get-company').then(function(response) {
                company = response.data;


            }).catch(function(error) {});
        }


    </script>
@endsection
