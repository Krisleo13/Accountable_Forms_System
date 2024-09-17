@extends('Layouts.app')

@section('sub_header')
   <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                 @include('Forms.Purchase Order.Subheader')
            <div class="d-flex align-items-center">
                 <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5 font-size-h4"> Accountable Forms Invertory > </h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">
                            <a href="#" class="text-primary font-size-h4">Purchase Order Records </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="d-flex flex-column-fluid">

            <div class="container">
                <span class="text-d ark font-weight-bold font-size-h2 mt-2"></span>
                <div class="row">
                    <div
                        class="col bg-light-white  px-6 py-8 rounded-xl card card-custom  my-3 ">

                        <h1 class="text-primary">Branch Purchase Requests</h1>
                        <div>
                            <div class="">
                                <br>
                                <br>
                                <table
                                    class="table table-hover table-lg table-head-custom table-head-bg table-vertical-center"
                                    style="text-align: center" id="req_id">
                                </table>

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
            paging: true,
            searching: true,
            scrollX: true,
            columns: [{
                    data: null,
                    title: "<b class='text-success '>  </b>",
                    render: function(data, type, row, meta) {
                        let color = '';
                        switch (data.sid) {
                            case 1:
                                color = 'dark-1';
                                break;
                            case 2:
                                color = 'primary';
                                break;
                            case 3:
                                color = 'danger';
                                break;

                        }


                        return `
                        <a href='/get-requisition-details/${data.req_no}'><b class='text-warning'>
                            <div style="text-align: left;" class='d-flex align-items-center'>


                                <div>
                                    <span><b class='text-nowrap text-warning font-size-h6'>${data.req_no}</b></span></br>
                                </div>
                            </div>
                        </a>`;
                    }
                },
                {
                    data: null,
                    title: "<b style='text-align: center !important' class='text-nowrap text-success'>  </b>",
                    render: function(data, type, row) {
                        let color = '';
                        switch (data.sid) {
                            case 1:
                                color = 'dark-1';
                                break;
                            case 2:
                                color = 'primary';
                                break;
                            case 3:
                                color = 'danger';
                                break;

                        }


                        return `
                        <a href='/get-requisition-details/${data.req_no}'><b class='text-warning'>
                            <div style="text-align: left;" class='d-flex align-items-center'>
                                <div class='mr-3 my-3'>
                                    <div class="symbol symbol-50 symbol-circle symbol-light-primary">
                                        <span class="symbol-label font-size-h4">${data.BranchCode}</span>
                                    </div>
                                </div>
                                <div class='my-3'>
                                    <span><span class='text-dark'>${data.items_info}</span></br></br>
                                     <span class="label label-info label-inline mr-2">Prepared by: ${data.prepared_by} </span>
                                     <span class="label label-success label-inline mr-2">From: ${data.from_branch} </span>
                                     <span class="label label-${color} label-inline mr-2">Status: ${data.state}</span></br>

                                </div>
                            </div>
                        </a>`;

                    }

                },
                {
                    data: null,
                    title: "<b></b>",
                    render: function(data, type, row) {
                        return `<b class='text-primary'>${moment(data.created_at).format("MMMM DD, YYYY HH:mm A")}</b>`;
                    }
                }

            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-wrap col-1 "
                },
                {
                    targets: [1],
                    className: "text-wrap col-8"
                },
                {
                    targets: [2],
                    className: "text-wrap col-3"
                }


            ]
        });


        function getRequisitions() {
            axios.get('/list-all-branch-requisition').then(function(response) {
                requisition_table.search('').columns().search('').clear().draw();
                requisition_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }


        $(document).ready(async function() {
            getRequisitions();
        });
    </script>
@endsection
