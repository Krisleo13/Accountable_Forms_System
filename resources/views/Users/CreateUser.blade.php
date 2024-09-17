@extends('Layouts.app')

@section('sub_header')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            @include('Users.subheader')
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h6 class="text-dark font-weight-bold my-1 mr-5"> Users</h6>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-primary">
                            <h2 class="text-primary"> Create </h2>
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
                    <div class="col-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-header align-items-center flex-wrap py-5 h-auto">
                                <h1 class="text-primary">Create User</h1>
                            </div>
                            <div class="card-body my-5">
                                <div class="list list-hover min-w-500px" id="div_views">
                                    <form onsubmit="CreateUser(event)" method="POST">
                                        @csrf

                                        <div class="row my-5">
                                            <label for="name" class="col-3">
                                                Employee Name:</label>
                                            <span class="col-9">
                                                <select class="form-control" onchange="onchangeEmployee(this)"
                                                    name="emp_id" id="employeess" aria-placeholder="" required>
                                                    @foreach ($employees->GetEmployees() as $res)
                                                        <option data-dept="{{ $res->BCODE }}"
                                                            data-pos="{{ $res->POSITION }}" value="{{ $res->EMPID }}">
                                                            {{ $res->LASTNAME . ', ' . $res->FIRSTNAME . ' ' . $res->MIDDLENAME }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="emp_name" name="name" class="form-control"
                                                    value="">
                                            </span>
                                        </div>


                                        <div class="row my-5">
                                            <label for="name" class="col-3">
                                                Position:</label>
                                            <span class="col-9">
                                                <input id="position" type="text" name="position" class="form-control"
                                                    value="" required readonly>
                                            </span>
                                        </div>
                                        <div class="row my-5">
                                            <label for="name" class="col-3">
                                                Branch/Dept.:
                                            </label>
                                            <span class="col-9">
                                                {{-- <input id="branch" type="text" name="branch" class="form-control"
                                                    value="" required readonly> --}}
                                                <select onchange="onchangeDeparment(this.value)" class="form-control" name="branch" id="branch" >
                                                    <option value=""></option>
                                                    @foreach ($department->GetDeparment() as $res)
                                                        <option data-id="{{ $res->id }}" value="{{ $res->Alias }}">
                                                            {{ $res->BranchName }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <input type="hidden" id="dept_id" name="dept_id">
                                            </span>

                                        </div>
                                        <hr>
                                        {{-- <div class="row my-5">
                                            <label for="name" class="col-3">
                                                User Role:</label>
                                            <span class="col-9">
                                                <select class="form-control" name="role" id=""
                                                    aria-placeholder="" required>
                                                    <option value="">Select User Role</option>
                                                    <option value="1">Regional Manager</option>
                                                    <option value="2">Branch Manager</option>
                                                    <option value="3">inventory Manager</option>
                                                    <option value="4">Assignee</option>

                                                </select>
                                            </span>

                                        </div> --}}

                                        <div class="row my-5">
                                            <label for="name" class="col-3">
                                                Email:
                                            </label>
                                            <span class="col-9">
                                                <input type="email" name="email" class="form-control" value=""
                                                    required>
                                            </span>
                                        </div>

                                        <div class="row my-5">
                                            <label for="name" class="col-3">
                                                Password:
                                            </label>
                                            <span class="col-9">
                                                <input type="password" name="password" class="form-control" value=""
                                                    required>
                                            </span>
                                        </div>
                                        <input style="margin-left: 50%;margin-right: 50%" type="submit"
                                            class="btn btn-light-primary" value="Create">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let department=[];
        let employee=[];

        $(document).ready(function() {
            $('#employeess').select2();
            getDepartment();
            getEmployees();
        });

        function submitUsers(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data
            $("#btn-user").prop("disabled", true);


            axios.post('/register', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    $("#btn-items").prop("disabled", false);
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });
        }

        function onchangeEmployee(val) {
            $("#emp_name").val($("#employeess option:selected").text());
            $("#position").val($("#employeess option:selected").data("pos"));
            $("#branch").val($("#employeess option:selected").data("dept"));
            $("#dept_id").val($("#branch option:selected").data("id"));


        }
        function onchangeDeparment(val){

            let filtered_employees=[];
            let option="";
            $(`#employeess`).html("");
            filtered_employees=employee.filter(function (item) {
                return item.BCODE === val;
            });
            console.log(val);

            filtered_employees.forEach(function(data, index) {
                option+=` <option data-dept="${data.BCODE}"  data-pos="${ data.POSITION }" value="${data.EMPID}">     ${ data.LASTNAME}, ${data.FIRSTNAME} ${data.MIDDLENAME }  </option>`;
            });
            $(`#employeess`).html(option);
        }

        function CreateUser(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data
            $("#btn-class").prop("disabled", true);


            axios.post('/add-user', formData).then(function(response) {
                    Swal.fire('Created Successfully', response.data, 'success');
                    form.reset();
                    $("#btn-class").prop("disabled", false);
                    window.location.href = "/dashboard";
                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });


        }

        function  getDepartment(){
            axios.get('/get-department').then(function(response) {
                department=response.data;

              }).catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });

        }

        function  getEmployees(){
            axios.get('/get-employees').then(function(response) {
                employee=response.data;

            }).catch(function(error) {
                Swal.fire({
                    title: "ERROR",
                    text: error,
                    icon: 'error'
                })
            });

        }
    </script>
@endsection
