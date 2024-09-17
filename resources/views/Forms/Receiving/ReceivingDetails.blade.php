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

@section('css')
<style>
     #table-ui{
        border: 1px solid black !important
     }
</style>
@endsection


@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" >
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="d-flex flex-column flex-md-row">
                    <div class="d-flex flex-column flex-md-row-fluid">

							<!--begin::Card-->
                            <div class="card card-custom bg-white rounded p-10 ">
                                <div class="card-header">
                                    <div class="card-title">
                                        <span class="card-icon" style="">
                                             <i class="flaticon2-delivery-truck icon-4x text-success"></i>
                                        </span>

                                        <h2 class="">DR # {{ $receive->dr_no }}
                                        <small class="text-warning">{{ $receive->sourcename }}</small></h2>

                                    </div>
                                    <div class="card-toolbar">
                                       <div class="d-flex align-items-center justify-content-end text-right my-2">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x pt-4">
                                        <div class="d-flex align-items-center py-1">

                                    @if ($receive->status != 11)
                                       <button data-toggle='modal' style="border: 1px solid gray" data-target='#UpdateStatus' type="button"
                                            class="btn btn-warning mr-2">
                                          {{ $receive->state }}
                                          <i class="flaticon-edit-1 icon-lg"></i>
                                        </button>
                                        <button data-toggle='modal' style="border: 1px solid gray" data-target='#UpdatePO' type="button"
                                            class="btn btn-primary mr-2">
                                            Update <i class="flaticon-edit-1 icon-lg"></i>
                                        </button>
                                    @else

                                     <span  class="label label-lg label-light label-inline text-uppercase font-weight-bold py-5 mr-3"
                                     style="border: 1px solid gray"
                                                data-toggle="tooltip" data-placement="bottom" title="Ticket Status">
                                              {{ $receive->state }}
                                                   <i class="flaticon-edit-1 icon-lg"></i>
                                      </span>
                                    @endif

                                    @if ($receive->status == 10)
                                        <button data-toggle='modal' data-target='#Approval' type="button"
                                            class="btn btn-warning mr-2">
                                            Approval <i class="flaticon-like icon-lg"></i>
                                        </button>
                                    @endif

                                        </div>
                                    </div>
                                </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    {{-- info --}}
                                <div class="table-responsive-lg text-wrap">
                                    <table id="table-ui" class="table w-100 table-bordered" >
                                        <thead>
                                            <tr>
                                                <th style="">
                                                    <span class="text-dark font-weight-bold font-size-h6 mr-3">
                                                        Branch/Dept
                                                   </span>
                                                </th>
                                                <th style="">
                                                    <span style="font-size: 13px">
                                                            <span class="fa fa-genderless text-muted icon-md mr-3"></span>
                                                            <span class="text-dark font-weight-bold font-size-h5 mr-3">
                                                                {{ $receive->branch }}
                                                            </span>
                                                    </span>
                                                </th>
                                                <th style="">
                                                     <span class="text-dark font-weight-bold font-size-h5 mr-3">
                                                    Supplier
                                                    </span>
                                                </th>
                                                <th style="">
                                                    <span class="fa fa-genderless text-muted icon-md mr-3"></span>
                                                    <span class="text-dark font-weight-bold font-size-h5 mr-3">
                                                        {{ $receive->supplier }}
                                                    </span>

                                                </th>

                                            </tr>
                                             <tr>
                                                 <td colspan="2">
                                                    <span class="text-dark font-weight-bold font-size-h5 mr-3">
                                                    Remark
                                                    </span>
                                                </td>
                                                <td colspan="2">
                                                <a class="text-dark font-weight-bold font-size-h5 mr-3">
                                                    {{ $receive->remarks }}
                                                </a>
                                                </td>


                                            </tr>
                                        </thead>
                                        <tbody>


                                            <tr>
                                                <td colspan="4">
                                                <table  class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5" style="text-align: center" id="receiving_summary">
                                                </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="4">
                                                <button onclick="HideAndShow()" style="border: 1px solid gray" class="btn btn-info">
                                                    <i class="flaticon-interface-6"></i>
                                                </button>
                                                <div id="received_items">
                                                        <div style="float: right">
                                                            @if ($receive->sender != 4)
                                                                @if ($receive->status != 11)
                                                                    <button data-toggle='modal' data-target='#UpdateItems' type="button" class="btn btn-light-info mr-2">
                                                                        <span class="text-success">
                                                                        Add Items
                                                                        <i class="flaticon-add-circular-button text-success icon-lg"></i>
                                                                        </span>
                                                                    </button>
                                                                @endif
                                                            @else
                                                                @if ($receive->status != 11)
                                                                    <button data-toggle='modal' style="border: 1px solid gray"  data-target='#generate_item' type="button" class="btn btn-primary  mr-2">
                                                                        <span class="">Add Items</span>
                                                                        <i class="flaticon-add-circular-button icon-lg"></i>
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        </div>
                                                <table class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5" style="text-align: center" id="inventory_items">
                                                </table>
                                                {{-- buttons --}}
                                                <button class="btn btn-success" onclick="UpdateReceivingItems()" id="update_update_items">Update</button>
                                                <button class="btn btn-success" onclick="getOrderlineItems()"  id="reset">Reset</button>
                                                <br>
                                                </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>

                                                <td colspan="2">
                                                    <p class="font-size-lg col-12">
                                                        Prepared By:
                                                    </p>
                                                    <div style="text-align: center;border-bottom: solid black 1px">
                                                        {{ $receive->prepared }}
                                                    </div>
                                                    <div style="text-align: center;">
                                                        <b>
                                                            {{ $receive->prepared_position }}
                                                        </b>
                                                    </div>
                                                <div style="text-align: center;">
                                                    <b>
                                                        {{ Carbon\Carbon::parse($receive->created_at)->format('M d, Y H:i A') }}
                                                    </b>
                                                </div>
                                                </td>

                                            </tr>

                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>

                                </div>
                            </div>
                            <div class="d-flex align-items-center card-spacer-x mb-3">

                            </div>

                            <div class="card-footer p-0">
                                   <a href="#" class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
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

                                <span onclick="Comments()" class="btn btn-default btn-icon btn-sm mr-2"
                                    data-toggle="tooltip" title="Reload list">
                                    <i class="ki ki-refresh icon-sm"></i>
                                </span>
                                <div class="mb-3 px-5 pt-5" id="div_comments"></div>
                                <div class="card-spacer">
                                    <form method="POST" id="comment-form" enctype='multipart/form-data'
                                        onsubmit="submitComment()">
                                        <div class="row">
                                            <div id="comment" contenteditable="true" onkeypress="PasteImage(this)"
                                                class="form-control col-9" style="height: auto;"></div>
                                            <div class="col-3">
                                                <button id="comment-btn" type="submit" style="border: 1px solid gray"
                                                    class="btn btn-light btn-md text-uppercase font-weight-bold chat-send py-2 px-6">
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
                            <!--end::Card-->

                    </div>

                    <div  id="logs" class="flex-md-row-auto w-md-200px w-xl-400px ml-md-6 ml-lg-8">

                        <div class="card card-custom gutter-b">
                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-warning"> Receiving Logs <i
                                            class="flaticon-time-2 icon-lg"></i> </span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm" id="cnt_logs"></span>
                                </h3>
                            </div>
                            <div class="card-body pt-4">
                               <div class="timeline timeline-3">
                                    <div class="timeline-items"  id="receiving_logs">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modals --}}

    {{-- start Update Items Modal --}}
    <div class="modal fade" id="UpdateItems" tabindex="-1" style="" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header ribbon ribbon-left">
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2"
                        style="top: 10px; left: -2px;"> Add Item </div>
                        <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="font-size:12px;font-weight: bold; max-width: 100%;" class="modal-body ">
                    {{-- content --}}
                    <table
                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                        style="text-align: center" id="po_table">
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- end Update Items Modal --}}

    {{-- start Update Receiving details --}}
    <div class="modal fade" id="UpdatePO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                {{-- content --}}
                <div class="modal-header ribbon ribbon-left">
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2"
                        style="top: 10px; left: -2px;"> Update Receiving Details </div>
                    <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="font-size:12px;font-weight: bold;" class="modal-body">
                    <form class="my-5" action="#" onsubmit="UpdateReceiving(event)" method="get">
                        @csrf
                        <div class="row my-5">
                            <span class="col-1"></span>
                            <label class="col-2" for="">DR No.:</label>
                            <span class="col-8">
                                <input class="form-control" name="dr_no" value="{{ $receive->dr_no }}" type="text"
                                    required>
                            </span>

                        </div>
                        <div class="row my-5">
                            <span class="col-1"></span>
                            <label class="col-2" for="">Source Type:</label>
                            <span class="col-8">
                                <select class="form-control" value='{{ $receive->source }}' name="source"
                                    id="suppplier" type="text" required
                                    @if ($receive->status == 3) @disabled(true) @endif>
                                    <option value="" disabled>Select Source Type</option>
                                    <option value="1">Supplier to HO</option>
                                    <option value="2">HO to Branch</option>
                                    <option value="3">Branch to Branch</option>
                                    <option value="4">Branch to HO</option>


                                </select>
                            </span>
                            <span class="col-1"></span>
                        </div>
                        <div class="row my-5">
                            <span class="col-1"></span>
                            <label class="col-2" for="">Supplier:</label>
                            <span class="col-8">
                                <select class="form-control" name="receiver" type="text" required
                                    @if ($receive->status == 3) @disabled(true) @endif>
                                    <option value="" disabled></option>
                                    @foreach ($supplier->GetAllSupplier() as $res)
                                        @if ($res->id != $receive->sender)
                                            <option value="{{ $res->id }}">
                                                {{ $res->supplier }}
                                            </option>
                                        @else
                                            <option value="{{ $res->id }}" selected>
                                                {{ $res->supplier }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>
                        <div class="row my-5">
                            <span class="col-1"></span>
                            <label class="col-2" for="">Remarks</label>
                            <span class="col-8">
                                <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="10">{{ $receive->remarks }}</textarea>
                            </span>
                        </div>
                        <div class="row my-5">
                            <span class="col-5"></span>
                            <span class="col-3">
                                <input class="btn btn-success" type="submit" value="Update">
                                <input type="hidden" value="{{ $receive->id }}" name="recid">
                                @if ($receive->sender!=4)
                                    <input type="hidden" value="{{ $receive->sid }}" name="sender">
                                @endif

                            </span>
                        </div>
                    </form>
                </div>
                {{-- end content --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                    <input type="hidden" name="receiver" value="{{ session()->get('user')->branch }}">
                </div>
            </div>
        </div>
    </div>
    {{-- end Update Receiving details --}}

    {{-- Update the Status --}}
    <div class="modal fade" id="UpdateStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header ribbon ribbon-left">
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2"
                        style="top: 10px; left: -2px;"> Update PO Status </div>

                    <span class="text-success h4">Title: <span contenteditable="true" class="text-dark"
                            id="notes_title"></span></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- content --}}
                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="UpdateStatus(event)" method="post">
                        @csrf
                        <div class="col-lg-12 col-xxl-12 ">
                            <!--begin::Mixed Widget 1-->

                                <div class="row my-5">
                                    <label class="col-2 font-weight-bold"><b>Status: </b></label>
                                    <span class="col-8">
                                        <select class="form-control" name="status" type="text" required>

                                            <option value=""></option>
                                            @foreach ($status->getStatus() as $res)
                                                @if ($res->id == 11 && $receive->status != $res->id)
                                                    <option value="{{ $res->id }}"> {{ $res->state }} </option>
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
                                        <input type="hidden" name="receiving_id" value="{{ $receive->id }}">
                                        <input type="hidden" name="uid" value="{{ session()->get('user')->id }}">

                                    </span>
                                </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end Update the Status --}}

    {{-- Approvals   --}}
    <div class="modal fade" id="Approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header ribbon ribbon-left">
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2"
                        style="top: 10px; left: -2px;"> Approvals </div>

                    <span class="text-success h4">Title: </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- content --}}
                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="ApprovedReceiving(event)" method="post">
                        @csrf
                        <div class="col-lg-12 col-xxl-12 ">
                            <!--begin::Mixed Widget 1-->
                            <div
                                class="col bg-light-white  px-6 py-8 rounded-xl card card-custom  ribbon ribbon-left wave wave-animate-steady wave-success my-3 ">
                                <div class="row my-5">
                                    <label class="col-2 font-weight-bold" for=""><b>Status: </b></label>
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
                                    </span>
                                </div>
                                <div class="row my-5">
                                    <span class="col-3"></span>
                                    <input type="submit" class="btn btn-success" value="Submit">
                                    <input type="hidden" value="{{ session()->get('user')->emp_id }}"
                                        name="approved_by">
                                    <input type="hidden" value="{{ session()->get('user')->id }}" name="uid">
                                    <input type="hidden" value="{{ $receive->id }}" name="receiving_id">


                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end approval    --}}

    <div class="modal fade" id="req_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Requisitions <i
                            class="flaticon-notes icon-lg"></i>
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
                        <thead>
                            <tr>
                                <th scope="col">Quantity</th>
                                <th scope="col">PO No.</th>
                                <th scope="col">Description</th>
                                <th scope="col">Branch/Dept</th>
                                <th scope="col">Group</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                        </thead>

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

    {{-- custom add modal --}}
    <div class="modal fade" id="custom_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Custom Add <i
                            class="flaticon-notes icon-lg"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- modal table --}}
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <table
                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                        style="text-align: center" id="inventory_custom_add">
                        <!-- Your table content goes here -->
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

    {{-- modal start --}}
    <div class="modal fade" id="generate_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        let drno = "{{ $receive->dr_no }}";
        let user = parseInt("{{ session()->get('user')->emp_id }}");
        let uid = parseInt("{{ session()->get('user')->id }}");
        let rec_id = parseInt("{{ $receive->id }}");
        let source = parseInt("{{ $receive->id }}");
        let disable = {{ $receive->status }};
        let receiving_summary = [];
        let receiving_items = [];
        let renderdata = [];

        let po_receiving = []; // every PO  that was added in the order to be received
        let del_po_receiving = []; // deleted items that is part of the original details
        let inventory_items_list = []; ///items that are received
        let del_inventory_items_list = []; ///items that are deleted from the receiving item
        let new_inventory_items_list = []; ///items that are newly added to the receiving item

        let req_items = [];
        let temp_inventory = [];

        let booklets=[];
        let series_start = 0;
        let inventory_cnt = 0;
        let formData = new FormData();
        let order_item=[];
        // paging

        //

        let receiving_summary_table = $("#receiving_summary").DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            info:false,
            columns: [
                @if ($receive->sid!=3)

                {
                    data: null,
                    title: "<b class='text-nowrap'> Branch </b>",
                    render: function(data, type, row) {
                        return `<b>${data.branch}</b>`;
                    },
                },
                @endif
                {
                    data: null,
                    title: "<b>Description</b>",
                    render: function(data, type, row, meta) {
                        return `<b>${data.description} </b>`;
                    },
                },
                {
                    data: null,
                    title: "<b class='text-wrap'>Received Qty </b>",
                    render: function(data, type, row) {
                        return `<b>${data.received_qty}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b>Booklet</b>",
                    render: function(data, type, row) {
                        let json = JSON.stringify(row);
                        return `<b class='text-dark'>${data.booklets}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b class='text-wrap'> SERIES START </b>",
                    render: function(data, type, row) {
                        let json = JSON.stringify(row);
                        return `<b class='text-dark'>${data.start}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> SERIES END </b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark' id="series_end${data.id}">${data.end}</b>`;
                    },
                },

            ],
            columnDefs: [{
                    targets: [0],
                    className: "text-nowrap col-1",
                },
                {
                    targets: [1],
                    className: "text-wrap col-1",
                },
                {
                    targets: [2],
                    className: "text-wrap col-1",
                },
                {
                    targets: [3],
                    className: "text-wrap col-1",
                },
                {
                    targets: [4],
                    className: "text-wrap col-1",
                }
                @if ($receive->sid!=3)
                ,{
                    targets: [5],
                    className: "text-wrap col-1",
                }
                    @endif


            ]
        });

        let receiving_items_table = $("#inventory_items").DataTable({
            responsive: false,
            destroy: true,
            paging: true,
            searching: false,
            scrollX: true,
            info:false,
            columns: [
                {
                    data: null,
                    title: "<b>Quantity</b>",
                    render: function(data, type, row, meta) {
                        return `<b>${data.quantity} </b>`;
                    },
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Units </b>",
                    render: function(data, type, row) {
                        return `<b>${data.unit}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b>Description</b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.description}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b  class='text-wrap'>Set Per Item</b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.set_qty}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> Booklets </b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.booklet}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> SERIES START </b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.series_start}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> SERIES END </b>",
                    render: function(data, type, row) {
                        return `<b class='text-dark'>${data.series_end}</b>`;
                    },
                },
                @if ($receive->status != 11)
                    {
                        data: null,
                        title: "<b> Action </b>",
                        render: function(data, type, row) {
                            return `
                            <b onclick='removeItem(${JSON.stringify(row)})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>
                            `;
                        },
                    },
                @endif
            ],
            columnDefs: [{
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
                @if ($receive->status != 11)
                    {
                        targets: [7],
                        className: "text-nowrap col-1",
                    },
                @endif
            ],
        });

        let req_table = $("#po_table").DataTable({
            scrollY: "400px",
            scrollCollapse: true,
            paging: false,
            searching: false,
            columns: [
                {
                    data: "quantity",
                    title: "<b>Quantity</b>",
                },
                {
                    data: "po_no",
                    title: "<b>PO No.</b>",
                },
                {
                    data: "description",
                    title: "<b>Description</b>",
                },
                {
                    data: "BranchName",
                    title: "<b>Branch Name</b>",
                },
                {
                    data: "classification",
                    title: "<b>Classification</b>",
                },
                {
                    data: null,
                    title: "<b>Action</b>",

                    render: function (data, type, row, index) {
                        // return `<b class="text-success" onclick='AddReceiving(${JSON.stringify(row)})'><i class="btn ki ki-solid-plus icon-2x text-success"></i><b>`;
                        return `<b data-toggle='modal' onclick='CustomAdd(${JSON.stringify(
                            row
                        )})' data-target='#custom_add' type="button" ><i class="btn ki ki-plus icon-1x text-success"></i></b>`;
                    },
                },
            ],
        });

        let custom_table = $("#inventory_custom_add").DataTable({
            responsive: false,
            Destroy: true,
            paging: true,
            searching: true,
            scrollX: true,
            columns: [
                {
                    data: null,
                    title: "<b>Quantity</b>",
                    render: function (data, type, row, meta) {
                        return `<b>${data.quantity} </b><b>${data.unit}</b>`;
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
                    title: "<b>Set Unit</b>",
                    render: function (data, type, row) {
                        return row.active == "checked"?`${data.set_qty}`:
                        `<input class='form-control' onchange='OnchangeSetValue(this.value,${JSON.stringify(data)})' value='${data.set_qty === 0 ? 50 : data.set_qty}' id="set${
                            data.booklet
                        }" type="text" name='set_per_item' ${
                            data.receiving_id === 0 || data.receiving_id === null
                                ? ""
                                : "readonly"
                        }>`;
                    },
                },
                {
                    data: null,
                    title: "<b> BOOKLET </b>",
                    render: function (data, type, row) {
                        return `<b class='text-primary'>${data.booklet}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> SERIES START </b>",
                    render: function (data, type, row) {
                        return `<b class='text-primary'>${data.series_start}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> SERIES END </b>",
                    render: function (data, type, row) {
                        return `<b class='text-primary'>${data.series_end}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> Added </b>",
                    render: function (data, type, row) {
                        // return `<b > <input id="chk${row.order_id}${row.booklet}" onclick='addInventory(${JSON.stringify(row)},this)'  type="checkbox"  ${row.active}/></b>`;

                            return row.active != "checked"
                            ? `<i onclick='addInventory(${JSON.stringify(
                                row
                            )})' class="btn  flaticon-add-circular-button icon-2x text-success"> </i>`
                            : row.rid==rec_id ? `<i onclick='removeItem(${JSON.stringify(
                                row
                            )})' class="btn flaticon-cancel icon-2x text-danger"></i>`:``;


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
                    className: "text-wrap col-2",
                },
                {
                    targets: [4],
                    className: "text-nowrap col-1",
                },
                {
                    targets: [5],
                    className: "text-nowrap col-2",
                },
                {
                    targets: [6],
                    className: "text-nowrap col-2",
                },
            ],
        });

        $(document).ready(async function() {
            console.log(JSON.stringify(''));
            //
            await $(`#update_update_items`).hide();
            await $(`#reset`).hide();
            $('#received_items').hide();
            // $('#logs').hide();
            // filter data
            await getReceivingLogs();
            await getPOforReceiving();

            @if ( $receive->sid == 3 )
                await getReceivingItems();
            @else
                await getOrderlineItems();
            @endif

        });

        function HideAndShow(){
            $('#received_items').toggle();
            $("#inventory_items").DataTable().draw();
            $("#receiving_summary").DataTable().draw();
        }

        function HideAndShowLogs(){
            $('#logs').toggle();
            $("#receiving_summary").DataTable().draw();
            $("#inventory_items").DataTable().draw();

        }

        async function filterdata() {
            let items = await getPOforReceiving();
            let receivings = await getReceivingOrderline();

            receivings.forEach(function (data) {
                req_items = items.filter(function (item) {
                    return item.olid != data.olid;
                });
            });

            req_table.search("").columns().search("").clear().draw();
            req_table.rows.add(req_items).draw(true);
        }

        function OnchangeSetValue(val, row) {
            let index = booklets.findIndex((item) => item.id === row.id);
            order_item[index].set_qty = parseInt(val);
            console.log(index);
            CustomValue(order_item, row.series_start );
        }

       //event listener
        $("#UpdateItems").on("shown.bs.modal", function () {
            // Initialize or redraw the DataTable here
            $("#po_table").DataTable().draw();
        });
        //
        $("#custom_add").on("shown.bs.modal", function () {
            // Initialize or redraw the DataTable here
            $("#inventory_custom_add").DataTable().draw();
        });

        function ApprovedReceiving(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);

            axios
                .post(`/approved-receiving-details`, formData)
                .then(function (response) {
                    Swal.fire("Created Successfully", response.data, "success");
                    window.location.reload();
                })
                .catch(function (error) {});
        }

        function AddReceiving(row) {
            row["order_index"] = po_receiving.length;
            row.series_start = "";
            row.series_end = "";
            row.booklet_no = "";
            row.qty_received = 0;
            row.copy_per_set = 4;
            po_receiving.push(row);
            //RemoveReceive();

            // getOrderlineItems(row.olid);
            // Remove data from item list
            let index = req_items.findIndex((item) => item.olid === row.olid);
            if (index !== -1) {
                req_items.splice(index, 1);
                req_table.search("").columns().search("").clear().draw();
                req_table.rows.add(req_items).draw(true);
            }

            // end

            custom_table.search("").columns().search("").clear().draw();
            custom_table.rows.add(temp_inventory).draw(true);
        }
        // this  function is for adding data to the inventory table  from custom add button in items table
        function addInventory(row) {
            //add to the deleted inventory item
            new_inventory_items_list.push(row);
            //
            let counter = [];
            $(`#update_update_items`).show();
            $(`#reset`).show();

            let index = booklets.findIndex((item) => item.id === row.id);
            // Add Item to Inventory List
            booklets[index].active = "checked";
            booklets[index].rid = rec_id;
            receiving_items = booklets.filter(function (item) {
                    return item.rid == rec_id;
            });
            // Update the datatable row
            renderItems(booklets);
            renderInventoryItems(receiving_items);//render receiving
            receivingSummary(receiving_items);//render summary
            // end of the code

        }

        function removeItem(row) {
            //add to the deleted inventory item
            if (row.receiving_id) {
                del_inventory_items_list.push(row);
            } else {
                let nindex = new_inventory_items_list.findIndex(
                    (item) => item.id === row.id
                );
                new_inventory_items_list.splice(nindex, 1);
            }
            //show the update button
            $(`#update_update_items`).show();
            $(`#reset`).show();
            // search the index of the item in the displayed items in the
            let index = booklets.findIndex((item) => item.id === row.id);
            console.log('index');
            console.log(index);
            booklets[index].active = "unchecked";
            booklets[index].rid = 0;
           //remove the item in the record
            //render the table of the new values
             receiving_items = booklets.filter(function (item) {
                    return item.rid == rec_id;
            });
            // Update the datatable row
            renderItems(booklets);
            //
            renderInventoryItems(receiving_items);//render receiving
            receivingSummary(receiving_items);//render summary

            // set the value of the received quatity
            setSeriesValue(row, row.olid);
            // $(`#qty${row.olid}`).val(inventory_items_list.length);
        }

        function appendReceivingLogs(data) {
            let startTimestamp = "";
            let endTimestamp = "";

            $(data).each((index, value) => {
                $(`#receiving_logs`).append(`
            <div class="timeline-item">
                <div class="timeline-media">
                    <i class="flaticon2-shield text-danger"></i>
                </div>
                <div class="timeline-content">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="mr-2">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold">${ value.name }</a>
                            <span class="text-muted ml-2">${moment(value.created_at).format("MMMM DD, YYYY HH:mm A")} </span>
                            <span class="label label-light-danger font-weight-bolder label-inline ml-2">${ value.state }</span>
                        </div>

                    </div>
                    <p class="p-0">${ value.remarks }</p>
                </div>
            </div>
            `);
            });

        }

        function UpdateOrderline() {
            let formData = new FormData();
            formData.append("inventory_items", JSON.stringify(inventory_items_list));
            formData.append("po_receiving", JSON.stringify(po_receiving));
            formData.append("receiving_id", {{ $receive->id }});

            axios
                .post(`/update-receiving-details`, formData)
                .then(function(response) {
                    // window.location.reload();
                    Swal.fire("Created Successfully", response.data, "success");
                    console.log(response.data);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function UpdateStatus(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form);

            axios
                .post(`/update-receiving-status`, formData)
                .then(function(response) {
                    Swal.fire("Created Successfully", response.data, "success");
                    window.location.reload();
                })
                .catch(function(error) {
                    Swal.fire("Error", error, "error");
                    console.log(error);
                });
        }

        function getReceivingLogs() {

            axios.get('/get-receiving-logs/{{ $receive->id }}').then(function(response) {
                $(`#receiving_logs`).html('');
                appendReceivingLogs(response.data);
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function getReceivingItems() {
            let data = [];

            axios.get('/get-receive-items/{{ $receive->id }}').then(function(response) {
                console.log(response.data);
                inventory_items_list = response.data.sort(function(a, b) {
                    return a.booklet - b.booklet;
                });

                renderInventoryItems(response.data);
                receivingSummary(response.data);

            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function getUniqueCombinations(data, column1, column2) {
            const uniqueCombinations = new Set();

            data.forEach(row => {
                const value1 = row[column1];
                const value2 = row[column2];
                const combination = [value1, value2]; // Create an array for the combination

                uniqueCombinations.add(JSON.stringify(combination));
            });
            return Array.from(uniqueCombinations).map(combination => JSON.parse(combination));
        }

        function getPOforReceiving() {
            return axios
                .get("/get-po-for-receiving")
                .then(function (response) {
                    req_items = response.data;

                    req_table.search("").columns().search("").clear().draw();
                    req_table.rows.add(response.data).draw(true);
                    return response.data;
                })
                .catch(function (error) {
                    console.log(error);
                    return [];
                });
        }

        function getOrderlineItems() {
            try {
                let allResponses = [];

                axios
                    .get(`/get-orderline-items/0`, formData)
                    .then(function (response) {
                        const responseData = response.data;
                        temp_inventory = response.data;
                        booklets=response.data;
                        receiving_items = response.data.filter(function (item) {
                            return item.rid == rec_id;
                        });


                        renderItems(temp_inventory);
                        renderInventoryItems(receiving_items);
                        receivingSummary(receiving_items);
                    })
                    .catch(function (error) {
                        Swal.fire({
                            title: "ERROR",
                            text: error,
                            icon: "error",
                        });
                    });
            } catch (error) {
                console.log(error);
            }
        }

        function receivingSummary(data) {
            try {
                let summary_row = {};
                let olid = [...new Set(data.map(record => record.olid))];
                let filtered = data;
                let filtered_item = [];
                let sorted_items = [];
                let columnValues;
                let booklets = "";
                receiving_summary = [];

                for (let i = 0; i < olid.length; i++) {
                    summary = {}

                    filtered_item = filtered.filter(function(item) {
                        return item.olid === olid[i];
                    });

                    // sort the items accordingly to booklet no
                    sorted_items = filtered_item.sort(function(a, b) {
                        return a.booklet - b.booklet;
                    });

                    //create a string list of all the added booklets
                    columnValues = sorted_items.map(item => item.booklet)
                    booklets = columnValues.join(', ');

                    summary.branch = sorted_items[0].BranchName;
                    summary.description = sorted_items[0].description;
                    summary.received_qty = sorted_items.length;
                    summary.booklets = booklets;
                    summary.start = sorted_items[0].series_start;
                    summary.end = sorted_items[sorted_items.length - 1].series_end;

                    receiving_summary.push(summary);
                }
                console.log(receiving_summary);

                renderReceivingSummaryTable(receiving_summary);
            } catch (error) {
                console.log(error);
            }


        }
        // this function displays data to the inventory list
        function renderInventoryItems(data) {
            let currentPageIndex = receiving_items_table.page.info().page;
            receiving_items_table.search("").columns().search("").clear().draw();
            receiving_items_table.rows.add(data).draw(true);
            receiving_items_table.page(currentPageIndex).draw(false);
        }

        function CustomAdd(row) {
            order_item = booklets.filter(function (item) {
                return item.olid === row.olid;
            });
            let sorted_items = order_item.sort(function(a, b) {
                        return a.booklet - b.booklet;
                    });

            renderItems(sorted_items);
            CustomValue(sorted_items, row.series_no);
        }

        function UpdateReceiving(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);

            axios
                .post(`/update-receiving-details`, formData)
                .then(function (response) {
                    // window.location.reload();
                    Swal.fire("Created Successfully", response.data, "success");
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        function UpdateReceivingItems() {
            let formData = new FormData();
            formData.append("inventory_items", JSON.stringify(inventory_items_list));
            formData.append(
                "del_inventory_items_list",
                JSON.stringify(del_inventory_items_list)
            );
            formData.append(
                "new_inventory_items_list",
                JSON.stringify(new_inventory_items_list)
            );
            formData.append("receiving_id", rec_id);
            formData.append("uid", uid);

            axios
                .post(`/update-receiving-order-items`, formData)
                .then(function (response) {
                    // window.location.reload();
                    $(`#update_update_items`).hide();
                    $(`#reset`).hide();
                    // location.reload();

                    Swal.fire("Created Successfully", response.data, "success");
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        //this function displays the items list
        function renderItems(data) {
            let scrollTop = $("#custom_add .modal-body").scrollTop();
            let currentPageIndex = custom_table.page.info().page;
            //
            custom_table.search("").columns().search("").clear().draw();
            custom_table.rows.add(data).draw(true);
            // Restore the previous page index after redrawing the DataTable
            custom_table.page(currentPageIndex).draw(false);
            $("#custom_add .modal-body").scrollTop(scrollTop);
        }

        function renderReceivingItemsTable(data) {
            let currentPageIndex = receiving_items.page.info().page;
            receiving_items.search("").columns().search("").clear().draw();
            receiving_items.rows.add(data).draw(true);
            receiving_items.page(currentPageIndex).draw(false);
        }

        function renderReceivingSummaryTable(data) {
            let currentPageIndex = receiving_summary_table.page.info().page;
            receiving_summary_table.search("").columns().search("").clear().draw();
            receiving_summary_table.rows.add(data).draw(true);
            receiving_summary_table.page(currentPageIndex).draw(false);
        }

        // this function  is used for updating the quantity of items in the order list when an item is added or removed from
        function setSeriesValue(data, id) {
            let index = po_receiving.findIndex((item) => item.olid === id);
            let quantity = inventory_items_list.filter(function (item) {
                return item.olid === id;
            });
            let cnt = po_receiving.length;
            let booklets = concatinateValue(quantity, "booklet");

            // refresh the receiving items details
            po_receiving[index].series_start =
                quantity.length == 0 ? 0 : quantity[0].series_start;
            po_receiving[index].series_end =
                quantity.length == 0 ? 0 : quantity[quantity.length - 1].series_end;
            po_receiving[index].qty_received =
                quantity.length == 0 ? 0 : quantity.length;
            po_receiving[index].booklet_no = booklets;

            // renderReceivingItemsTable(po_receiving);
        }
        //this function use to create a custom value for the item list ()
        function CustomValue(data, start_series) {
            let series_start = parseInt(start_series);
            data[0].set_qty = data[0].set_qty || 50;
            data[0].series_start = data[0].series_start || start_series;
            data[0].series_end =parseInt(data[0].series_start) + parseInt(data[0].set_qty) - 1;

            for (let index = 1; index < data.length; index++) {
                data[index].set_qty = data[index].set_qty || 50;
                data[index].series_start = data[index - 1].series_end + 1;
                data[index].series_end =
                    data[index].series_start + parseInt(data[index].set_qty) - 1;
            }

            order_item  = data;
            booklets=order_item;
            renderItems(order_item);
        }

        function concatinateValue(data, column) {
            let concatenatedValues = data.reduce((acc, obj, index) => {
                let separator = index === 0 ? "" : ", ";
                return acc + separator + obj[column];
            }, " ");

            return concatenatedValues;
        }

</script>

<script src="{{ asset('MyJs/ReceivingDetails.js') }}"></script>
@endsection
