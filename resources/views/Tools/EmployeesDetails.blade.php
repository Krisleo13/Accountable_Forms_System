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
	<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <!--begin::Details-->
                        <div class="d-flex mb-9">
                            <!--begin: Pic-->
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol symbol-lg-75 d-none">
                                <img alt="Pic" src="assets/media/users/300_10.jpg" />
                                </div>
                                <div class="symbol symbol-lg-75 symbol-primary">
                                    <span class="symbol-label font-size-h3 font-weight-boldest"></span>
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between flex-wrap mt-1">
                                    <div class="d-flex mr-3">
                                        <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$employee->first_name}} {{$employee->last_name}}</a>
                                        <a href="#">
                                            <i class="flaticon2-correct text-success font-size-h5"></i>
                                        </a>
                                    </div>

                                </div>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="d-flex flex-wrap justify-content-between mt-1">
                                    <div class="d-flex flex-column flex-grow-1 pr-8">
                                        <div class="d-flex flex-wrap mb-4">
                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{$employee->email}}</a>
                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i></a>
                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                            <i class="flaticon2-placeholder mr-2 font-size-lg"></i>Melbourne</a>
                                        </div>
                                        <span class="font-weight-bold text-dark-50">{{-- --}}</span>
                                        <span class="font-weight-bold text-dark-50">{{-- --}}</span>
                                    </div>
                                    <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                                        <span class="font-weight-bold text-dark-75">Progress</span>
                                        <div class="progress progress-xs mx-3 w-100">
                                            <div class="progress-bar bg-success" role="progressbar" id="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="font-weight-bolder text-dark" id="progress"></span>
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <div class="separator separator-solid"></div>
                        <!--begin::Items-->
                        <div class="d-flex align-items-center flex-wrap mt-8">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon2-box-1 display-4 text-muted font-weight-bold"></i>
                                </span>
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Total Task</span>
                                    <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold" id="my-task"></span></span>
                                </div>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-close display-4 text-muted font-weight-bold"></i>
                                </span>
                                    <a href="/ticket-closed">
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Closed</span>
                                        <span class="font-weight-bolder font-size-h5">
                                        <span class="text-dark-50 font-weight-bold" id="closed"></span></span>
                                    </div>
                                    </a>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                                </span>
                                    <a href="/my-tasks">
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Active Task</span>
                                    <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold" id="task"></span></span>
                                </div>
                                    </a>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-cancel display-4 text-muted font-weight-bold"></i>
                                </span>
                                    <a href="/cancel-disapproved">
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Discontinued Task</span>
                                    <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold" id="discontinued"></span></span>
                                </div>
                                    </a>
                            </div>

                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                <span class="mr-4">
                                    <i class="flaticon-time display-4 text-muted font-weight-bold"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 font-weight-bolder font-size-sm">Average Resolution Time</span>
                                    <span class="text-dark-50 font-weight-bold" id="avg-resolve-time"></span></span>
                                </div>
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->

                            <!--end::Item-->
                        </div>
                        <!--begin::Items-->
                    </div>
                </div>
                <!--end::Card-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-4">
                        <!--begin::Advance Table Widget 2-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">History</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">   </span>
                                </h3>

                                <span class="card-toolbar">
                                        {{-- <select onchange="setvValueofGraph(this.value)" class="form-control form-control-sm" id="Month">
                                            <option value="0">All</option>
                                        </select> --}}

                                    </span>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body ">

                                        <div id="BU_Chart" style="height: 200px"></div>

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Advance Table Widget 2-->
                    </div>
                    <div class="col-lg-8">
                        <!--begin::Mixed Widget 14-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title font-weight-bolder">Booklets Assigned</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column">

                                    <div id="kt_gchart_4"  style="width: 100%; height: 400px;"></div>

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 14-->
                    </div>
                </div>
                <!--end::Row-->

            </div>

            <!--end::Container-->
        </div>
    </div>

@endsection

@section('script')
    <script>

    </script>
@endsection
