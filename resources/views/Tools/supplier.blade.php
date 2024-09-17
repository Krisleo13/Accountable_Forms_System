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
                            <h2 class="text-primary"> Supplier </h2>
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
                                <h1 class="text-success"> <i class="flaticon-file-1 icon-2x text-success"></i>Add Supplier
                                </h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <form class="my-5" method="POST" onsubmit="submitSupplier(event)"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Supplier Name:</label>
                                            <span class="col-5">
                                                <input class="form-control" name="supplier" type="text" required>
                                            </span>

                                        </div>
                                        <hr>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Name:</label>
                                            <span class="col-5">
                                                <input placeholder="Supplier Contact Name" name="name"
                                                    class="form-control" type="text">
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Position:</label>
                                            <span class="col-5">
                                                <input class="form-control" placeholder="Supplier Contact Position"
                                                    name="position" type="text" required>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Contact No.:</label>
                                            <span class="col-5">
                                                <input placeholder="Supplier Contact number" name="contact_no"
                                                    class="form-control" type="text">

                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Email:</label>
                                            <span class="col-5">
                                                <input placeholder="Example@email" class="form-control" name="email"
                                                    type="email">
                                            </span>
                                        </div>


                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Address:</label>
                                            <span class="col-5">
                                                <input class="form-control" placeholder="Supplier Address" name="address"
                                                    type="text" required>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Terms:</label>
                                            <span class="col-5">
                                                <select name="terms" id="" class="form-control">
                                                    <option value=""></option>
                                                    <option value="1">Full Payment</option>

                                                </select>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">More Info:</label>
                                            <span class="col-5">
                                                <textarea name="info" id="" cols="30" rows="10" class="form-control"></textarea>
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Status:</label>
                                            <span class="col-5">
                                                <select name="status" id="" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="2">Deactivate</option>

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
                                        style="text-align: center" id="supplier_list">

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
            getSupplier();

        });

        let req_items = [];



        function submitSupplier(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data
            $("#btn-items").prop("disabled", true);


            axios.post('/add-supplier', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    getSupplier();
                    $("#btn-items").prop("disabled", false);
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });


        }

        function getSupplier() {
            axios.get('/get-supplier').then(function(response) {
                item_table.search('').columns().search('').clear().draw();
                item_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }
        let item_table = $('#supplier_list').DataTable({
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
                    title: "<b>Supplier Name</b>",
                    render: function(data, type, row) {
                        return `<b class='text-success'>${row.supplier}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'>Contact Info </b>",
                    render: function(data, type, row) {
                        let item_class = "";

                        return `
                        <div class="row">
                            <b class='col-3 text-primary'>Name:</b>
                            <b class='col-9 text-warning'>${row.name}</b>
                        </div>
                        <div class="row">
                            <b class='col-4 text-primary'>Phone No:</b>
                            <b class='col-8 text-warning'>${row.contact}</b>
                        </div>
                          <div class="row">
                            <b class='col-3 text-primary'>Email:</b>
                            <b class='col-9 text-warning'>${row.email}</b>
                        </div>


                            `;
                    }
                },
                {
                    data: null,
                    title: "<b>Position</b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'> ${row.position} </b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Terms </b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'> FUll PAYMENT</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Address </b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'> ${row.address} </b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Status </b>",
                    render: function(data, type, row) {

                        return `<b class='text-danger'> Active </b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function(data, type, row) {

                        return `
                            <button class='btn btn-success font-weight-bolder mr-2'><i class="flaticon-edit icon-1x"></i></button>
                            <button class='btn btn-danger font-weight-bolder mr-2'><i class="flaticon-delete icon-1x"></i></button>
                            `;
                    }
                },
            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [1],
                    className: "text-wrap col-1"
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
                }
            ]
        });
    </script>
@endsection
