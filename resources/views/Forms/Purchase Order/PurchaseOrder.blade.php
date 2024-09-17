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
                            <a href="#" class="text-primary font-size-h4"> Create Purchase Order </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid"  id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <!--begin::Form-->
                                    <div class="form-group row">
                                        <h3 class=" col-6 mb-5 font-weight-bold text-dark">
                                            Create Purchase Order
                                            <i class="flaticon-edit-1 icon-2x text-success"></i>
                                        </h3>
                                    </div>

                                    {{-- form  --}}
                                    <form class="my-5" action="#" onsubmit="SubmitPO(event)" method="get">
                                        <div class="row my-5">
                                            <span class="col-1"></span>

                                            <label class="col-2" for="">PO No.:</label>
                                            <span class="col-5">
                                                <input class="form-control" name="po_no" type="text" required>
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>

                                            <label class="col-2" for="">Supplier:</label>

                                            <span class="col-5">
                                                <select class="form-control" onchange="onchangeSupplier(this.value)"
                                                    name="supplier" id="suppplier" type="text" required>
                                                    <option value="" selected disabled>Select Supplier</option>
                                                    @foreach ($supplier->GetAllSupplier() as $res)
                                                        <option data-address="{{ $res->address }}"
                                                            data-term="{{ $res->term }}" value="{{ $res->id }}">
                                                            {{ $res->supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Address:</label>
                                            <span class="col-5">
                                                <input class="form-control" id="address" name="address" type="text"
                                                    readonly>
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <span class="col-1"></span>
                                            <label class="col-2" for="">Term:</label>
                                            <span class="col-5">
                                                <select class="form-control" id="term" name="term" type="text">
                                                    <option value="" selected disabled></option>
                                                    <option value="1">Full Payment</option>
                                                    <option value="2">Payment On Delivery</option>
                                                </select>
                                            </span>

                                        </div><br>

                                        {{-- this is the add data to the table --}}
                                        <button data-toggle='modal' data-target='#req_list' type="button"
                                            class="btn btn-success font-weight-bolder mr-2">
                                            Add <i class="flaticon-add icon-lg"></i>
                                        </button><br>
                                        {{-- end --}}

                                        {{-- start table --}}
                                        <table
                                            class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                            style="text-align: center" id="po_items">
                                        </table>

                                        <div class="row my-5">
                                            {{-- <div class="col-2">Requesting Branch:</div> --}}
                                            <div class="col-10">
                                                <input type="hidden" id="requesters" name="requesters"
                                                    class="form-control" />
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-2">Remarks:</div>
                                            <div class="col-10">
                                                <textarea name="remarks" id="" class="form-control" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                        {{-- end --}}
                                        <br>
                                        <input value="{{ session()->get('user')->id }}" name="prepared_by_id" type="hidden"
                                            class="form-control" />
                                        <input value="{{ session()->get('user')->branch }}" name="po_branch" type="hidden"
                                            class="form-control" />
                                        <hr>

                                        <input id="btn-submit" type="submit" name='submit' value="submit"
                                            class="btn btn-success" />

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
                    <h5 class="modal-title text-success" id="exampleModalLabel"> Branch Purchase Request
                        <i class="flaticon-notes icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">

                    <table
                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                        style="text-align: center" id="req_table">
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
    {{-- modal end --}}
@endsection

@section('script')
    <script>
        let po_items = [];
        let req_items = [];

        let formData = new FormData();
        let po_table = $('#po_items').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            info:false,
            columns: [{
                    data: null,
                    title: "<b>Quantity</b>",
                    render: function(data, type, row, meta) {
                        return `<b>${data.quantity} ${data.unit}</b>`;
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


                        return `<b class='text-primary'>${data.classification }</b>`;
                    }
                },
                {
                    data: "BranchName",
                    title: "<b> Branch/Dept </b>"
                },
                {
                    data: null,
                    title: `<b> Date</b>`,
                    render: function(data, type, row) {
                        return `<b>${moment(data.created_at).format("MMMM DD, YYYY HH:mm A") }</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function(data, type, row) {
                        return `<b onclick='setReqList(${JSON.stringify(row)})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>`;
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
                },
                {
                    targets: [6],
                    className: "text-nowrap col-1"
                }

            ]
        });
        $('#req_list').on('shown.bs.modal', function() {
            // Initialize or redraw the DataTable here
            $('#req_table').DataTable().draw();
        });
        let req_table = $('#req_table').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: true,
            scrollX: true,
            info:false,
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
                                </div>

                                <div>
                                    <span><b class='text-nowrap text-warning font-size-h6'>${data.quantity} ${data.unit}</b></span></br>
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

                            <div style="text-align: left;" class='d-flex align-items-center'>
                                <div>
                                    <span><span class='text-dark font-size-h4'><b class='text-success'>${data.req_no}</b>::${data.description}</span></br>
                                     <span class="label label-info label-inline mr-2">Request Date: ${moment(data.created_at).format("MMMM DD, YYYY HH:mm A")} </span>
                                     <span class="label label-primary label-inline mr-2">Classification: ${data.classification}</span></br>
                                     <span class="label label-success label-inline mr-2">From: ${data.BranchName} </span>

                                </div>
                            </div>
                      `;

                    }

                },
                {
                    data: null,
                    render: function(data, type, row, index) {


                        return `<b class="text-success" onclick='setPOList(${JSON.stringify(row)})'><i class="btn ki ki-solid-plus icon-2x text-success"></i><b>`;
                    }
                }

            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-wrap col-1 "
                },
                {
                    targets: [1],
                    className: "text-wrap col-10"
                },
                {
                    targets: [2],
                    className: "text-wrap col-1"
                }

            ]
        });

        function setReqList(row) {
            req_items.push(row);
            req_table.search('').columns().search('').clear().draw();
            req_table.rows.add(req_items).draw(true);
            // Now, you can remove the item from po_items as follows:

            let index = po_items.findIndex(item => item.id === row.id);

            if (index !== -1) {
                po_items.splice(index, 1);
                po_table.search('').columns().search('').clear().draw();
                po_table.rows.add(po_items).draw(true);
            }

        }

        function setPOList(row) {
            po_items.push(row);
            po_table.search('').columns().search('').clear().draw();
            po_table.rows.add(po_items).draw(true);

            let index = req_items.findIndex(item => item.id === row.id);
            let requesters = $("#requesters").val();
            let branches = "";

            if (index !== -1) {
                req_items.splice(index, 1);
                req_table.search('').columns().search('').clear().draw();
                req_table.rows.add(req_items).draw(true);
            }
            let uniqueBranchNames = po_items.reduce((uniqueNames, entry) => {
                if (!uniqueNames.includes(entry.BranchName)) {
                    uniqueNames.push(entry.BranchName);
                    if (uniqueNames.lenght > 0) {
                        branches = entry.BranchName + ", " + branches;
                    } else {
                        branches = entry.BranchName;
                    }

                }
                return uniqueNames;
            }, []);

            console.log(uniqueBranchNames);
            $("#requesters").val(branches);

        }

        function onchangeSupplier(select) {
            $("#address ").val($("#suppplier option:selected").data("address"));
            $("#term").val($("#suppplier option:selected").data("term"));

        }

        function SubmitPO(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form);
            formData.append("po_items", JSON.stringify(po_items));
            $("#btn-save").prop("disabled", true);

            axios.post('/add-purchase-order', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    $("#btn-save").prop("disabled", false);
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });
        }

        function getRequisitions() {
            axios.get('/for-purchase-order').then(function(response) {
                req_items = response.data;
                req_table.search('').columns().search('').clear().draw();
                req_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }


        $(document).ready(async function() {
            getRequisitions();

        });
    </script>
@endsection
