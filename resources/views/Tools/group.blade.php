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
                            <h2 class="text-primary"> Group </h2>
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
                                <h1 class="text-success"> <i class="flaticon-file-1 icon-2x text-success"></i>
                                    Add Group
                                </h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <form class="my-5" method="POST" onsubmit="submitGroup(event)"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Group Name:</label>
                                            <span class="col-5">
                                                <input class="form-control" name="class_name" type="text">
                                            </span>

                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Code:</label>
                                            <span class="col-5">
                                                <input class="form-control" name="class_code" type="text">
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Details & Ex.:</label>
                                            <span class="col-5">
                                                <textarea name="details" id="" class="form-control" cols="30" rows="10"></textarea>
                                            </span>

                                        </div>
                                        <input id="btn-class" style="margin-left: 50%;margin-right: 50%" type="submit"
                                            value="Submit" class="btn btn-success">

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
                                        style="text-align: center" id="class_list">

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
            getGroup();

        });

        let classifications = [];



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

        function getGroup() {
            axios.get('/get-group').then(function(response) {
                classifications_table.search('').columns().search('').clear().draw();
                classifications_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }
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
                    title: "<b>Classification</b>",
                    render: function(data, type, row) {
                        return `<b class='text-success'>${data.classification}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Code </b>",
                    render: function(data, type, row) {

                        return `<b class='text-success'>${data.code}</b>`;


                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'>Classification </b>",
                    render: function(data, type, row) {

                        return `<b class='text-dark'>${data.details}</b>`;
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

                        return `
                            <button class='btn btn-success font-weight-bolder mr-2'><i class="flaticon-edit icon-1x"></i></button>
                            <button class='btn btn-danger font-weight-bolder mr-2'><i class="flaticon-delete icon-1x"></i></button>
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
                }
            ]
        });
    </script>
@endsection
