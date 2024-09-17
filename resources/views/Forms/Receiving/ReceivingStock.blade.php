@extends('Layouts.app')

@section('sub_header')
   <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        @include('Forms.Receiving.Subheader')
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h4 class="text-dark font-weight-bold my-1 mr-5"> Accountable Forms Invertory </h4>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-primary">
                        <a href="#" class="text-primary"> <h4> Receiving Orders</h4> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

    <div class="d-flex flex-column-fluid p-5" style="background-color: #a4b8cf">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <form class="form" id="ticket_create_form" method="POST" onsubmit="#"
                                        action="#" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row pb-10">
                                            <div class="col-xl-12">

                                                <div class="form-group row">
                                                    <h3 class=" col-6 mb-5 font-weight-bold text-dark">
                                                        Receiving Stock
                                                        <span
                                                            class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Box3.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M20.4061385,6.73606154 C20.7672665,6.89656288 21,7.25468437 21,7.64987309 L21,16.4115967 C21,16.7747638 20.8031081,17.1093844 20.4856429,17.2857539 L12.4856429,21.7301984 C12.1836204,21.8979887 11.8163796,21.8979887 11.5143571,21.7301984 L3.51435707,17.2857539 C3.19689188,17.1093844 3,16.7747638 3,16.4115967 L3,7.64987309 C3,7.25468437 3.23273352,6.89656288 3.59386153,6.73606154 L11.5938615,3.18050598 C11.8524269,3.06558805 12.1475731,3.06558805 12.4061385,3.18050598 L20.4061385,6.73606154 Z"
                                                                        fill="#000000" opacity="0.3" />
                                                                    <polygon fill="#000000"
                                                                        points="14.9671522 4.22441676 7.5999999 8.31727912 7.5999999 12.9056825 9.5999999 13.9056825 9.5999999 9.49408582 17.25507 5.24126912" />
                                                                </g>
                                                            </svg><!--end::Svg Icon-->
                                                        </span>
                                                    </h3>
                                                </div>

                                                <div class="">
                                                    <div class="row my-5">
                                                        <span class="col-1"></span>
                                                        <label class="col-2" for="">REC No.:</label>
                                                        <span class="col-5">
                                                            <input class="form-control" name="dr_no" type="text"
                                                                required>
                                                        </span>
                                                    </div>
                                                    <div class="row my-5">
                                                        <span class="col-1"></span>
                                                        <label class="col-2" for="">Source Type:</label>
                                                        <span class="col-5">
                                                            <select class="form-control" name="source" id="suppplier"
                                                                type="text" required>
                                                                <option value="" disabled>Select Source Type</option>
                                                                <option value="2">HO to Branch</option>
                                                                <option value="3">Branch to Branch</option>
                                                                <option value="4">Branch to HO</option>
                                                            </select>
                                                        </span>
                                                        <span class="col-1"></span>
                                                    </div>
                                                    <div class="row my-5">
                                                        <span class="col-1"></span>
                                                        <label class="col-2" for="">From:</label>
                                                        <span class="col-5">

                                                        </span>
                                                        <span class="col-1"></span>
                                                    </div>
                                                    <br>
                                                    <table
                                                        class=" table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                        style="text-align: center" id="stocktransfer_summary">
                                                    </table>
                                                    <br>
                                                    <br>
                                                    <table
                                                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                        style="text-align: center" id="stocktransfer_items">
                                                    </table>
                                                    <br>
                                                    <div class="row">
                                                        <div style="display: none" class="col-10">
                                                            <textarea name="remarks" id="" class="form-control" cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between border-top mt-5 pt-20">
                                            <button type="submit"
                                                class="btn btn-light-success font-weight-bolder text-uppercase px-9 py-4 mr-2">
                                                Submit </button>
                                            <input type="hidden" name="prepared_by_id"
                                                value="{{ session()->get('user')->id }}">
                                            <input type="hidden" name="status" value="1">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal start --}}
@endsection

@section('script')
    <script>
        {{-- data --}}
        let approved_items = [];
        let stocktransfer_summary = [];
        let stocktransfer_items = [];
        let del_stocktransfer_items = [];
        let new_stocktransfer_items = [];
        let status = 0;
        // tables
        let stocktransfer_summary_table = $('#stocktransfer_summary').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            columns: [{
                    data: null,
                    title: "<b class='text-nowrap'> Description </b>",
                    render: function(data, type, row) {
                        return `<b>${data.description}</b>`;
                    }
                }, {
                    data: null,
                    title: "<b class='text-nowrap'> Item </b>",
                    render: function(data, type, row) {
                        return `<b>${data.classification}</b>`;
                    }
                }, {
                    data: null,
                    title: "<b>No. of Booklets</b>",
                    render: function(data, type, row, meta) {
                        return `<b>${data.quantity}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>Series Start</b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'>${data.start }</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Series End </b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'>${data.end }</b>`;
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
        let stocktransfer_items_table = $('#stocktransfer_items').DataTable({
            responsive: false,
            Destroy: true,
            paging: true,
            searching: true,
            scrollX: true,
            columns: [{
                    data: null,
                    title: "<b class='col-1 text-wrap'>Department/Branch Designation</b>",
                    render: function(data, type, row, meta) {
                        return `<b class='text-dark'>${data.BranchName}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>Quantity</b>",
                    render: function(data, type, row, meta) {
                        return `<b class='text-dark'>${data.quantity} ${data.unit}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>Item</b>",
                    render: function(data, type, row, meta) {
                        return `<b class='text-primary'>${data.description} <span class='text-success'>${data.code} </span></b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Series Start & End </b>",
                    render: function(data, type, row) {
                        return `
                        <b class='text-success' > Start: <span class='text-warning'>${data.series_start}</span></b><br>&<br>
                        <b class='text-success' > End: <span class='text-warning'>${data.series_end}</span></b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>Booklet No.</b>",
                    render: function(data, type, row) {
                        return `<b class='text-primary'>${data.booklet }</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b>Action</b>",
                    render: function(data, type, row, index) {
                        let render = ``;
                        if (!row.confirm || row.confirm == 0) {
                            render = `
                                    <button onclick='ConfirmOrMissingItem(1,${JSON.stringify(data)})' type='button' class='btn btn-sm btn-outline-success'>
                                        Confirm
                                    </button >
                                    <button onclick='ConfirmOrMissingItem(2,${JSON.stringify(data)})' type='button' class='btn btn-sm btn-outline-danger'>
                                        Missing
                                    </button >
                            `;
                        } else {
                            render = row.confirm == 1 ?
                                `<b  class='text-success'>Confirmed </b> ` :
                                `<b class='text-danger'>Discrepancy</b>   `;
                            render +=
                                `<span class="btn" onclick='resetItem(${JSON.stringify(data)})'> <i  class="flaticon-refresh text-info icon-lg"></i></span>`;

                        }
                        return render;
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

        function ConfirmOrMissingItem(val, row) {
            let index = stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            stocktransfer_items[index].confirm = val;
            renderItemsTable(stocktransfer_items);
        }

        function resetItem(row) {
            let index = stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            stocktransfer_items[index].confirm = 0;
            renderItemsTable(stocktransfer_items);
        }
        // get in-transit items
        function getIntransitItems() {
            axios.get('/get-in-transit-items/{{ $intransit_id }}').then(function(response) {
                stocktransfer_items = response.data;
                stocktransfer_items.confirm = 0;
                renderItemsTable(response.data);
                setSummaryValue();
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function renderApprovedItemsTable(data) {
            approved_items_table.search("").columns().search("").clear().draw();
            approved_items_table.rows.add(data).draw(true);
        }

        function renderItemsTable(data) {
            stocktransfer_items_table.search("").columns().search("").clear().draw();
            stocktransfer_items_table.rows.add(data).draw(true);
        }

        function renderSummaryTable(data) {
            stocktransfer_summary_table.search("").columns().search("").clear().draw();
            stocktransfer_summary_table.rows.add(data).draw(true);
        }
        //re-render table
        $(document).ready(async function() {
            // filter data
            await getIntransitItems();
            await $(`#update-item`).hide();
            await $(`#reset-item`).hide();
        });

        function setSummaryValue() {
            let summary = {};
            let class_item = [...new Set(stocktransfer_items.map(record => record.iid))];
            let filtered_item = [];
            stocktransfer_summary = [];


            for (let i = 0; i < class_item.length; i++) {
                summary = {}
                filtered_item = stocktransfer_items.filter(function(item) {
                    return item.iid === class_item[i];
                });

                summary.class_id = class_item[i];
                summary.classification = filtered_item[0].classification;
                summary.description = filtered_item[0].description;
                summary.quantity = filtered_item.length;
                summary.start = filtered_item[0].series_start;
                summary.end = filtered_item[filtered_item.length - 1].series_end;

                stocktransfer_summary.push(summary);
            }

            renderSummaryTable(stocktransfer_summary);
        }

        $("#add_item").on("shown.bs.modal", function() {
            // Initialize or redraw the DataTable here
            $("#approved_items").DataTable().draw();
        });
    </script>
@endsection
