@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                 @include('Forms.Requisition.Subheader')
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5">Purchase Request</h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">
                            <a href="#" class="text-primary"> Requisition Orders </a>
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
                            <div
                                class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto ribbon ribbon-top ribbon-ver">
                                <div class="ribbon-target bg-success" style="top: -2px; right: 20px;">
                                    LIST
                                </div>
                                <h1 class="text-success">Purchase Request Orders</h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
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
        let formData = new FormData();
        let requisition_table = $('#req_id').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            columns: [{
                    data: null,
                    title: "<b class='text-success '> Item </b>",
                    render: function(data, type, row, meta) {

                        primary
                        return `

                          <div class='d-flex align-items-center'>

                            <div class='mr-3'>
                                <div class="symbol symbol-50 symbol-circle symbol-light-success">
                                    <span class="symbol-label font-size-h4">${data.code}</span>
                                </div>
                            </div>
                            <div>
                                <b class='text-dark'>${data.description}</b>
                            </div>

                        </div>

                        `;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap text-success'> Requisition Details </b>",
                    render: function(data, type, row) {
                        return `
                            <div style="text-align: left;">
                                <b >No : <span class='text-success'>${data.req_no} </span></b>
                                <br>
                                <b class='text-dark'>State : <span class='text-warning'>${data.req_status}</span></b>
                                <br>

                                <p>Request at:  <span class='text-warning'>${moment(data.req_date).format("MMMM DD, YYYY") } </span></p>
                            </div>`;
                    }

                },
                {
                    data: null,
                    title: "<b class='text-nowrap text-success'> PO Details </b>",
                    render: function(data, type, row) {
                        return `
                        <div style="text-align: left;">
                                <b>No : <span class='text-success'>${data.pono}</span></b>
                                <br>
                                <b>State : <span class='text-warning'>${data.po_status}</span></b>
                                <br>
                                <p>PO at: <span class='text-warning'>${moment(data.po_date).format("MMMM DD, YYYY") }</span></p>
                            </div>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap text-success'> Qty. Requested </b>",
                    render: function(data, type, row) {
                        return `<b class='text-primary'>${data.quantity}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-success'> QTY Received </b>",
                    render: function(data, type, row) {
                        return `<b class='text-danger'>${data.delivered}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-success'> Progress </b>",
                    render: function(data, type, row) {
                        let percentage = (data.delivered / data.quantity) * 100;
                        return `
                            <span class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-50px w-xl-250px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: ${percentage}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </span>
                            <span class="font-weight-bolder">${percentage==100?" <span class='text-success'>Complete</span>":percentage+"%"}</span>
                        `;
                    }
                }

            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-wrap col-2 "
                },
                {
                    targets: [1],
                    className: "text-wrap col-2"
                },
                {
                    targets: [2],
                    className: "text-wrap col-2"
                },
                {
                    targets: [3],
                    className: "text-wrap col-1"
                },
                {
                    targets: [4],
                    className: "text-wrap col-1"
                },
                {
                    targets: [5],
                    className: "text-wrap col-1"
                }
            ]
        });


        function getRequisitions() {
            axios.get(`/requisition-orders/{{ session()->get('user')->branch }}`).then(function(response) {
                requisition_table.search('').columns().search('').clear().draw();
                requisition_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }


        $(document).ready(async function() {
            getRequisitions();
        });
    </script>
@endsection
