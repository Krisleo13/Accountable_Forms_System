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
                        <a href="#" class="text-primary"> <h4> Receiving from Origin</h4> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
 <div class="content d-flex flex-column flex-column-fluid" id="kt_content" >
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    {{-- form  --}}

                                    <form class="my-5" action="#" onsubmit="SubmitReceivingOrigin(event)" method="get">

                                        <div class="col-xl-12">
                                            <div class="form-group row">
                                                <h3 class=" col-6 mb-5 font-weight-bold text-dark">
                                                    Receiving Origin
                                                     <span  class="svg-icon svg-icon-warning svg-icon-2x col-1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Share.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path
                                                                    d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) " />
                                                            </g>
                                                        </svg><!--end::Svg Icon-->
                                                    </span>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">DR No.:</label>
                                            <span class="col-5">
                                                <input class="form-control" name="dr_no" type="text" required>
                                            </span>
                                        </div>

                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Supplier:</label>

                                            <span class="col-5">
                                                <select class="form-control" name="sender" type="text" required>
                                                    <option value=""></option>
                                                    @foreach ($supplier->GetAllSupplier() as $res)
                                                        <option value="{{ $res->id }}">{{ $res->supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </span>

                                            <span class="col-1"></span>
                                            <span class="col-2">
                                                <input type="hidden" name="status" value="9">
                                                 <input type="hidden" name="receiver" value="{{session()->get('user')->branch}}">
                                                </select>
                                            </span>
                                        </div>
                                        <br>
                                        {{-- this is the add data to the table --}}
                                        <button data-toggle='modal' data-target='#req_list' type="button"
                                            class="btn btn-success font-weight-bolder mr-2">
                                            Add
                                            <i class="ki ki-bold-sort"></i>
                                        </button><br>
                                        {{-- end --}}
                                        {{-- add Receiving Details --}}

                                        <table
                                            class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                            style="text-align: center" id="receiving_items_summary">
                                        </table>
                                        {{-- end --}}

                                        {{-- this is the add data to the table --}}
                                        <br>
                                        {{-- end --}}

                                        {{-- start table --}}
                                        <table
                                            class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                            style="text-align: center" id="receiving_items">
                                        </table>
                                        {{-- end --}}

                                        {{-- remarks --}}
                                        <div class="row">
                                            <div class="col-2">Remarks:</div>
                                            <div class="col-10">
                                                <textarea name="remarks" id="" class="form-control" cols="30" rows="5"></textarea>
                                            </div>

                                        </div>
                                        <hr>
                                        {{-- end --}}
                                        <br>

                                        <input id="btn-submit" type="submit" name='submit' value="submit"
                                            class="btn btn-light-success font-weight-bolder text-uppercase px-9 py-4 mr-2" />

                                        <input type="hidden" name="receiver"
                                            value="{{ session()->get('user')->branch }}" />
                                        <input type="hidden" name="uid" value="{{ session()->get('user')->id }}" />
                                        <input value="{{ session()->get('user')->emp_id }}" name="prepared_by_id"
                                            type="hidden" />

                                    </form>
                                    {{-- end form --}}
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

    {{-- modal start --}}
    <div class="modal fade" id="req_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel"> Generate Items <i
                            class="flaticon-list text-success icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}
                <div class="modal-body">
                    <div class="row">

                         <div class="col-2">
                            Items type
                         </div>
                        <div class="col-6">
                            <select name="" id="item" class="form-control my-1">
                                <option value=""></option>
                                @foreach ($items->GetItems() as $res )
                                <option value="{{$res->id}}">{{$res->description}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                    </div>
                     <div class="row">
                        <div class="col-2">
                            Set Quantity
                         </div>
                        <div class="col-6">
                            <input type="text" id="set_qty" class="form-control my-1" placeholder="Set Quantity">
                        </div>
                        <br>
                     </div>
                     <div class="row">
                        <div class="col-2">
                            Booklet No
                         </div>
                         <div class="col-6">
                            <input type="text" id="booklet_no" class="form-control my-1" placeholder="Booklet# Start">
                        </div>
                        <br>
                     </div>
                     <div class="row">
                        <div class="col-2">
                            Series Start
                         </div>

                        <div class="col-6">
                            <input type="text" id="series_start" class="form-control my-1" placeholder="Series Start">
                        </div>
                        <br>
                     </div>
                     <div class="row">
                        <div class="col-2">
                            Series End
                         </div>
                        <div class="col-6">
                            <input type="text" id="series_end" class="form-control my-1" placeholder="Series End">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                        </div>
                          <div class="col-6">
                            <button class="btn btn-success" onclick="generateItems()" id="generate"> Generate </button>
                          </div>
                    </div>
                </div>
                {{-- end table --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal end --}}


@endsection

@section('script')
    <script>

        let items    =   [];
        let summary =   [];
        let item_id =   $("#item").val();
        let description =    $('#item option:selected').text()
        let set_qty =   $("#set_qty").val();
        let booklet =   $("#booklet_no").val();
        let series_start    =   $("#series_start").val();
        let series_end      =   $("#series_end").val();


    let receiving_items_summary_tbl = $("#receiving_items_summary").DataTable({
        responsive: false,
        Destroy: true,
        paging: false,
        searching: false,
        scrollX: true,
        columns: [
            {
                data: null,
                title: "<b>Description</b>",
                render: function (data, type, row, meta) {
                    return `<b>${data.description} </b>`;
                },
            },
            {
                data: null,
                title: "<b class='text-nowrap'>Received Qty </b>",
                render: function (data, type, row) {
                    return `<b><input type="number" min="0" value="${data.rec_qty}"  class="form-control" onchange='' "></b>`;
                },
            },
            {
                data: null,
                title: "<b class='text-wrap'> BKT No. </b>",
                render: function (data, type, row) {
                    let json = JSON.stringify(row);
                    return `<b class='text-primary'>${data.bkt_no}</b>`;
                },
            },
            {
                data: null,
                title: "<b> Copy per Set </b>",
                render: function (data, type, row) {
                    return `<b class='text-primary'><input id="" type="number" value="${data.copy_qty}" class="form-control"></b>`;
                },
            },
            {
                data: null,
                title: "<b> SERIES START </b>",
                render: function (data, type, row) {
                    let json = JSON.stringify(row);
                    return `<b class='text-primary'><input type="number" value="${data.series_start}" onchange="" value="4"  id=""  class="form-control"></b>`;
                },
            },
            {
                data: null,
                title: "<b> SERIES END </b>",
                render: function (data, type, row) {
                    return `<b class='text-primary' id="series_end${data.id}">${data.series_end}</b>`;
                },
            },
            {
                data: null,
                title: "<b> Action </b>",
                render: function (data, type, row) {
                    let html = `<b onclick='RemoveReceive(${JSON.stringify(
                        row
                    )})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>`;

                    html += `<b data-toggle='modal' onclick='CustomAdd(${JSON.stringify(
                        row
                    )})' data-target='#custom_add' type="button" ><i class="btn ki ki-plus icon-1x text-success"></i></b>`;

                    return html;
                },
            },
        ],
        columnDefs: [
            {
                targets: [0],
                className: "text-nowrap col-1",
            },
            {
                targets: [1],
                className: "text-nowrap col-1",
            },
            {
                targets: [2],
                className: "text-nowrap col-1",
            },
            {
                targets: [3],
                className: "text-wrap col-1",
            },
            {
                targets: [4],
                className: "text-wrap col-1",
            },
            {
                targets: [5],
                className: "text-nowrap col-1",
            },
            {
                targets: [6],
                className: "text-nowrap col-1",
            }
        ],
    });

    let receiving_items_tbl = $("#receiving_items").DataTable({
        responsive: false,
        Destroy: true,
        paging: true,
        searching: false,
        scrollX: true,
        columns: [
            {
                data: null,
                title: "<b>Quantity</b>",
                render: function (data, type, row, meta) {
                    return `<b>${data.quantity} </b>`;
                },
            },
            {
                data: null,
                title: "<b class='text-nowrap'> Units </b>",
                render: function (data, type, row) {
                    return `<b>${data.unit}</b>`;
                },
            },

            {
                data: null,
                title: "<b>Description</b>",
                render: function (data, type, row) {
                    return `<b class='text-primary'>${data.description}</b>`;
                },
            },
            {
                data: null,
                title: "<b>Set Per Item</b>",
                render: function (data, type, row) {
                    return `<b class='text-primary'>${data.set_qty}</b>`;
                },
            },
            {
                data: null,
                title: "<b> Booklets </b>",
                render: function (data, type, row) {
                    return `<b class='text-primary'>${data.booklet}</b>`;
                },
            },
            {
                data: null,
                title: "<b> SERIES START </b>",
                render: function (data, type, row) {
                    return `<b class='text-primary'>${data.start}</b>`;
                },
            },
            {
                data: null,
                title: "<b> SERIES END </b>",
                render: function (data, type, row) {
                    return `<b class='text-primary'>${data.end}</b>`;
                },
            },
            {
                data: null,
                title: "<b> Action </b>",
                render: function (data, type, row) {
                    return `<b onclick='removeItem(${JSON.stringify(
                        row
                    )})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>`;
                },
            },
        ],
        columnDefs: [
            {
                targets: [0],
                className: "text-nowrap col-1",
            },
            {
                targets: [1],
                className: "text-nowrap col-1",
            },
            {
                targets: [2],
                className: "text-nowrap col-1",
            },
            {
                targets: [3],
                className: "text-nowrap col-1",
            },
            {
                targets: [4],
                className: "text-nowrap col-1",
            },
            {
                targets: [5],
                className: "text-nowrap col-1",
            },
            {
                targets: [6],
                className: "text-nowrap col-1",
            },
            {
                targets: [7],
                className: "text-nowrap col-1",
            },
        ],
    });

    function renderreceivingItemsSummaryTable(data){
        receiving_items_summary_tbl.search("").columns().search("").clear().draw();
        receiving_items_summary_tbl.rows.add(data).draw(true);
    }

    function renderReceivingItemsTable(data){
        receiving_items_tbl.search("").columns().search("").clear().draw();
        receiving_items_tbl.rows.add(data).draw(true);
    }

    function generateItems(){
        try {
        let item_id       =   $("#item").val();
        let description   =   $('#item option:selected').text()
        let set_qty       =   $("#set_qty").val();
        let booklet       =   $("#booklet_no").val();
        let series_start  =   $("#series_start").val();
        let series_end    =   $("#series_end").val();

        //
        //

        let series_count =  (parseInt(series_end) - parseInt(series_start)) + 1;
        let booklet_count = series_count/ parseInt(set_qty);
        let last_series = 0;


        for(let i = 0; last_series < parseInt(series_end);i++ ){

            if (last_series >= parseInt(series_end)) {
                break;
            }

            let item={};
            item.quantity = 1;
            item.unit = 'pads';
            item.id = parseInt(item_id);
            item.description = description;
            item.set_qty = parseInt(set_qty);
            item.booklet = parseInt(booklet)+i;
            item.start = i==0 ? parseInt(series_start):(last_series + 1);
            item.end =  item.start+(parseInt(set_qty)-1);
            last_series= item.end;

            items.push(item);

        }

        renderReceivingItemsTable(items);
        GenerateSummary(items);
        resetvalues();

        } catch (error) {
            console.log(error);

        }
    }

    function resetvalues(){
        $("#item").val('');
        $("#set_qty").val('');
        $("#booklet_no").val('');
        $("#series_start").val('');
        $("#series_end").val('');
    }

    function GenerateSummary(data){
        try{
        let uniqueid = [...new Set(data.map(item => item.id))];
        let filter_booklets = [];
         summary=[];

        console.log(uniqueid);

       for (let i = 0; i < uniqueid.length; i++) {
            let row={};

            filter_booklets = data.filter(function (item) {
                return item.id === uniqueid[i];
            });
            console.log(i);


            columnValues = filter_booklets.map(item => item.booklet)
            booklets_list = columnValues.join(', ');

            row.item_id = filter_booklets[i].id;
            row.description = filter_booklets[i].description;
            row.rec_qty = filter_booklets.length;
            row.copy_qty = filter_booklets[i].set_qty;
            row.series_start = filter_booklets[0].start;
            row.series_end = filter_booklets[ filter_booklets.length - 1].end;
            row.bkt_no = booklets_list;
            summary.push(row);

       }
        console.log(summary);

       renderreceivingItemsSummaryTable(summary);
        }catch(error){
            console.log(error);

        }


    }

    function SubmitReceivingOrigin(event){
        event.preventDefault();
        var form = event.target; // Get the form element
        var formData = new FormData(form);

        formData.append("items", JSON.stringify(items));

        axios
        .post("/add-receiving-origin", formData)
        .then(function (response) {
            Swal.fire("Created Successfully", response.data, "success");
            form.reset();
            $("#btn-save").prop("disabled", false);
        })
        .catch(function (error) {
            Swal.fire({
                title: "ERROR",
                text: error,
                icon: "error",
            });
        });

    }






    </script>
@endsection
