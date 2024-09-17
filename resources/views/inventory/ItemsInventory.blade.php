@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Accountable Forms Invertory </h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">
                            <a href="#" class="text-primary"> Inventory List </a>
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

                            <div class="card-header align-items-center flex-wrap py-5 h-auto">
                                <div class="col-xxl-3 d-flex order-1 order-xxl-2 align-items-center justify-content-center">
                                    <div class="input-group input-group-lg input-group-solid my-2">
                                        <input type="text" class="form-control pl-4" id="searchInput"
                                            placeholder="Search..." />
                                        <div class="input-group-append">
                                            <span class="input-group-text pr-3">
                                                <span class="svg-icon svg-icon-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            <path
                                                                d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-xxl-8 order-2 order-xxl-3 d-flex align-items-center justify-content-sm-end text-right my-2">
                                    <div class="d-flex align-items-center mr-2" data-toggle="tooltip"
                                        title="Records per page">
                                        <span class="text-muted font-weight-bold mr-2" data-toggle="dropdown"
                                            id="page">page 1</span>
                                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                            <ul class="navi py-3">
                                                <li onclick="setpageSize(10)" class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">10 per page</span>
                                                    </a>
                                                </li>
                                                <li onclick="setpageSize(20)" class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">20 per page</span>
                                                    </a>
                                                </li>
                                                <li onclick="setpageSize(50)" class="navi-item">
                                                    <a href="#" class="navi-link ">
                                                        <span class="navi-text">50 par page</span>
                                                    </a>
                                                </li>
                                                <li onclick="setpageSize(100)" class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">100 per page</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <span class="btn btn-default mr-2" onclick="setpage(-1)" data-toggle="tooltip"
                                        title="Previous page">
                                        <i class="ki ki-bold-arrow-back icon-sm"></i> Previous
                                    </span>
                                    <span class="btn btn-default mr-2" onclick="setpage(1)" data-toggle="tooltip"
                                        title="Next page">
                                        Next <i class="ki ki-bold-arrow-next icon-sm"></i>
                                    </span>
                                    <span onclick="getTickets()" class="btn btn-default mr-2" data-toggle="tooltip"
                                        title="Reload list">
                                        Reload <i class="ki ki-refresh icon-sm"></i>
                                    </span>
                                    <div class="dropdown mr-2" data-toggle="tooltip" title="Sort">
                                        <span class="btn btn-default" data-toggle="dropdown">
                                            Sort<i class="flaticon2-console icon-1x"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                            <ul class="navi py-3">
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link active">
                                                        <span onclick="filterDatabyOldest()" class="navi-text">Newest to
                                                            Oldest</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span onclick="filterDatabyNewest()" class="navi-text">Olders to
                                                            Newest</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dropdown mr-2" data-toggle="tooltip" title="Filter">
                                        <span class="btn btn-default" data-toggle="dropdown">
                                            Filter <i class="ki ki-bold-arrow-down icon-sm"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                            <ul class="navi py-3">
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link" onclick="set_filter(0)">
                                                        <span class="navi-text"> All </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link" onclick="set_filter(1)">
                                                        <span class="navi-text"> Assigned </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link" onclick="set_filter(2)">
                                                        <span class="navi-text"> UnAssigned </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dropdown mr-2" data-toggle="tooltip" title="Filter">

                                        <span class="btn btn-default " data-toggle="dropdown">
                                            Status <i class="ki ki-bold-arrow-down icon-sm"></i>
                                        </span>
                                        {{-- asds --}}
                                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-sm">
                                            <ul class="navi py-3">
                                                <li class="navi-item">
                                                    <a onclick="FilterDatabyStatus(0)" href="#" class="navi-link">
                                                        <span class="navi-text"> All </span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                    <div class="dropdown" data-toggle="tooltip" title="Settings">
                                        <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
                                            <i class="ki ki-bold-more-hor icon-1x"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-md">
                                            <ul class="navi navi-hover py-5">
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-list-3"></i>
                                                        </span>
                                                        <span class="navi-text"> Generate Report </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <table
                                    class="table table-bordered table-sm table-head-custom table-checkable table-hover dataTable dtr-inline"
                                    style="width:100%; text-align: center" id="inventory_list">
                                </table>
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
                    <h5 class="modal-title text-success" id="exampleModalLabel">Employees <i
                            class="flaticon-avatar icon-lg text-success"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">

                    <form onsubmit="SubmitAssignee(event)" method="post">
                        @csrf
                        <label for="">Employees: </label>
                        <select name="assignee" id="employees" class="form-control" required>
                            <option value=""></option>
                        </select>
                        <input type="hidden" name="item_id" id="item_id">
                        <br>
                        <input id="assign-btn" class="btn btn-success" type="submit" value="Assign">
                    </form>

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
        let req_items = [];
        let formData = new FormData();
        let inventory = [];
        let renderdata = [];
        let paginatedData=[];
        let page=1;
        let pageSize=10;
        let inventory_table = $('#inventory_list').DataTable({
            responsive: false,
            Destroy: false,
            paging: false,
            searching: false,
            scrollX: true,
            columns: [{
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
                    title: "<b>Requester Dept.</b>",
                    render: function(data, type, row, meta) {
                        return `<b class='text-primary'>${data.Requester} </b>`;
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
                    title: "<b> Status </b>",
                    render: function(data, type, row) {
                        return `<b class='text-success' > ${data.state}</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Assignee </b>",
                    render: function(data, type, row) {
                        if (data.status == 11) {
                            if (data.requester_id == data.current_location) {
                                if (data.first_name == null) {
                                    return `<button  data-toggle='modal' data-target='#req_list' class='btn btn-success' onclick='setIDValue(${data.id})'> <i class="flaticon-avatar icon-lg"></i></button>`;
                                } else {
                                    return `<b class='text-warning' > ${ data.first_name }</b>`;
                                }
                            } else {
                                return `<b class = 'text-info' >For Transfer to ${data.Requester}</b>`;
                            }
                        } else {
                            return `<b class = 'text-info' >Waiting For Approval...</b>`;

                        }
                    }
                }
            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-wrap col-1"
                },
                {
                    targets: [1],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [2],
                    className: "text-wrap col-1"
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
                },
                {
                    targets: [6],
                    className: "text-wrap col-1"
                }
            ]
        });
        //
        // paging
        function setpage(num){
            page=(page+num)<1? 1:page+num;
            renderInventory(renderdata,page,pageSize);
        }

        function setpageSize(num){
            pageSize=num;
            renderInventory(renderdata,page,num);
        }

        function getInventory() {
            axios.get(`/get-inventory/{{ session()->get('user')->branch }}`).then(function(response) {
                inventory = response.data;
                renderInventory(response.data, page, pageSize);
            }).catch(function(error) {});
        }

        function setIDValue(id) {
            $('#item_id').val(id);
        }

        function renderInventory(data, page, pageSize){
            let startIndex = (page - 1) * pageSize;
            let endIndex = startIndex + pageSize;
            paginatedData = data.slice(startIndex, endIndex);
            renderdata=data;

            $(`#page`).html("page "+page);
            ///
            let currentPageIndex = inventory_table.page.info().page
            inventory_table.search('').columns().search('').clear().draw();
            inventory_table.rows.add(paginatedData).draw(true);
            inventory_table.page(currentPageIndex).draw(false);
        }

        function renderEmployees(data) {
            data.forEach((item) => {
                $('#employees').append(`<option value="${item.id}">${item.first_name} ${item.last_name}</option>`);
            });
        }

        function SubmitAssignee(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form);

            $("#assign-btn").prop("disabled", true);
            axios.post('/assign-item', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    getInventory();
                    $("#assign-btn").prop("disabled", false);
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });
        }

        function getEmployee() {
            axios.get(`/get-employee/{{session()->get('user')->branch}}`).then(function(response) {
                renderEmployees(response.data);
            }).catch(function(error) {});
        }





        $(document).ready(async function() {
            getInventory();
            getEmployee();
        });
    </script>
@endsection
