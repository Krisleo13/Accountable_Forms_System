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
            <div class="container">
                <div class="d-flex flex-column flex-md-row">

                    <div class="flex-md-row-fluid">
                        <div class="card card-custom gutter-b">
                            <div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
                                <div class="card-toolbar">
                                    {{-- buttons --}}
                                        @if($po->status==5)
                                            <button data-toggle='modal' data-target='#Approval' type="button"
                                                    class="btn btn-warning mr-2">
                                                Approval <i class="flaticon-like icon-lg"></i>
                                            </button>
                                       @endif

                                        @if($po->status==4 || $po->status==5)
                                            <button data-toggle='modal' data-target='#UpdatePO' type="button"
                                                    class="btn btn-primary mr-2">
                                                Update <i class="flaticon-edit-1 icon-lg"></i>
                                            </button>

                                            <button data-toggle='modal' data-target='#UpdateItems' type="button"
                                                    class="btn btn-success mr-2">
                                                Add Items <i class="flaticon-add-circular-button icon-lg"></i>
                                            </button>
                                        @endif


                                        @if(($po->status==4 || $po->status==6) || $po->status==7  )
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
                                                   MIS
                                               </span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                            <div class="d-flex">
                                                   <span
                                                       class="cursor-pointer font-size-lg font-weight-bolder text-dark-75 text-danger">
                                                       <b id="tcode">{{ $po->po_no }}</b>
                                                   </span>
                                                <span onclick="copyToClipboard()" class="btn-mute" id="copy">
                                                       <i class="ki ki-copy icon-md"></i>
                                                   </span>
                                                <div class="font-weight-bold text-muted">
                                                    <span class="label label-success label-dot mr-2"></span>
                                                    {{ Carbon\Carbon::parse($po->created_at)->diffForHumans() }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="toggle-off-item">
                                                       <span class="font-weight-bold text-muted cursor-pointer"
                                                             data-toggle="dropdown"> {{ $po->supplier }} -
                                                           {{ $po->term }}
                                                           <i class="flaticon2-down icon-xs ml-1 text-dark-50"></i></span>
                                                    <div class="dropdown-menu col-6 dropdown-menu-left p-5">
                                                        Supplier Info:

                                                        <table>
                                                            <tr>
                                                                <td class="text-muted py-2"> Supplier </td>
                                                                <td class="pl-5"> {{ $po->supplier }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted py-2"> Address </td>
                                                                <td class="pl-5"> {{ $po->address }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted py-2"> Term </td>
                                                                <td class="pl-5"> {{ $po->term }} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted py-2"> Sent At </td>
                                                                <td class="pl-5">
                                                                    {{ Carbon\Carbon::parse($po->created_at)->format('M d, Y H:i A') }}
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
                                    <div
                                        class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x pt-4">
                                        <div class="d-flex align-items-center py-1">
                                               <span
                                                   class="label label-lg label-light-success label-inline text-uppercase font-weight-bold py-5 mr-3"
                                                   data-toggle="tooltip" data-placement="bottom" title="Ticket Status">
                                                   {{ $po->state }}
                                               </span>
                                            {{--                                            <span--}}
                                            {{--                                                class="label label-lg label-light-success label-inline text-uppercase font-weight-bold py-5 mr-3"--}}
                                            {{--                                                data-toggle="tooltip" data-placement="bottom" title="Priority Level">--}}

                                            {{--                                            </span>--}}
                                            {{--                                            <span--}}
                                            {{--                                                class="label label-lg label-light-danger label-inline text-uppercase font-weight-bold py-5 mr-3"--}}
                                            {{--                                                data-toggle="tooltip" title="Due Date">--}}
                                            {{--                                              --}}
                                            {{--                                            </span>--}}
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
                                            <b style="white-space: pre-wrap;font-family:inherit !important"
                                               class="font-size-lg">{{ $po->remarks }}</b><br><br>
                                            {{-- requisition table --}}
                                            <table
                                                class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center"
                                                style="text-align: center" id="po_items">
                                            </table>

                                            <button class="btn btn-success" onclick="UpdateOrderline()"
                                                    id="update_orderline">Update</button>
                                            <button class="btn btn-success" onclick="getOrderline()"
                                                    id="reset">Reset</button>
                                            <br>
                                            <br>
                                            <span > Requesting Department:</span>  <b class="text-warning" id="requesting_dept"></b>


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
                                           <div class="font-weight-bold font-size-lg text-dark-50"><span class="text-primary"
                                                                                                         id="working-time"></span></div>
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
                                    <span class="font-weight-bolder text-warning"> Purchase Order Logs <i class="flaticon-time-2 icon-lg"></i>  </span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm" id="cnt_logs"></span>
                                </h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="timeline timeline-justified timeline-4">
                                    <div class="timeline-bar"></div>
                                    <div style="max-height: 800px;overflow-y: auto" class="timeline-items" id="PO_logs"></div>
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
    <div class="modal fade" id="UpdateItems"tabindex="-1" style="" role="dialog" aria-labelledby="exampleModalLabel"
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
                            style="text-align: center" id="req_table">
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

    {{-- start Update Purchase Order --}}
    <div class="modal fade" id="UpdatePO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-body" role="document">
            <div class="modal-content">
                {{-- content --}}
                <div class="modal-header ribbon ribbon-left">
                    <div class="ribbon-target bg-success font-weight-bold font-size-h6 mt-2" style="top: 10px; left: -2px;"> Update Requisition </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="font-size:12px;font-weight: bold;" class="modal-body">
                    <form class="my-5" action="#" onsubmit="UpdatePO(event)" method="get">
                        @csrf
                        <div class="row my-5">
                            <span class="col-1"></span>
                            <label class="col-2" for="">Supplier:</label>
                            <span class="col-5">
                                <select class="form-control" onchange="onchangeSupplier(this.value)"
                                        value="{{ $po->sid }}" name="supplier" id="suppplier"
                                        type="text" required
                                        @if ($po->status == 3) disabled @endif>
                                    <option value="" disabled>Select Supplier</option>
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
                                <input class="form-control" value="{{ $po->address }}" id="address" name="address" type="text" readonly>
                            </span>
                        </div>
                        <div class="row my-5">
                            <span class="col-1"></span>
                            <label class="col-2" for="">Term:</label>
                            <span class="col-5">
                                <select class="form-control" id="term" value="{{ $po->term }}"  name="term" type="text"    required>
                                    <option value="" disabled></option>
                                    <option value="1">Full Payment</option>
                                    <option value="2">Payment On Delivery</option>
                                </select>
                            </span>

                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-2">Remarks:</div>
                            <div class="col-8">
                                <textarea name="remarks" id="" class="form-control" cols="30" rows="5">{{ $po->remarks }}</textarea>

                            </div>


                        </div>
                        <div class="row my-5">
                            <div class="col-4"></div>
                            <input type="submit" class="btn btn-success" value="Update">
                            <input type="hidden" value="{{$po->id}}"  name="poid"/>
                        </div>
                    </form>
                </div>
                {{-- end content --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class='fas fa-times'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- end Update Purchase Order --}}

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
                                                   @if($po->status != 6 && ($po->status !=7 && $po->status != 8) && (($res->id!=6 && $res->id != $po->status) ))

                                                       <option value="{{ $res->id }}"> {{ $res->state }} </option>
                                                   @elseif(($res->id==7 || $res->id==8) && $res->id != $po->status)
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
                                           <input type="hidden" name="poid" value="{{$po->id}}">
                                       </span>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button onclick="UpdateNotes()" class="btn btn-success">Update</button>
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
                    <form class="my-5" action="#" onsubmit="ApprovedPO(event)" method="post">
                        @csrf
                        <div class="col-lg-12 col-xxl-12 ">
                            <!--begin::Mixed Widget 1-->
                            <div  class="col bg-light-white  px-6 py-8 rounded-xl card card-custom  ribbon ribbon-left wave wave-animate-steady wave-success my-3 ">
                                <div class="row my-5">
                                    <label class="col-2 font-weight-bold" for=""><b>Status: </b></label>
                                    <span class="col-8">
                                           <select class="form-control"  name="status" type="text" required>

                                               <option value=""></option>
                                               <option value="4">Disapproved</option>
                                               <option value="6">Approved</option>
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

                                           <input type="hidden" name="poid" value="{{$po->id}}">
                                           <input type="hidden" name="emp_id" value="{{session()->get('user')->emp_id}}">
                                           <input type="hidden" name="uid" value="{{session()->get('user')->id}}">
                                       </span>
                                </div>
                                <div class="row my-5">
                                    <span class="col-3"></span>
                                    <input type="submit" class="btn btn-success" value="Submit">
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

@endsection

@section('script')
    <script>
        let po_items = [];
        let req_items = [];
        let delitems=[];

        let formData = new FormData();
        let po_table = $('#po_items').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
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


                        return `<b class='text-primary'>${data.code }</b>`;
                    }
                },
                {
                    data: null,
                    title: "<b> Branch/Dept </b>",
                    render: function(data, type, row) {
                        return `<b>${data.BranchName}</b>`;
                    }
                },
                {
                    data: null,
                    title: `<b> Date</b>`,
                    render: function(data, type, row) {
                        return `<b>${moment(data.created_at).format("MMM d, YYYY HH:mm A") }</b>`;
                    }
                },
                    @if ($po->status < 5)
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function(data, type, row) {
                        return `<b onclick='setReqList(${JSON.stringify(row)})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>`;
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
                    className: "text-wrap col-2"
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
                    @if ($po->status < 5)
                {
                    targets: [6],
                    className: "text-nowrap col-1"
                }
                @endif

            ]
        });
        let req_table = $('#req_table').DataTable({
            responsive: false,
            Destroy: true,
            paging: false,
            searching: false,
            scrollX: true,
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
                    data: null,
                    title: "<b> Branch/Dept </b>",
                    render: function(data, type, row) {
                        return `<b>${data.BranchName}</b>`;
                    }
                },
                {
                    data: null,
                    title: `<b> Date</b>`,
                    render: function(data, type, row) {
                        return `<b>${moment(data.created_at).format("MMM d, YYYY HH:mm A") }</b>`;
                    }
                },

                @if ($po->status < 5)
                {
                    data: null,
                    title: "<b> Action </b>",
                    render: function(data, type, row) {
                        return `<b class="text-success" onclick='setPOList(${JSON.stringify(row)})'><i class="btn ki ki-solid-plus icon-2x text-success"></i><b>`;
                    }
                }
                @endif

            ],
            columnDefs: [{
                targets: [0],
                className: "text-nowrap col-2"
            },
                {
                    targets: [1],
                    className: "text-wrap col-1"
                },
                {
                    targets: [2],
                    className: "text-nowrap col-2"
                },
                {
                    targets: [3],
                    className: "text-wrap col-2"
                },
                {
                    targets: [4],
                    className: "text-nowrap col-1"
                },
                {
                    targets: [5],
                    className: "text-wrap col-3"
                },
                    @if ($po->status < 5)
                {
                    targets: [6],
                    className: "text-nowrap col-2"
                }
                @endif

            ]
        });

        $('#UpdateItems').on('shown.bs.modal', function() {
            // Initialize or redraw the DataTable here
            $('#req_table').DataTable().draw();
        });



        function setReqList(row) {

            req_items.push(row);
            req_table.search('').columns().search('').clear().draw();

            req_table.rows.add(req_items).draw(true);
            // Now, you can remove the item from po_items as follows:
            delitems.push(row);

            let index = po_items.findIndex(item => item.id === row.id);

            if (index !== -1) {
                po_items.splice(index, 1);
                po_table.search('').columns().search('').clear().draw();
                po_table.rows.add(po_items).draw(true);
            }
            // unhide button
             $('#update_orderline').show();
             $('#reset').show();
        }

        function setPOList(row) {
            po_items.push(row);
            po_table.search('').columns().search('').clear().draw();
            po_table.rows.add(po_items).draw(true);

            let index = req_items.findIndex(item => item.id === row.id);
            let delindex = req_items.findIndex(item => item.id === row.id);
            let requesters = $("#requesters").val();
            let branches = "";

            if (index !== -1) {
                req_items.splice(index, 1);
                req_table.search('').columns().search('').clear().draw();
                req_table.rows.add(req_items).draw(true);
            }
            if (delindex !== -1) {
                delitems.splice(delindex, 1);
                console.log(delitems);

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
            $('#reset').show();
            $('#update_orderline').show();

        }

        function onchangeSupplier(select) {
            $("#address ").val($("#suppplier option:selected").data("address"));
            $("#term").val($("#suppplier option:selected").data("term"));

        }

        function UpdatePO(event) {
            event.preventDefault();
            let form = event.target; // Get the form element
            let formData = new FormData(form);
            $("#btn-save").prop("disabled", true);

            axios.post('/update-purchase-order', formData).then(function(response) {
                Swal.fire('Created Successfully', response.data, 'success');
                form.reset();
                $("#btn-save").prop("disabled", false);
                location.reload();
            })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });
        }
        function UpdateOrderline() {

            let formData = new FormData();
            formData.append("po_items", JSON.stringify(po_items));
            formData.append("poid", parseInt('{{$po->id}}'));
            formData.append("delitems", JSON.stringify(delitems));
            $("#btn-save").prop("disabled", true);

            axios.post('/update-purchase-order-items', formData).then(function(response) {
                Swal.fire('Created Successfully', response.data, 'success');

                $("#btn-save").prop("disabled", false);
                $('#reset').hide();
                $('#update_orderline').hide();
                getOrderline();
                // location.reload();
            })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    });
                    console.log(error);
                });
        }

        function getRequisitions() {
            axios.get('/for-purchase-order').then(function(response) {
                req_items = response.data;
                req_table.search('').columns().search('').clear().draw();
                req_table.rows.add(response.data).draw(true);

            }).catch(function(error) {});
        }

        function getPOLogs() {
            axios.get('/get-po-logs/{{$po->id}}').then(function(response) {
                $(`#PO_logs`).html('');
                appendPOlogs(response.data);
            }).catch(function(error) {});
        }

        function appendPOlogs(data){
            let startTimestamp="";
            let endTimestamp="";

            $(data).each((index, value) => {


                $(`#PO_logs`).append(`
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

        function getOrderline() {
            axios.get('/get-order-line/{{ $po->id }}/null', formData).then(function(response) {
                po_items = response.data;
                console.log(po_items);
                po_table.search('').columns().search('').clear().draw();
                po_table.rows.add(response.data).draw(true);
                $('#reset').hide();
                $('#update_orderline').hide();
                // display the requesting department
                const uniqueNames = getUniquePropertyValues(response.data, 'BranchName');

                $('#requesting_dept').html(uniqueNames);
            }).catch(function(error) {

                });
        }

        function ApprovedPO(event) {
            event.preventDefault();
            let form = event.target; // Get the form element
            let formData = new FormData(form);
            axios.post(`/approved-purchase-order`, formData)
                .then( async function(
                    response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                   await getOrderline();
                    $("#btn-save").prop("disabled", false);
                    await AddToInvnetory();

                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error.message,
                        icon: 'error'
                    })
                });
            // location.reload();
        }

        function AddToInvnetory() {
            var formData = new FormData();
            formData.append("po_items", JSON.stringify(po_items));
            axios.post(`/add-to-inventory`, formData)
                .then(function(
                    response) {
                    // Swal.fire('Created Successfully', response.data, 'success');
                    $("#btn-save").prop("disabled", false);
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error.message,
                        icon: 'error'
                    })

                });

        }
       function UpdateStatus(event){
           event.preventDefault();
           var form = event.target; // Get the form element
           var formData = new FormData(form);
           formData.append("po_items", JSON.stringify(po_items));
           $("#btn-save").prop("disabled", true);

           axios.post('/update-purchase-order-status', formData).then(function(response) {
               Swal.fire('Created Successfully', response.data, 'success');
               form.reset();
               $("#btn-save").prop("disabled", false);
               location.reload();
           })
               .catch(function(error) {
                   Swal.fire({
                       title: "ERROR",
                       text: error,
                       icon: 'error'
                   })
               });

       }

        function getUniquePropertyValues(arrayOfObjects, property) {
            // Create an empty object to store unique values
            const uniqueValues = {};

            // Iterate through the array of objects
            arrayOfObjects.forEach(obj => {
                // Add the property value to the object as a key
                uniqueValues[obj[property]] = true;
            });
            // Get the keys of the object (unique values)
            const uniqueArray = Object.keys(uniqueValues);

            // Get the keys of the object (unique values)
            return uniqueArray.join(', ');
        }




        $(document).ready(async function() {
           await getRequisitions();
           await getOrderline();
           await getPOLogs();
           await $('#update_orderline').hide();
           await $('#reset').hide();

        });
    </script>
@endsection
