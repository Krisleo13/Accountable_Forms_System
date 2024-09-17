@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Accountable Forms Invertory </h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">
                            <a href="#" class="text-primary"> Home </a>
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
                                <span class="text-success">Requisition Form</span>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <form class="my-5" action="#" method="get">
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-1" for="">To:</label>
                                            <span class="col-5">
                                                <input class="form-control " type="text">
                                            </span>
                                            <span class="col-1"></span>

                                            <label class="col-1" for="">Req No.:</label>
                                            <span class="col-2">
                                                <input class="form-control " type="text">
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-1" for="">Attn:</label>
                                            <span class="col-5">
                                                <input class="form-control " type="text">
                                            </span>
                                            <span class="col-1"></span>

                                            <label class="col-1" for="">Date:</label>
                                            <span class="col-2">
                                                <input class="form-control " type="Date">
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-1" for="">From:</label>
                                            <span class="col-5">
                                                <input class="form-control " type="text">
                                            </span>
                                            <span class="col-1"></span>
                                            <label class="col-1" for="">Status:</label>
                                            <span class="col-2">
                                                <input class="form-control " type="Text">
                                            </span>
                                        </div>
                                    </form>
                                    <table
                                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                                        style="text-align: center" id="req_id">


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
        let req_items = [];
        let approval_table = $('#req_id').DataTable({
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
                    title: "<b>Quantity</b>",
                    render: function(data, type, row) {
                        return `<a href='/ticket-details/${data.ticketcode}' style="color: orange"  class="symbol-label font-size-h5">${data.ticketcode}</a>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Units </b>",
                    render: function(data, type, row) {
                        return ` `;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Description </b>",
                    render: function(data, type, row) {
                        switch (data.status_id) {

                            case 7:
                                return "<span class='text-success'>" + data.state + "</span>";
                                break;

                            case 5:
                                return "<span class='text-warning'>" + data.state + "</span>";
                                break;
                        }
                    }
                },

                {
                    data: null,
                    title: "<b>Series</b>",
                    render: function(data, type, row) {
                        var date = new Date(data.dateRecord);
                        return `<b class='text-primary'>${date.toLocaleString('default', { month: 'long' })+" "+ date.getDate()+", "+date.getFullYear() }</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Group </b>"
                },

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
                // { targets: [4], className: "text-nowrap col-1"},
                {
                    targets: [4],
                    className: "text-nowrap col-1"
                }
            ]
        });
        $(document).ready(async function() {
            getMytickets();
        });
    </script>
@endsection
