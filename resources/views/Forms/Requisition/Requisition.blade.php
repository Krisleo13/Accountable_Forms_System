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
                            <a href="#" class="text-primary font-size-h4">
                                Create Request
                            </a>
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
                                    <form class="form" id="ticket_create_form" method="POST"
                                        onsubmit="SubmitRequisition(event)" action="#" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row pb-10">
                                            <div class="col-xl-12">
                                                <div class="form-group row">
                                                    <h3 class=" col-6 mb-5 font-weight-bold text-dark">
                                                        Create Purchase Request
                                                        <span
                                                            class="svg-icon svg-icon-warning svg-icon-2x col-1"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Share.svg--><svg
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
                                                <hr>

                                                <div class="row my-5">
                                                    <span class="col-2"></span>
                                                    <label class="col-2 font-weight-bold" for=""><b>To:</b></label>
                                                    <span class="col-5">
                                                        <select class="form-control" name="to" type="text" required>
                                                            @foreach ($department->GetDeparment() as $res)
                                                                @if ($res->role == 1)
                                                                    <option value="{{ $res->id }}">
                                                                        {{ $res->BranchName }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>

                                                <div class="row my-5">
                                                    <span class="col-2"></span>
                                                    <label class="col-2 font-weight-bold"
                                                        for="attn"><b>Attn:</b></label>
                                                    <span class="col-5">
                                                        <input class="form-control " name="attn" type="text" />
                                                    </span>
                                                </div>
                                                <button data-toggle='modal' data-target='#AddItem' type="button"
                                                    class="btn btn-primary mr-2"> Add Item <i
                                                        class="flaticon-add-circular-button icon-lg"></i>
                                                </button>
                                                <table
                                                    class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                                                    style="text-align: center" id="req_id">
                                                </table>
                                                <br>
                                                <br>
                                                <br>

                                                <div class="row">
                                                    <div class="col-2">Remarks</div>
                                                    <div class="col-10">
                                                        <textarea name="remarks" id="" class="form-control" cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between border-top mt-5 pt-20">
                                            <button type="submit"
                                                class="btn btn-light-success font-weight-bolder text-uppercase px-9 py-4 mr-2">
                                                Submit </button>
                                            <input type="hidden" name="from"
                                                value="{{ session()->get('user')->branch }}">
                                            <input type="hidden" name="prepared_by_id"
                                                value="{{ session()->get('user')->id }}">
                                            <input type="hidden" name="status" value="1">
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
    {{-- modal add item --}}
    <div class="modal fade" id="AddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Add Item <i
                            class="text-success flaticon-add-circular-button icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}
                <div class="modal-body">
                    <div class="">
                        <div class="row my-2">
                            <span class="col-2">
                            </span>
                            <span class="col-3">
                                <b>Quantity:</b>
                            </span>
                            <span class="col-5">
                                <input id="qty" class="form-control " placeholder="Quantity..." type="number">
                            </span>
                        </div>
                        <div class="row my-2">
                            <span class="col-2">
                            </span>
                            <span class="col-3">
                                <b>Last Series No:</b>
                            </span>
                            <span class="col-5">
                                <input id="series_no" class="form-control " placeholder="Last Series No..."
                                    type="text">
                            </span>
                        </div>
                        <div class="row my-2">
                            <span class="col-2">
                            </span>
                            <span class="col-3">
                                <b> Description:</b>
                            </span>
                            <span class="col-5">
                                <select id="descript" onchange="onchangeitem(this)" class="form-control "
                                    placeholder="Description...">
                                    <option value=""></option>
                                    @foreach ($items->GetItems() as $res)
                                        <option data-cost="{{ $res->cost }}" data-units="{{ $res->unit }}"
                                            data-code="{{ $res->classification }}" value="{{ $res->id }}">
                                            {{ $res->description }}</option>
                                    @endforeach
                                </select>
                            </span>
                        </div>


                        <div class="row my-2">
                            <span class="col-2">
                            </span>
                            <span class="col-3">
                                <b> Unit per Item:</b>
                            </span>
                            <span class="col-5">
                                <input id="units" class="form-control " placeholder="Units..." type="text"
                                    readonly>
                            </span>
                        </div>
                        <div class="row my-3">
                            <span class="col-2">
                            </span>
                            <span class="col-3">
                                <b>Item Group:</b>
                            </span>
                            <span class="col-5">
                                <input id="group" class="form-control " placeholder="Group..." type="text"
                                    readonly>
                            </span>
                        </div>
                        <br>

                        <span style="padding-left: 50%; padding-right: 50%" class="col-2">
                            <button onclick="Additem()" type="button" class="btn btn-success">Add</button>
                        </span>
                        {{-- content end --}}
                        <br>
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
                    title: "<b>Quantity</b>",
                    render: function(data, type, row, meta) {
                        return `<b>${data.quantity}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Units </b>",
                    render: function(data, type, row) {
                        return `<b>${data.units}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Description </b>",
                    render: function(data, type, row) {
                        return `<b>${data.description}</b>`;
                    }
                },

                {
                    data: null,
                    title: "<b>Series</b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'>${data.series_no }</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Group </b>",
                    render: function(data, type, row) {

                        return `<b class='text-primary'>${data.group }</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function(data, type, row) {

                        return `<b onclick='removeitem(${JSON.stringify(row)})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>`;
                    }
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

        function Additem() {
            // Get form data
            let details = {};
            details['id'] = req_items.lenght;
            details['quantity'] = $("#qty").val();
            details['units'] = $("#descript option:selected").data("units");
            details['description'] = $("#descript option:selected").text();
            details['description_id'] = $("#descript").val();
            details['series_no'] = $("#series_no").val();
            details['group'] = $("#group").val();
            details['cost'] = $("#descript option:selected").data("cost");

            $("#qty").val("");
            $("#units").val("");
            $("#descript").val("");
            $("#series_no").val("");
            $("#group").val("");

            req_items.push(details);
            setDetailList(req_items);

        }

        function removeitem(row) {
            // Get form data
            let index = req_items.find(record => record.id === row.id);

            if (index !== -1) {
                req_items.splice(index, 1);
                requisition_table.search('').columns().search('').clear().draw();
                requisition_table.rows.add(req_items).draw(true);
            }



        }

        function setDetailList(list) {
            requisition_table.search('').columns().search('').clear().draw();
            requisition_table.rows.add(list).draw(true);

        }

        function onchangeitem(select) {
            $("#units").val($("#descript option:selected").data("units"));
            $("#group").val($("#descript option:selected").data("code"));

        }

        function SubmitRequisition(event) {
            // disable the page

            disablePage();
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form);
            formData.append("orderline_items", JSON.stringify(req_items));
            $("#btn-save").prop("disabled", true);

            axios.post('/add-requisition', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    setDetailList(req_items = []);
                    $("#btn-save").prop("disabled", false);
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error.message,
                        icon: 'error'
                    })
                }).finally(function() {
                    // Enable the page after a response or error
                    enablePage();
                });;
        }


        $(document).ready(async function() {
            // getMytickets();
        });
    </script>
@endsection
