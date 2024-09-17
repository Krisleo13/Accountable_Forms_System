@extends('layouts.app')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-7">
                    <div class="card card-custom gutter-b" style="background-color: white;border: 1px solid black">
                        <div class="card-header align-items-center justify-content-center flex-wrap py-5 h-auto">
                            <span style="font-size: 30px;text-align: center" class="text-dark">Accountable Forms</span>
                        </div>
                        <div class="card-body my-5">
                            <!-- Rest of your code -->
                              <div class="list list-hover min-w-500px" id="div_views">
                                    <form method="POST" onsubmit="Login(event)">
                                        @csrf

                                        <div class="row mb-3">
                                            <div class="col-md-1">
                                                <span
                                                    class="svg-icon svg-icon-dark svg-icon-3x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Mail-at.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M11.575,21.2 C6.175,21.2 2.85,17.4 2.85,12.575 C2.85,6.875 7.375,3.05 12.525,3.05 C17.45,3.05 21.125,6.075 21.125,10.85 C21.125,15.2 18.825,16.925 16.525,16.925 C15.4,16.925 14.475,16.4 14.075,15.65 C13.3,16.4 12.125,16.875 11,16.875 C8.25,16.875 6.85,14.925 6.85,12.575 C6.85,9.55 9.05,7.1 12.275,7.1 C13.2,7.1 13.95,7.35 14.525,7.775 L14.625,7.35 L17,7.35 L15.825,12.85 C15.6,13.95 15.85,14.825 16.925,14.825 C18.25,14.825 19.025,13.725 19.025,10.8 C19.025,6.9 15.95,5.075 12.5,5.075 C8.625,5.075 5.05,7.75 5.05,12.575 C5.05,16.525 7.575,19.1 11.575,19.1 C13.075,19.1 14.625,18.775 15.975,18.075 L16.8,20.1 C15.25,20.8 13.2,21.2 11.575,21.2 Z M11.4,14.525 C12.05,14.525 12.7,14.35 13.225,13.825 L14.025,10.125 C13.575,9.65 12.925,9.425 12.3,9.425 C10.65,9.425 9.45,10.7 9.45,12.375 C9.45,13.675 10.075,14.525 11.4,14.525 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                            </div>
                                            <div class="col-md-11">
                                                <input style="background-color: transparent;border-bottom: 1px solid black; border-top: none; border-left: none; border-right: none; " id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                          <br>

                                        <div class="row mb-3">
                                            <div class="col-md-1">
                                                <span
                                                    class="svg-icon svg-icon-dark svg-icon-3x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <mask fill="white">
                                                                <use xlink:href="#path-1" />
                                                            </mask>
                                                            <g />
                                                            <path
                                                                d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                            </div>

                                            <div class="col-md-11">
                                                <input style="background-color: transparent;border-bottom: 1px solid black; border-top: none; border-left: none; border-right: none; " id="password" type="password"
                                                    class="form-control  @error('password') is-invalid @enderror"
                                                    placeholder="Password" name="password" required
                                                    autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row mb-0 my-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-success col-3">
                                                    {{ __('Login') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link text-light"
                                                        href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3 my-5">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label text-dark" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

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
        function Login(event) {
            event.preventDefault();
            var form = event.target; // Get the form element
            var formData = new FormData(form); // Get form data
            $("#btn-class").prop("disabled", true);


            axios.post('/auth-user', formData).then(function(response) {

                    form.reset();
                    $("#btn-class").prop("disabled", false);
                    if (response.data == "Login Successful") {
                        Swal.fire('Login Successfully', response.data, 'success');
                        window.location.href = "/dashboard";
                    }else{
                        Swal.fire('Error', response.data, 'error');

                    }

                })
                .catch(function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error,
                        icon: 'error'
                    })
                });


        }
    </script>
@endsection
