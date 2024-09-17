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
                            <a href="#" class="text-primary font-size-h4"> Purchase Order Requests </a>
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
                            <div  class="card-header  align-items-center flex-wrap py-5 h-auto ">

                                <h1 class="text-primary">PO Request For Approvals</h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
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
    </div>
@endsection

@section('script')
    <script>
        let req_items = [];
        let formData = new FormData();
        let po_table = $('#req_id').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            columns: [{
                    data: null,
                    title: "<b> Purchase Order No. </b>",
                    render: function(data, type, row, meta) {
                        return `<a href='/purchase-order-details/${data.po_no}'><b class='text-primary'>${data.po_no}</b></a>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Branch Requester </b>",
                    render: function(data, type, row) {
                        let color = '';


                        return `

                        <a href='/purchase-order-details/${data.po_no}'><b class='text-warning'>
                            <div style="text-align: left;" class='d-flex align-items-center'>
                                <div>
                                    <span><span class='text-dark'>${data.items_info}</span></br></br>
                                     <span class="label label-info label-inline mr-2">Prepared by: ${data.prepared} </span>
                                     <span class="label label-success label-inline mr-2">To Supplier: ${data.supplier} </span>
                                      <span class="label label-primary label-inline mr-2">Date Requested: ${moment(data.created_at).format("MMMM DD, YYYY HH:mm A") }</span>
                                    </br>

                                </div>
                            </div>
                        </a>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Order Count </b>",
                    render: function(data, type, row) {


                        return `<b class='text-dark-2' > ${data.order_line_count} </b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Status </b>",
                    render: function(data, type, row) {
                        return `<b class='text-success'>${data.state}</b>`;
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
                }
            ]
        });


        function getPO() {
            axios.get('/get-purchase-order-request').then(function(response) {
                po_table.search('').columns().search('').clear().draw();
                po_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }


        $(document).ready(async function() {
            getPO();
        });
    </script>
@endsection
