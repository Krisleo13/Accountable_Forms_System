@extends('Layouts.app')

@section('sub_header')
  <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                 @include('Forms.Stock Transfer.subheader')
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5 font-size-h4">Stock Transfer ></h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">
                            <a href="#" class="text-primary font-size-h4"> Stock Tranfer Records </a>
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
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <form class="form" id="ticket_create_form" method="POST" onsubmit="SubmitIntransit(event)" action="#" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row pb-10">
                                            <div class="col-xl-12">
                                                <div class="form-group row">
                                                    <h2 class=" col-6 mb-5 font-weight-bold text-dark">
                                                        Stock Transfer
                                                        <span class="svg-icon svg-icon-warning svg-icon-2x col-1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Share.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" fill="#000000" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) "/>
                                                                </g>
                                                            </svg><!--end::Svg Icon-->
                                                        </span>
                                                    </h2>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"> Intransit No.<i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                                                    <div class="col-lg-9 col-xl-9">

                                                        <input type="text" name="intransit_no" class="form-control form-control-lg" id=""  />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"> Deliver Item to <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <select value="" name="to_branch" class="form-control form-control-lg" id="branch_department" style="width: 100%" required>
                                                            <option value="" disabled selected> --Select Branch or Department-- </option>
                                                            @foreach($department->GetDeparment() as $res)
                                                                    @if(session()->get('user')->branch!=$res->id)
                                                                        <option selected value="{{ $res->id }}"> {{ $res->BranchName }} </option>
                                                                    @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="from_branch_department_name" class="form-control form-control-lg" id="from_branch_department_name" value="{{session()->get('user')->BranchName}}" />
                                                    </div>
                                                </div>

                                                    <button data-toggle='modal' data-target='#add_item'  type="button" class="btn btn-success">Add Item</button>

                                                {{--stock transfer items summary list--}}
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <table class=" table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                            style="text-align: center" id="stocktransfer_summary">
                                                        </table>
                                                    </div>
                                                    <br>
                                                </div>
                                                {{--stock transfer items list--}}
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <table class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                            style="text-align: center" id="stocktransfer_items">
                                                        </table>
                                                    </div>
                                                </div>
{{--                                                purpose--}}
                                                <div class="form-group row">
                                                    <div class="col-2">
                                                        Purpose <i class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip" title="Require Field"></i>:
                                                    </div>
                                                    <div class="col-10">
                                                        <textarea class="form-control" name="purpose" id="purpose" cols="30" rows="10"></textarea>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between border-top mt-5 pt-20">
                                            <button type="submit"  class="btn btn-light-success font-weight-bolder text-uppercase px-9 py-4 mr-2"> Submit </button>
                                            <input type="hidden" name="from_branch" value="{{session()->get('user')->branch}}">
                                            <input type="hidden" name="uid" value="{{session()->get('user')->id}}">
                                        </div>
                                    </form>
                                    <br>
                                    <br>
                                    <br>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Add Item <i class="text-success ki ki-solid-plus icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">
                    <table class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                           style="text-align: center" id="approved_items">
                    </table>
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
        {{--data --}}
        let approved_items=[];
        let stocktransfer_summary=[];
        let stocktransfer_items =[];
        // tables
        let stocktransfer_summary_table = $('#stocktransfer_summary').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            columns: [
                {
                    data: null,
                    title: "<b class='text-nowrap'> Description </b>",
                    render: function(data, type, row) {
                        return `<b>${data.description}</b>`;
                    }
                },{
                    data: null,
                    title: "<b class='text-nowrap'> Item </b>",
                    render: function(data, type, row) {
                        return `<b>${data.classification}</b>`;
                    }
                },{
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
            paging: false,
            searching: false,
            scrollX: true,
            columns: [
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
                    title: "<b> Action </b>",
                    render: function(data, type, row) {
                        return ` <b><i onclick='removeItem(${JSON.stringify(row)})' class="flaticon-cancel icon-2x text-danger"></i></b>`;
                    }
                }

            ],
            columnDefs: [
                {
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
        let approved_items_table = $('#approved_items').DataTable({
            responsive: false,
            Destroy: true,
            paging: true,
            searching: false,
            scrollX: true,
            columns: [
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
                    title: "<b> Action </b>",
                    render: function(data, type, row) {
                            return ` <b><i onclick='addItem(${JSON.stringify(row)})' class="flaticon-add-circular-button icon-2x text-primary"></i></b>`;
                    }
                }

            ],
            columnDefs: [
                {
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
        //

        function getApprovedItems() {
            axios.get('/get-approved-items/{{session()->get('user')->branch}}').then(function(response) {
                $(`#requisition_logs`).html('');
                approved_items=response.data;
                renderApprovedItemsTable(response.data);
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


        function addItem(row){
            stocktransfer_items.push(row);
            renderItemsTable(stocktransfer_items);
            removeApprovedItem(row);
            setSummaryValue();
        }

        function removeItem(row){
            approved_items.push(row);
            renderApprovedItemsTable(approved_items);
            removeItemTable(row);
            setSummaryValue();
        }

        function removeApprovedItem(row){
            let  index=approved_items.findIndex(
                (item) => item.id === row.id
            );
            if (index !== -1) {
                approved_items.splice(index, 1);
                renderApprovedItemsTable(approved_items)
            }

        }

        function removeItemTable(row){
            let  index=stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            if (index !== -1) {
                stocktransfer_items.splice(index, 1);
                renderItemsTable(stocktransfer_items);
            }
        }

        function  setSummaryValue(){
            let summary = {};
            let class_item=[...new Set(stocktransfer_items.map(record => record.iid))];
            let filtered_item = [];
            stocktransfer_summary = [];

            for (let i = 0; i < class_item.length; i++) {
                summary={}
                filtered_item = stocktransfer_items.filter(function (item) {
                    return item.iid === class_item[i];
                });
                console.log(filtered_item);

                summary.class_id=class_item[i];
                summary.classification=filtered_item[0].classification;
                summary.description=filtered_item[0].description;
                summary.quantity=filtered_item.length;
                summary.start=filtered_item[0].series_start;
                summary.end=filtered_item[filtered_item.length-1].series_end;
                console.log(summary);


                stocktransfer_summary.push(summary);
            }

            renderSummaryTable(stocktransfer_summary);
        }

        function SubmitIntransit(event){
            event.preventDefault();
            let form     = event.target;
            let formData = new FormData(form);
            formData.append("stocktransfer_items", JSON.stringify(stocktransfer_items));

            axios
                .post(`/add-stock-transfer`, formData)
                .then(function (response) {
                    Swal.fire("Created Successfully", response.data, "success");

                    window.location.reload();
                })
                .catch(function (error) {});

        }

        //re-render table
        $(document).ready(async function () {
            // filter data
            await getApprovedItems();
        });
        $("#add_item").on("shown.bs.modal", function () {
            // Initialize or redraw the DataTable here
            $("#approved_items").DataTable().draw();
        });


    </script>
@endsection
