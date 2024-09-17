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
                        <a href="#" class="text-primary"> <h4> Receive Orders</h4> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content"  >
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    {{-- form  --}}
                                    <form class="my-5" action="#" onsubmit="SubmitReceivingInventoy(event)"
                                        method="get">

                                        <div class="col-xl-12">
                                            <div class="form-group row">
                                                <h3 class=" col-6 mb-5 font-weight-bold text-dark">
                                                    Receiving Orders
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
                                                </select>
                                            </span>
                                        </div><br>
                                        {{-- this is the add data to the table --}}
                                        <button data-toggle='modal' data-target='#req_list' type="button"
                                            class="btn btn-success font-weight-bolder mr-2">
                                            Add <i class="ki ki-bold-sort"></i>
                                        </button><br>
                                        {{-- end --}}
                                        {{-- add Receiving Details --}}

                                        <table
                                            class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                            style="text-align: center" id="receiving_items">
                                        </table>
                                        {{-- end --}}

                                        {{-- this is the add data to the table --}}


                                        <br>
                                        {{-- end --}}

                                        {{-- start table --}}
                                        <table
                                            class="table table-hover table-lg table-head-custom table-head-bg table-bordered table-vertical-center my-5"
                                            style="text-align: center" id="inventory_items">
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
                    <h5 class="modal-title text-success" id="exampleModalLabel"> Purchase Orders <i
                            class="flaticon-list text-success icon-lg"></i>
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
                                <th scope="col">PO.No.</th>
                                <th scope="col">Description</th>
                                <th scope="col">Branch/Dept</th>
                                <th scope="col">Group</th>
                                <th scope="col">Action</th>
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
    <script src="{{ asset('MyJs/Receiving.js') }}"></script>
@endsection
