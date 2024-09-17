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
                            <h2 class="text-primary"> Department </h2>
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
                            <div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
                                <h1 class="text-success"> <i class="flaticon-file-1 icon-2x text-success"></i>Add Department
                                </h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <form class="my-5" method="POST" onsubmit="submitDepartment(event)"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">BUSINESS UNIT:</label>
                                            <span class="col-5">
                                                <select onchange="onchangeBU(this.value)" name="bu"
                                                    class="form-control" id="">
                                                    <option value=""></option>
                                                    @foreach ($bu->GetBu() as $res)
                                                        @if ($res->active == 1)
                                                            <option value="{{ $res->id }}"> {{ $res->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach


                                                </select>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">COMPANY:</label>
                                            <span class="col-5">
                                                <select name="comp_name" class="form-control" id="company">
                                                    <option value=""></option>

                                                </select>
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">BRANCH/DEPT.:</label>
                                            <span class="col-5">
                                                <input class="form-control" name="branch_dept" type="text" required>

                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">BRANCH ALIAS:
                                            </label>
                                            <span class="col-5">
                                                <input class="form-control" name="alias" type="text" required>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">BRANCH CODE:
                                            </label>
                                            <span class="col-5">
                                                <input class="form-control" name="bcode" type="text" required>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">STORE CODE:</label>
                                            <span class="col-5">
                                                <input class="form-control" name="scode" type="text" required>
                                            </span>


                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">ROLE:</label>
                                            <span class="col-5">
                                                <select name="role" name="role" class="form-control" id="">
                                                    <option value=""></option>
                                                    <option value="1">Head Office</option>
                                                    <option value="2">Branch User</option>
                                                    <option value="3">Admin</option>

                                                </select>
                                            </span>


                                        </div>
                                        <br>
                                        <input id="btn-items" style="margin-left: 50%;margin-right: 50%" type="submit"
                                            value="Submit" class="btn btn-success" required>
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
                                    <Table
                                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                                        style="text-align: center" id="department_list">

                                        <tbody>
                                        </tbody>

                                    </Table>

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
            getDepartment();
            getCompany();

        });

        let req_items = [];
        let bu = [];
        let company = [];



        function submitDepartment(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data
            $("#btn-items").prop("disabled", true);


            axios.post('/add-department', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    $("#btn-items").prop("disabled", false);
                    getDepartment()
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

        function getDepartment() {
            axios.get('/get-department').then(function(response) {
                department_table.search('').columns().search('').clear().draw();
                department_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
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

        let department_table = $('#department_list').DataTable({
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
                    title: "<b>BUSINESS UNIT</b>",
                    render: function(data, type, row) {
                        return `<b class='text-success'>${data.BusinessUnit}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> COMPANY </b>",
                    render: function(data, type, row) {


                        return `<b class='text-warning'>${data.Company}</b>`;


                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'>BRANCH/DEPT. </b>",
                    render: function(data, type, row) {
                        let item_class = "";

                        return `<b class='text-dark'>${data.BranchName}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>BRANCH ALIAS</b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'> ${data.Alias } </b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> BRANCH CODE </b>",
                    render: function(data, type, row) {

                        return `<b class='text-success'> ${data.BranchCode } </b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> STORE CODE </b>",
                    render: function(data, type, row) {

                        return `<b class='text-success'> ${data.StoreCode } </b>
                            `;
                    }
                },
                {
                    data: null,
                    title: "<b> ROLE </b>",
                    render: function(data, type, row) {
                        let role = "";

                        switch (data.role) {
                            case 1:
                                role = `<b class='text-success'> Head Office </b>`;
                                break;
                            case 2:
                                role = `<b class='text-success'> Branch User </b>`;
                                break;
                            case 3:
                                role = `<b class='text-success'> Admin </b>`;
                                break;
                        }

                        return role;
                    }
                },
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function(data, type, row) {

                        return `
                            <button class='btn btn-success font-weight-bolder mr-2'><i class="flaticon-edit icon-1x"></i></button>
                            `;
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
                },
                {
                    targets: [6],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [7],
                    className: "text-nowrap col-1"
                }
            ]
        });
    </script>
@endsection
