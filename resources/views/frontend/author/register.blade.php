@extends('layouts.master')

@section('frontend_content')


<!--Login-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign up</h4>
                    <!--form-->
                    <form  class="sign-form widget-form" method="POST" action="{{ route('author.register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username*" name="name" value="">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address*" name="email" value="">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                        </div>

                        {{-- <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Agree to our <a href="#" class="btn-link">terms & conditions</a> </label>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{ route('author.loginer') }}" class="btn-link">Login</a> </p>
                    </form>

                </div>
            </div>
         </div>
    </div>
</section>


@endsection


@section('footer_content')

@if (session('success'))

<script>
    const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: "{{ session('success') }}",
  background: 'rgba(46, 204, 113,1.0)',
});

</script>

@endif

@endsection
