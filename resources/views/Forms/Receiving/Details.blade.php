@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Accountable Forms Invertory </h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-primary">
                            {{-- {{ json_encode($requisition) }} --}}
                            <a href="#" class="text-primary"> Purchase Order Details </a>
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
            <div class="container-fluid">
                <div class="d-flex flex-column flex-md-row">

                    <div class="flex-md-row-fluid">
                        <div class="card card-custom gutter-b">
                            <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                                <div class="card-toolbar">
                                    {{-- buttons --}}
                                    @if($receive->status==10)
                                        <button data-toggle='modal' data-target='#Approval' type="button"
                                                class="btn btn-warning mr-2">
                                            Approval <i class="flaticon-like icon-lg"></i>
                                        </button>
                                    @endif


                                    @if($receive->status!=11)
                                        <button data-toggle='modal' data-target='#UpdatePO' type="button"
                                                class="btn btn-primary mr-2">
                                            Update <i class="flaticon-edit-1 icon-lg"></i>
                                        </button>

                                        <button data-toggle='modal' data-target='#UpdateItems' type="button"
                                                class="btn btn-success mr-2">
                                            Add Items <i class="flaticon-add-circular-button icon-lg"></i>
                                        </button>


                                        <button data-toggle='modal' data-target='#UpdateStatus' type="button"
                                                class="btn btn-primary mr-2">
                                            Status <i class="flaticon-edit-1 icon-lg"></i>
                                        </button>
                                    @endif
                                    {{-- buttons end --}}
                                </div>
                            </div>
                        </div>

                        <div class="card card-custom gutter-b" id="kt_todo_view">
                            <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                                <div class="d-flex align-items-center my-2">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-light-primary symbol-40 mr-3">
                                               <span class="symbol-label font-weight-bolder">
                                                  {{ $receive->receiver_code }}
                                               </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                            <div class="d-flex">
                                                   <span
                                                       class="cursor-pointer font-size-lg font-weight-bolder text-dark-75 text-danger">
                                                       <b id="tcode">{{ $receive->dr_no }}</b>
                                                   </span>
                                                <span onclick="copyToClipboard()" class="btn-mute" id="copy">
                                                       <i class="ki ki-copy icon-md"></i>
                                                   </span>
                                                <div class="font-weight-bold text-muted">
                                                    <span class="label label-success label-dot mr-2"></span>

                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="toggle-off-item">
                                                       <span class="font-weight-bold text-muted cursor-pointer"
                                                             data-toggle="dropdown"> {{ $receive->sourcename }}

                                                           <i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
                                                    <div class="dropdown-menu col-6 dropdown-menu-left p-5">
                                                        <table>
                                                            <tr>
                                                                <td class="text-muted py-2"> Supplier </td>
                                                                <td class="pl-5">{{ $receive->supplier }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted py-2"> Receiver </td>
                                                                <td class="pl-5">{{$receive->branch_receiver}} </td>
                                                            </tr>
                                                           <tr>
                                                                <td class="text-muted py-2"> Received At </td>
                                                                <td class="pl-5">  {{ Carbon\Carbon::parse($receive->created_at)->format('M d, Y H:i A') }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end text-right my-2">
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x pt-4">
                                        <div class="d-flex align-items-center py-1">
                                               <span
                                                   class="label label-lg label-light-success label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                   data-toggle="tooltip" data-placement="bottom" title="Ticket Status">
                                                {{$receive->state}}
                                               </span>
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
                                                {{$receive->remarks}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="my-0">
                                        <div class="card-spacer-x pt-2">
                                            <b style="white-space: pre-wrap;font-family:inherit !important" class="font-size-lg"></b><br><br>
                                            {{-- requisition table --}}

                                            <table
                                                class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                style="text-align: center" id="receiving_items">
                                            </table>

                                            <table
                                                class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                                style="text-align: center" id="inventory_items">
                                            </table>

                                            <button class="btn btn-success" onclick="UpdateReceivingItems()" id="update_update_items">Update</button>
                                            <button class="btn btn-success" onclick="getOrderline()" id="reset">Reset</button>

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
                                    <span onclick="Comments()" class="btn btn-default btn-icon btn-sm mr-2"
                                          data-toggle="tooltip" title="Reload list">
                                           <i class="ki ki-refresh icon-sm"></i>
                                       </span>
                                </div>
                            </div>
                            <div class="card-footer p-0">
                                <div class="mb-3 px-5 pt-5" id="div_comments"></div>
                                <div class="card-spacer">
                                    <form method="POST" id="comment-form" enctype='multipart/form-data'
                                          onsubmit="submitComment()">
                                        <div class="row">
                                            <div id="comment" contenteditable="true" onkeypress="PasteImage(this)"
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

                            <div class="">
                                <h3 class="card-title align-items-start flex-column">

                                </h3>
                                <div class=" p-5">
                                       <span>
                                           <div class="font-weight-bold font-size-lg text-dark-50"><span class="text-primary" id="working-time"></span></div>
                                           <div class="font-weight-bold font-size-lg text-dark-50 my-2">
                                               <span class="text-warning" id="reopen-cnt"> </span>
                                           </div>
                                       </span>
                                    <div class="font-weight-bold font-size-lg text-dark-50 my-2">
                                        <span class="text-warning" id="ref-no"></span>
                                    </div>


                                </div>

                            </div>
                            <div class="card-body pt-4">

                            </div>
                        </div>

                        <div class="card card-custom gutter-b">

                            <div class="card-header align-items-center border-0 mt-4">

                            </div>
                            <div class="card-body pt-4">

                            </div>
                        </div>

                        <div class="card card-custom gutter-b">

                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-warning"> Receiving Logs <i class="flaticon-time-2 icon-lg"></i>  </span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm" id="cnt_logs"></span>
                                </h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="timeline timeline-justified timeline-4">
                                    <div class="timeline-bar"></div>
                                    <div style="max-height: 800px;overflow-y: auto" class="timeline-items" id="receiving_logs"></div>
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
    <div class="modal fade" id="UpdateItems" tabindex="-1" style="" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header ribbon ribbon-left">
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2"
                         style="top: 10px; left: -2px;"> Add Item </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="font-size:12px;font-weight: bold;" class="modal-body ">
                    {{-- content --}}
                    <table  class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
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
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2" style="top: 10px; left: -2px;"> Update Receiving Details </div>
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
                                <input class="form-control" name="dr_no" value="{{ $receive->dr_no }}"  type="text" required>
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
                               <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="10">{{$receive->remarks}}</textarea>
                            </span>
                        </div>
                        <div class="row my-5">
                            <span class="col-5"></span>
                            <span class="col-3">
                               <input class="btn btn-success" type="submit" value="Update">
                               <input type="hidden" value="{{$receive->id}}" name="recid">
                               <input type="hidden" value="{{$receive->sup_id}}" name="sender">
                            </span>
                        </div>
                    </form>
                </div>
                {{-- end content --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                    <input type="hidden" name="receiver" value="{{session()->get('user')->branch}}">
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
                {{--content--}}
                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="UpdateStatus(event)" method="post">
                        @csrf
                        <div class="col-lg-12 col-xxl-12 ">
                            <!--begin::Mixed Widget 1-->
                            <div  class="col bg-light-white  px-6 py-8 rounded-xl card card-custom  ribbon ribbon-left wave wave-animate-steady wave-success my-3 ">
                                <div class="row my-5">
                                    <label class="col-2 font-weight-bold" ><b>Status: </b></label>
                                    <span class="col-8">
                                           <select class="form-control"  name="status" type="text" required>

                                                    <option value=""></option>
                                              @foreach ($status->getStatus() as $res)
                                                  @if($res->id!=11 && $receive->status!=$res->id)
)
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
                                            <input type="submit" value="Submit" id="status_update" class=" btn btn-success">
                                            <input type="hidden" name="receiving_id" value="{{$receive->id}}">
                                            <input type="hidden" name="uid" value="{{session()->get('user')->id}}">

                                       </span>
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
    {{-- end Update the Status --}}
    {{-- Approvals   --}}
    <div class="modal fade" id="Approval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                <div class="modal-header ribbon ribbon-left">
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2"    style="top: 10px; left: -2px;"> Approvals </div>

                    <span class="text-success h4">Title: </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--content--}}
                <div class="modal-body">
                    <form class="my-5" action="#" onsubmit="ApprovedReceiving(event)" method="post">
                        @csrf
                        <div class="col-lg-12 col-xxl-12 ">
                            <!--begin::Mixed Widget 1-->
                            <div  class="col bg-light-white  px-6 py-8 rounded-xl card card-custom  ribbon ribbon-left wave wave-animate-steady wave-success my-3 ">
                                <div class="row my-5">
                                    <label class="col-2 font-weight-bold" for=""><b>Status: </b></label>
                                    <span class="col-8">
                                           <select class="form-control"  name="status" type="text" required>

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
                                    <input type="hidden" value="{{session()->get('user')->emp_id}}" name="approved_by">
                                    <input type="hidden" value="{{session()->get('user')->id}}" name="uid">
                                    <input type="hidden" value="{{$receive->id}}" name="receiving_id">


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
                {{--  --}}
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-2">Set per item:</div>
                    <div class="col-2"><input type="text" id="spi_default" placeholder="" value="50"
                                              class="form-control"></div>
                    <div class="col-3"></div>


                </div>
                {{--  --}}
                {{-- modal table --}}
                <div class="modal-body">
                    <table
                        class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                        style="text-align: center" id="inventory_custom_add">
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
        let drno = "{{ $receive->dr_no }}";
        let user = "{{ session()->get('user')->emp_id }}";
        let rec_id = "{{ $receive->id }}";
        let disable = {{ $receive->status }};
        let receiving_items = $("#receiving_items").DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
            columns: [
                {
                    data: null,
                    title: "<b class='text-nowrap'> PO No. </b>",
                    render: function (data, type, row) {
                        return `<b>${data.po_no}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b class='text-nowrap'> Branch </b>",
                    render: function (data, type, row) {
                        return `<b>${data.BranchName}</b>`;
                    },
                },
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
                    render: function (data, type, row)
                    {
                        return `<b><input type="number" id="qty${data.olid}" min="0" value="${data.qty_received}"  class="form-control" onchange="" ></b>`;
                    },
                },
                {
                    data: null,
                    title: "<b>Booklets</b>",
                    render: function (data, type, row) {
                        let json = JSON.stringify(row);
                        return `<b class='text-primary'>${data.booklet_no}</b>`;
                    },
                },
                {
                    data: null,
                    title: "<b> Copy per Set </b>",
                    render: function (data, type, row) {
                        return `<b class='text-primary'><input id="qty${data.id}" type="number" value="${data.copy_per_set}" class="form-control"></b>`;
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
                    @if($receive->status!=11)
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function (data, type, row) {
                        let html = `<b onclick='RemoveReceive(${JSON.stringify(
                            row
                        )})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>
                <b data-toggle='modal' onclick='CustomAdd(${JSON.stringify(
                            row
                        )})' data-target='#custom_add' type="button" ><i class="btn ki ki-plus icon-1x text-success"></i></b>`;

                        return html;
                    },
                },
                @endif
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
                    className: "text-wrap col-1",
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
                    @if($receive->status!=11)
                {
                    targets: [8],
                    className: "text-nowrap col-1",
                },
                @endif
            ],
        });
        let inventory_items = $("#inventory_items").DataTable({
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
                    title: "<b> Action </b>",
                    render: function (data, type, row) {
                        return `
                <b onclick='removeItem(${JSON.stringify(row)})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>
                `;
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

        function UpdateOrderline(){
            let formData = new FormData();
            formData.append("inventory_items", JSON.stringify(inventory_items_list));
            formData.append("po_receiving", JSON.stringify(po_receiving));
            formData.append("receiving_id", {{$receive->id}});

            axios
                .post(`/update-receiving-details`, formData)
                .then(function (response) {
                    // window.location.reload();
                    Swal.fire("Created Successfully", response.data, "success");
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
        function getReceivingLogs() {

            axios.get('/get-receiving-logs/{{$receive->id}}').then(function(response) {
                $(`#receiving_logs`).html('');
                appendReceivingLogs(response.data);
            }).catch(function(error) {
                console.log(`ERROR CATCH RES: ${error}`)
            });
        }

        function appendReceivingLogs(data){
            let startTimestamp="";
            let endTimestamp="";

            $(data).each((index, value) => {


                $(`#receiving_logs`).append(`
            <div class="timeline-item">
                <div class="timeline-badge"><div class="bg-primary"></div></div>
                <div class="timeline-content d-flex flex-column">
                <span class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"> ${ value.name } </span>
                <span style="white-space: pre-wrap;font-family:inherit !important" class="font-weight-normal text-dark-75 pb-3"> ${ value.remarks } </span>
                <div class="d-flex flex-grow-1 align-items-center">
                    <span class="label label-lg label-light-info label-inline font-weight-bold py-4 mr-3 text-nowrap" > ${ value.state } </span>
                   <span class="text-primary font-weight-bold text-nowrap">  ${moment(value.created_at).format("MMMM DD, YYYY HH:mm A")}   </span>
                </div>
                </div>
            </div>
            `);
            });

        }

        function UpdateStatus(event){
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form);

            axios
                .post(`/update-receiving-status`, formData)
                .then(function (response) {
                    Swal.fire("Created Successfully", response.data, "success");
                    window.location.reload();
                })
                .catch(function (error) {
                    Swal.fire("Error", error, "error");
                    console.log(error);
                });
        }

    </script>
    <script src="{{ asset('MyJs/ReceivingDetails.js') }}"></script>
@endsection
