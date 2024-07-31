@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1 class="text-primary">Profile</h1>
        </div>
    </div>
</div>


{{-- name and email update --}}

<div class="row">
    <div class="col-md col-lg-6">
        <div class="card">
            <div class="card-header">
                <label for="">Name Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('name.update',Auth::user()->id) }}" method="POST">
                    @csrf
                    <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ auth()->user()->name }}">
                    <div class="mt-3">
                     <button class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- email update --}}

    <div class="col-md col-lg-6">
        <div class="card">
            <div class="card-header">
                <label for="">Email Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('email.update',Auth::user()->id) }}" method="POST">
                    @csrf
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ auth()->user()->email }}">
                    <div class="mt-3">
                     <button class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- password updated --}}

<div class="row">
    <div class="col-md col-lg-6">
        <div class="card">
            <div class="card-header">
                <label for="">Password Updated</label>
            </div>
            <div class="card-body">
                <form action="{{ route('password.update', Auth::user()->id ) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="enter your current password">
                    </div>

                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="enter your new password">
                    </div>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="enter your confirm password">
                    </div>

                    <button class="btn btn-primary">update</button>
                </form>
            </div>
        </div>
    </div>

    {{-- image updated --}}

    <div class="col-md col-lg-6">
        <div class="card">
            <div class="card-header">
                <label for="">Image Update</label>
            </div>
            <div class="card-body">
                <form action="{{ route('image.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <img src="{{ asset('uploads/profile') }}/{{ auth()->user()->image }}"
                        style="width: 60px; height:60px; border: 1px solid red; border-radius:50px">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="image">
                    </div>
                    <button class="btn btn-primary">update</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
});

</script>

@endif

@endsection
