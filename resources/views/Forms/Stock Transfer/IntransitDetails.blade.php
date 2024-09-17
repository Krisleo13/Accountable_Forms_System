@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Accountable Forms Invertory </h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">

                            <a href="#" class="text-primary"> Requisition Details </a>
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
                <div class="d-flex flex-column flex-md-row">

                    <div class="flex-md-row-fluid">
                        <div class="card card-custom gutter-b" id="kt_todo_view">
                            <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                                <div class="d-flex align-items-center my-2">
                                    <div class="d-flex align-items-center">

                                        <div class="symbol symbol-light-primary symbol-40 mr-3">
                                            <span class="symbol-label font-weight-bolder">
                                                {{ $intransit->from_department_code }}
                                            </span>
                                        </div>

                                        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">

                                            <div class="d-flex">
                                                <span
                                                    class="cursor-pointer font-size-h4 font-weight-bolder text-dark-75 text-danger">
                                                    <b id="tcode"> {{ $intransit->Intransit_no }} </b>
                                                </span>
                                                <span onclick="copyToClipboard()" class="btn-mute" id="copy">
                                                    <i class="ki ki-copy icon-md"></i>
                                                </span>
                                                <div class="font-weight-bold text-muted">
                                                    <span class="label label-success label-dot mr-2"></span>
                                                    {{--                                                    {{ Carbon\Carbon::parse($requisition->created_at)->diffForHumans() }} --}}
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column">
                                                <div class="toggle-off-item">
                                                    <span class="font-weight-bold text-muted cursor-pointer"
                                                        data-toggle="dropdown"> {{ $intransit->from_department }} To
                                                        {{ $intransit->to_department }}
                                                        <i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
                                                    <div class="dropdown-menu col-6 dropdown-menu-left p-5">
                                                        <table>
                                                            <tr>
                                                                <td class="text-muted py-2"> From: </td>
                                                                <td class="pl-5">{{ $intransit->from_department }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted py-2"> To </td>
                                                                <td class="pl-5"> {{ $intransit->to_department }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted py-2"> Delivered at: </td>
                                                                <td class="pl-5">
                                                                    {{ Carbon\Carbon::parse($intransit->created_at)->format('M d, Y H:m A') }}

                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end text-right my-2">
                                    <div   class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x pt-4">
                                        <div class="d-flex align-items-center py-1">


                                        {{-- buttons --}}
                                        @if ($intransit->status == 13 && $intransit->from_dept == session()->get('user')->branch &&  session()->get('user')->branch_manager == 1)
                                            <button data-toggle='modal' data-target='#approved_data' type="button"
                                                class="btn btn-warning mr-2">
                                                Approval <i class="flaticon-like icon-lg"></i>
                                            </button>
                                        @endif

                                        @if ($intransit->status == 10 && $intransit->to_dept == session()->get('user')->branch && session()->get('user')->branch_manager == 1)
                                            <button data-toggle='modal' data-target='#receiving_approved_data'
                                                type="button" class="btn btn-warning mr-2">
                                                Finalize <i class="flaticon-like icon-lg"></i>
                                            </button>
                                        @endif

                                        @if ($intransit->status != 14 && $status->stage == 4)
                                            @if ($intransit->status == 12 && $intransit->from_dept == session()->get('user')->branch)
                                                <button data-toggle='modal' data-target='#Update_data' type="button"
                                                    class="btn btn-primary mr-2">
                                                    Update <i class="flaticon-edit-1 icon-lg"></i>
                                                </button>
                                            @endif

                                            @if ($intransit->status == 12 && $intransit->prepared_id == session()->get('user')->branch)
                                                <button data-toggle='modal' data-target='#add_item' type="button"
                                                    class="btn btn-success mr-2">
                                                    Add Items <i class="flaticon-add-circular-button icon-lg"></i>
                                                </button>
                                            @endif
                                        @endif

                                        @if ($intransit->status == 10 || $intransit->status == 12 ||($intransit->status == 15 && $intransit->from_dept == session()->get('user')->branch))
                                            <button data-toggle='modal' data-target='#UpdateStatus' type="button"
                                                class="btn btn-primary mr-2">
                                                {{ $intransit->state }} <i class="flaticon-edit-1 icon-lg"></i>
                                            </button>
                                        @else
                                            <span
                                                class="label label-lg label-light-success label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                data-toggle="tooltip" data-placement="bottom" title="In-transit Status">
                                                {{ $intransit->state }}
                                            </span>
                                        @endif
                                        {{-- buttons end --}}


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="pb-10">
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x pt-4">
                                        <div class="d-flex flex-column mr-2 py-2">
                                            <a class="text-dark font-weight-bold font-size-h4 mr-3">
                                                {{-- TICKET_SUBJECT --}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="my-0">
                                        <div class="card-spacer-x pt-2">
                                            {{-- purpose --}}

                                            {{-- purpose --}}
                                            {{-- summary tables --}}
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <table
                                                        class=" table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                        style="text-align: center" id="stocktransfer_summary">
                                                    </table>
                                                </div>
                                                <br>
                                            </div>
                                            {{-- stock transfer items list --}}
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <table
                                                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                        style="text-align: center" id="stocktransfer_items">
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- end body --}}
                                            <button onclick="updateItems()" class="btn btn-success" id="update-item"  type="button">
                                                Update
                                            </button>

                                            @if ($intransit->to_dept == session()->get('user')->branch)
                                                <button onclick="UpdateIntransitReceivingDetails()"
                                                    class="btn btn-warning" id="received-item" type="button">Received
                                                    Items</button>
                                            @endif
                                            <br>+
                                            </h3>
                                             <b style="white-space: pre-wrap;font-family:inherit !important"
                                                class="font-size-lg">
                                                <h3>Remarks: {{ $intransit->purpose }}</h3>
                                            </b>
                                            {{-- assignatories --}}
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="font-weight-bolder text-warning">Assignatories <i
                                                        class="flaticon-edit icon-lg "></i> </span>
                                                <span class="text-muted mt-3 font-weight-bold font-size-sm" id="cnt_logs"></span>
                                            </h3>



                                        <div class="p-5 row">
                                            <div class="col-6">
                                                <p class="font-size-lg col-12">
                                                    Received By:
                                                </p>
                                                <div style="text-align: center;border-bottom: solid black 1px">
                                                    {{ $intransit->received_by }}
                                                </div>
                                                <div style="text-align: center;">
                                                    <b>
                                                        {{ $intransit->received_by_position }}
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <p class="font-size-lg col-12">
                                                    Prepared By:
                                                </p>
                                                <div style="text-align: center;border-bottom: solid black 1px">
                                                    {{ $intransit->prepared_by }}
                                                </div>
                                                <div style="text-align: center;">
                                                    <b>
                                                        {{ $intransit->prepared_by_position }}
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    <br>
                                        {{-- assignatories ends --}}
                                        <button onclick="resetItems()" class="btn btn-success" id="reset-item"
                                                type="button">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center card-spacer-x mb-3">
                                    <a href="#"
                                        class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                        <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                                        fill="#000000" />
                                                    <path
                                                        d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                                        fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        24
                                    </a>
                                    <span onclick="" class="btn btn-default btn-icon btn-sm mr-2"
                                        data-toggle="tooltip" title="Reload list">
                                        <i class="ki ki-refresh icon-sm"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="card-footer p-0">
                                <div class="mb-3 px-5 pt-5" id="div_comments"></div>
                                <div class="card-spacer">
                                    <form method="POST" id="comment-form" enctype='multipart/form-data' onsubmit="">
                                        <div class="row">
                                            <div id="comment" contenteditable="true" onkeypress=""
                                                class="form-control col-9" style="height: auto;"></div>
                                            <div class="col-3">
                                                <button id="comment-btn" type="submit"
                                                    class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">
                                                    COMMENT
                                                </button>
                                            </div>
                                        </div>
                                        <input id="attached" class="" type="file" name="files[]"
                                            id="customFile"
                                            accept="video/*,.jpg, .jpeg, .png, .pdf, .docx, .xlsx, .mp4, .mp3" multiple>
                                        <input id="ticket_id" name="tcode" value="TICKET_ID" type="hidden">
                                        <input type="hidden" name="uid" value='USER_ID' />
                                        <input type="hidden" name="tid" value="TICKET_ID" />
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="flex-md-row-auto w-md-275px w-xl-425px ml-md-6 ml-lg-8">
                        <div class="card card-custom gutter-b">

                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-warning"> Transmital Logs <i
                                            class="flaticon-time-2 icon-lg"></i> </span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm" id="cnt_logs"></span>
                                </h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="timeline timeline-justified timeline-4">
                                    <div class="timeline-bar"></div>
                                    <div style="max-height: 800px;overflow-y: auto" class="timeline-items"
                                        id="in-transit-logs"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modals --}}
    <div class="modal fade" id="UpdateStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Update Status <i
                            class="text-success flaticon-edit-1 icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}
                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="UpdateStatus(event)" method="post">
                        @csrf

                                <div class="row my-5">
                                    <label class="col-2 font-weight-bold"><b>Status: </b></label>
                                    <span class="col-8">
                                        <select class="form-control" name="status" type="text" required>
                                            <option value=""></option>
                                            @foreach ($status->getStatus() as $res)
                                                @if ($res->id != $intransit->status && ($res->id == 14))
                                                    <option value="{{ $res->id }}"> {{ $res->state }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </span>
                                </div>
                                <div class="row my-5">
                                    <label class="col-2 font-weight-bold" for=""><b>Remarks: </b></label>
                                    <span class="col-8">
                                        <textarea class="form-control" name="remarks" id="" cols="30" rows="10"></textarea>
                                    </span>
                                </div>
                                <div class="row my-5">
                                    <label class="col-4 font-weight-bold" for=""></label>
                                    <span class="col-6">
                                        <input type="submit" value="Submit" id="status_update"
                                            class=" btn btn-success">
                                        <input type="hidden" name="st_id" value="{{ $intransit->id }}">
                                        <input type="hidden" name="uid" value="{{ session()->get('user')->id }}">
                                    </span>
                                </div>
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
    {{-- add item modal --}}
    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Add Item <i
                            class="text-success ki ki-solid-plus icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">
                    <table
                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
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
    {{-- Approve modal --}}
    <div class="modal fade" id="approved_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Approve items <i
                            class="text-success flaticon-like icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="approveStockTransfer(event)" method="post">
                        @csrf
                        <div class="row my-5">
                            <label class="col-2 font-weight-bold"><b>Status: </b></label>
                            <span class="col-8">
                                <select class="form-control" name="status" type="text" required>
                                    <option value="12">Disapproved</option>
                                    <option value="14">Approved</option>
                                </select>
                            </span>
                        </div>

                        <div class="row my-5">
                            <label class="col-2 font-weight-bold" for=""><b>Remarks: </b></label>
                            <span class="col-8">
                                <textarea class="form-control" name="remarks" id="" cols="30" rows="10"></textarea>
                            </span>
                        </div>

                        <div class="row my-5">
                            <label class="col-4 font-weight-bold" for=""></label>
                            <span class="col-6">
                                <input type="submit" value="Submit" id="status_update" class=" btn btn-success">
                                <input type="hidden" name="st_id" value="{{ $intransit->id }}">
                                <input type="hidden" name="uid" value="{{ session()->get('user')->id }}">
                            </span>
                        </div>
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
    {{-- Receiving Approval modal --}}
    <div class="modal fade" id="receiving_approved_data" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Approve items <i
                            class="text-success flaticon-like icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}

                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="approveReceivingStockTransfer(event)" method="post">
                        @csrf

                        <div class="row my-5">
                            <label class="col-2 font-weight-bold"><b>Status:</b></label>
                            <span class="col-8">
                                <select class="form-control" name="status" type="text" required>
                                    <option value=""></option>
                                    <option value="9">Disapproved</option>
                                    <option value="11">Approved</option>
                                </select>
                            </span>
                        </div>

                        <div class="row my-5">
                            <label class="col-2 font-weight-bold" for=""><b>Remarks: </b></label>
                            <span class="col-8">
                                <textarea class="form-control" name="remarks" id="" cols="30" rows="10"></textarea>
                            </span>
                        </div>

                        <div class="row my-5">
                            <label class="col-4 font-weight-bold" for=""></label>
                            <span class="col-6">
                                <input type="submit" value="Submit" id="status_update" class=" btn btn-success">
                                <input type="hidden" name="st_id" value="{{ $intransit->id }}">
                                <input type="hidden" name="uid" value="{{ session()->get('user')->id }}">
                            </span>
                        </div>
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

    {{-- Update modal --}}
    <div class="modal fade" id="Update_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Update Details <i
                            class="text-successflaticon-edit-1 icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal body --}}
                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="updateStockTransferDetails(event)" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label"> In transit No.<i
                                    class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip"
                                    title="Require Field"></i></label>
                            <div class="col-lg-9 col-xl-9">

                                <input type="text" name="intransit_no" value="{{ $intransit->Intransit_no }}"
                                    class="form-control form-control-lg" id="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label"> Deliver Item to <i
                                    class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip"
                                    title="Require Field"></i></label>
                            <div class="col-lg-9 col-xl-9">
                                <select value="" name="to_branch" class="form-control form-control-lg"
                                    id="branch_department" style="width: 100%" required>
                                    <option value="" disabled selected> --Select Branch or Department-- </option>
                                    @foreach ($department->GetDeparment() as $res)
                                        @if (session()->get('user')->branch != $res->id)
                                            <option selected value="{{ $res->id }}"> {{ $res->BranchName }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="hidden" name="from_branch_department_name"
                                    class="form-control form-control-lg" id="from_branch_department_name"
                                    value="{{ session()->get('user')->BranchName }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label"> Purpose : <i
                                    class="fas fa-asterisk text-danger icon-xs" data-toggle="tooltip"
                                    title="Require Field"></i></label>
                            <div class="col-lg-9 col-xl-9">
                                <textarea class="form-control" name="purpose" id="purpose" cols="30" rows="10">{{ $intransit->purpose }}</textarea>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" value="Submit">
                        <input type="hidden" name="uid" value="{{ session()->get('user')->id }}">
                        <input type="hidden" name="st_id" value="{{ $intransit->id }}">
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
        let approved_items = [];
        let stocktransfer_summary = [];
        let stocktransfer_items = [];
        let del_stocktransfer_items = [];
        let new_stocktransfer_items = [];
        let status = 10;
        let remarks_for_Discripansy = ``;

        // tables
        let stocktransfer_summary_table = $('#stocktransfer_summary').DataTable({
            responsive: true,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            info:false,
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
        //
        let stocktransfer_items_table = $('#stocktransfer_items').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            info:false,
            columns: [{
                    data: null,
                    title: "<b class='col-1 text-wrap'>Details</b>",
                    render: function(data, type, row, meta) {
                        return `
                                <div style="width:30%" class="flex-grow-1 mt-2 mr-5">
                                    <span style="font-size:16px" class="font-weight-bolder font-size-lg mr-2"> <b class='text-dark'>${data.quantity} ${data.unit}</b> of ${data.description} <span class='text-success'>${data.code} </span> Bkt# ${data.booklet }: </span>
                                    <span class="">  </span>
                                    <div class="mt-3">
                                    <span  class="label label-info font-weight-bold label-inline text-wrap ml-5"><small style="font-size:12px"> Start: <strong> ${data.series_start} </strong></small></span>
                                    <span class="label label-info font-weight-bold label-inline text-nowrap ml-5"><small style="font-size:12px"> End: <strong> ${data.series_end} </strong></small></span>
                                    </div>
                                </div>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Status </b>",
                    render: function(data, type, row) {
                        if (!row.confirm || row.confirm == 0) {
                            return `<b class='text-primary'>Pending...</b>`;
                        } else {
                            return row.confirm == 19 ?
                                `<b class='text-success'>Received </b>` :
                                `<b class='text-danger'>Discrepancy</b>`;
                        }
                    }
                },
                 @if ($intransit->status == 12  && $intransit->from_dept == session()->get('user')->branch)
                    {
                        data: null,
                        title: "<b> Action </b>",
                        render: function(data, type, row) {
                            return row.confirm == 19 ?
                                `<b><i class="flaticon-calendar-3 icon-2x text-success"></i></b>`
                                :
                                `<b><i onclick='removeItem(${JSON.stringify(row)})' class="flaticon-cancel icon-2x text-danger"></i></b>`;
                        }
                    },
                @endif
                @if ( $intransit->status == 15 && $intransit->from_dept == session()->get('user')->branch)
                    {
                        data: null,
                        title: "<b> Action </b>",
                        render: function(data, type, row) {
                            return row.confirm == 19 ?
                                `<b><i class="flaticon-calendar-3 icon-2x text-success"></i></b>`
                                :
                                `<b><i class="flaticon-cancel icon-2x text-danger"></i></b>`;
                        }
                    },
                @endif

                @if (
                    $intransit->to_dept == session()->get('user')->branch &&
                        ($intransit->status == 9 || $intransit->status == 10 || $intransit->status == 14))
                    {
                        data: null,
                        title: "<b>Action</b>",
                        render: function(data, type, row, index) {
                            let render = ``;
                            if (!row.confirm || row.confirm == 0) {
                                render = `
                                    <button onclick='ConfirmOrMissingItem(19,${JSON.stringify(data)})' type='button' class='btn btn-sm btn-outline-success'>
                                        Confirm
                                    </button >
                                    <button onclick='ConfirmOrMissingItem(20,${JSON.stringify(data)})' type='button' class='btn btn-sm btn-outline-danger'>
                                        Missing
                                    </button >`;

                            } else {
                                render = row.confirm == 20 ?
                                    `<span class="btn" onclick='resetItem(${JSON.stringify(data)})'> <i  class="flaticon-refresh text-info icon-lg"></i></span>` :
                                    `<i  class="flaticon2-check-mark text-success icon-lg"></i>
                                    <span  onclick='resetItem(${JSON.stringify(data)})'><i  class="flaticon-refresh text-info icon-lg"></i></span>`;

                            }
                            return render;
                        }
                    }
                @endif
            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [1],
                    className: "text-nowrap col-1"
                },
                @if (($intransit->status == 12 || $intransit->status == 15) && $intransit->from_dept == session()->get('user')->branch)
                    {
                        targets: [2],
                        className: "text-nowrap col-1"
                    }
                @endif

                @if (
                    $intransit->to_dept == session()->get('user')->branch &&
                        ($intransit->status == 9 || $intransit->status == 10 || $intransit->status == 14))
                    {
                        targets: [2],
                        className: "text-nowrap col-1"
                    }
                @endif



            ]
        });

        let approved_items_table = $('#approved_items').DataTable({
            responsive: true,
            Destroy: true,
            paging: true,
            searching: false,
            scrollX: true,
            info:false,
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


        function ConfirmOrMissingItem(val, row) {
            let index = stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            if (val == 20) status = 15;

            stocktransfer_items[index].confirm = val;
            renderItemsTable(stocktransfer_items);
            configure();
            setRemarksforDiscripancy()
        }

        function resetItem(row) {
            let index = stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            stocktransfer_items[index].confirm = 0;
            renderItemsTable(stocktransfer_items);
            configure();
        }

        function configure() {
            let count = stocktransfer_items.filter(
                (item) => item.confirm > 0
            );
            if (count.length == stocktransfer_items.length) {
                $(`#received-item`).show();
                $(`#reset-item`).show();
            } else {
                $(`#received-item`).hide();
                $(`#reset-item`).hide();

            }
            setRemarksforDiscripancy();
        }

        function UpdateIntransitReceivingDetails() {
            try {
                let discripancy = stocktransfer_items.filter(function(item) {
                    return item.confirm === 20;
                });
                let status = discripancy.length > 0 ? 15 : 19; //if there is a discrepancy,
                let formData = new FormData();
                formData.append("stocktransfer_items", JSON.stringify(stocktransfer_items));
                formData.append("received_by", parseInt({{ session()->get('user')->id }}));
                formData.append("received_branch", parseInt({{ session()->get('user')->branch }}));
                formData.append("in_transit_id", parseInt({{ $intransit->id }}));
                formData.append("remarks", discripancy.length > 0 ? remarks_for_Discripansy : " Receiving Complete");
                formData.append("status", status);

                axios
                    .post(`/update-intransit-receiving-details`, formData)
                    .then(function(response) {
                        Swal.fire("Created Successfully", response.data, "success");
                        getIntransitItems();
                    })
                    .catch(function(error) {
                        console.log(error);
                        Swal.fire("Update Failed", error, "error");
                    });

            } catch (error) {
                console.log(error);
            }


        }

        function getApprovedItems() {
            axios.get('/get-approved-items/{{ session()->get('user')->branch }}').then(function(response) {
                $(`#requisition_logs`).html('');
                approved_items = response.data;
                renderApprovedItemsTable(response.data);
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        // get in-transit items
        function getIntransitItems() {

            axios.get('/get-in-transit-items/{{ $intransit->id }}').then(function(response) {
                stocktransfer_items = response.data;
                renderItemsTable(response.data);
                setSummaryValue();
                setRemarksforDiscripancy();
                $(`#received-item`).hide();
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function getIntransitILogs() {
            axios.get('/get-in-transit-logs/{{ $intransit->id }}').then(function(response) {
                renderIntransitlogs(response.data);
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function renderApprovedItemsTable(data) {
            let currentPageIndex = approved_items_table.page.info().page
            approved_items_table.search("").columns().search("").clear().draw();
            approved_items_table.rows.add(data).draw(true);
            approved_items_table.page(currentPageIndex).draw(false);
        }

        function renderItemsTable(data) {
            let currentPageIndex = stocktransfer_items_table.page.info().page
            stocktransfer_items_table.search("").columns().search("").clear().draw();
            stocktransfer_items_table.rows.add(data).draw(true);
            stocktransfer_items_table.page(currentPageIndex).draw(false);
        }

        function renderSummaryTable(data) {
            let currentPageIndex = stocktransfer_summary_table.page.info().page
            stocktransfer_summary_table.search("").columns().search("").clear().draw();
            stocktransfer_summary_table.rows.add(data).draw(true);
            stocktransfer_summary_table.page(currentPageIndex).draw(false);
        }

        function renderIntransitlogs(data) {
            let startTimestamp = "";
            let endTimestamp = "";

            $(data).each((index, value) => {
                $(`#in-transit-logs`).append(`
                <div class="timeline-item">
                    <div class="timeline-badge"><div class="bg-primary"></div></div>
                    <div class="timeline-content d-flex flex-column">
                    <span class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"> ${ value.name } </span>
                    <span style="white-space: pre-wrap;font-family:inherit !important" class="font-weight-normal text-dark-75 pb-3"> ${ value.remarks } </span>
                    <div class="d-flex flex-grow-1 align-items-center">
                        <span class="label label-lg label-light-info label-inline font-weight-bold py-4 mr-3 text-wrap" > ${ value.state } </span>
                       <span class="text-primary font-weight-bold text-wrap">  ${moment(value.created_at).format("MMMM DD, YYYY HH:mm A")}   </span>
                    </div>
                    </div>
                </div>
            `);
            });

        }

        function addItem(row) {
            stocktransfer_items.push(row);
            new_stocktransfer_items.push(row);
            renderItemsTable(stocktransfer_items);
            removeApprovedItem(row);
            removeDeleteItem(row)
            setSummaryValue();
            $(`#update-item`).show();
            $(`#reset-item`).show();
        }

        function removeItem(row) {
            approved_items.push(row);
            del_stocktransfer_items.push(row);
            renderApprovedItemsTable(approved_items);
            removeItemTable(row);
            removeNewItem(row);
            setSummaryValue(); //set summary value
            $(`#update-item`).show();
            $(`#reset-item`).show();
        }

        function removeApprovedItem(row) {
            let index = approved_items.findIndex(
                (item) => item.id === row.id
            );
            if (index !== -1) {
                approved_items.splice(index, 1);
                renderApprovedItemsTable(approved_items)
            }

        }

        function removeItemTable(row) {
            let index = stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            if (index !== -1) {
                stocktransfer_items.splice(index, 1);
                renderItemsTable(stocktransfer_items);
            }
        }

        function removeDeleteItem(row) {
            let index = del_stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            if (index !== -1) {
                del_stocktransfer_items.splice(index, 1);
            }

        }

        function removeNewItem(row) {
            let index = new_stocktransfer_items.findIndex(
                (item) => item.id === row.id
            );
            if (index !== -1) {
                new_stocktransfer_items.splice(index, 1);
            }

        }

        function updateItems() {
            let formData = new FormData();
            formData.append("del_stocktransfer_items", JSON.stringify(del_stocktransfer_items));
            formData.append("new_stocktransfer_items", JSON.stringify(new_stocktransfer_items));
            formData.append("in_transit_id", parseInt({{ $intransit->id }}));

            axios
                .post(`/update-in-transit-items`, formData)
                .then(function(response) {
                    Swal.fire("Created Successfully", response.data.message, "success");
                    getApprovedItems();
                    getIntransitItems();
                    $(`#update-item`).hide();
                    $(`#reset-item`).hide();
                })
                .catch(function(error) {
                    console.log(error);
                    Swal.fire("Update Failed", error, "error");
                });

        }

        function UpdateStatus(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);
            axios
                .post(`/update-in-transit-status`, formData)
                .then(function(response) {
                    Swal.fire("Created Successfully", response.data, "success");
                    $("#UpdateStatus").modal('hide');
                    window.location.reload();
                })
                .catch(function(error) {
                    Swal.fire("Created Successfully", error, "error");
                });

        }

        function approveStockTransfer(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);
            axios
                .post(`/approve-stock-transfer`, formData)
                .then(function(response) {
                    Swal.fire("Created Successfully", response.data, "success");
                    $("#approved_data").modal('hide');
                    // window.location.reload();
                })
                .catch(function(error) {
                    Swal.fire("Created Successfully", error, "error");
                });

        }

        function approveReceivingStockTransfer(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);
            axios
                .post(`/approve-intransit-receiving-details`, formData)
                .then(function(response) {
                    Swal.fire("Created Successfully", response.data, "success");
                    $("#approved_data").modal('hide');
                    // window.location.reload();
                })
                .catch(function(error) {
                    Swal.fire("Created Successfully", error, "error");
                });

        }

        function updateStockTransferDetails(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);
            axios
                .post(`/update-stock-transfer-details`, formData)
                .then(function(response) {
                    Swal.fire("Created Successfully", response.data, "success");
                    $("#Update_data").modal('hide');
                    // window.location.reload();
                })
                .catch(function(error) {
                    Swal.fire("Created Successfully", error, "error");
                });
        }

        function resetItems() {
            getApprovedItems();
            getIntransitItems();
            $(`#update-item`).hide();
            $(`#reset-item`).hide();
        }

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
                console.log(filtered_item);

                summary.class_id = class_item[i];
                summary.classification = filtered_item[0].classification;
                summary.description = filtered_item[0].description;
                summary.quantity = filtered_item.length;
                summary.start = filtered_item[0].series_start;
                summary.end = filtered_item[filtered_item.length - 1].series_end;
                console.log(summary);


                stocktransfer_summary.push(summary);
            }

            renderSummaryTable(stocktransfer_summary);
        }

        function setRemarksforDiscripancy() {
            try {
                let discripancy = stocktransfer_items.filter(function(item) {
                    return item.confirm === 20;
                });

                remarks_for_Discripansy = `<b class="text-info my-5">Missing Items:</b><br><br>`;
                discripancy.forEach(data => {
                    remarks_for_Discripansy +=
                        `<span style="font-size:13px;font-style: italic;" class="font-weight-bolder font-size-lg mr-2">  ${data.description} <span class='text-success'>${data.code} </span> Bkt# ${data.booklet }<br> Series From:${data.series_start} To:${data.series_end}</span> <hr>`;
                });

            } catch (error) {
                console.log(error);

            }

        }

        //re-render table
        $(document).ready(async function() {
            // filter data
            await getApprovedItems();
            await getIntransitItems();
            await getIntransitILogs();
            await $(`#update-item`).hide();
            await $(`#reset-item`).hide();
            await $(`#received-item`).hide();

        });
        $("#add_item").on("shown.bs.modal", function() {
            // Initialize or redraw the DataTable here
            $("#approved_items").DataTable().draw();
        });
    </script>
@endsection
