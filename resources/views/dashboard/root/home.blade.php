@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1 class="text-primary">Dashboard</h1>
        </div>
    </div>
</div>


@if (auth()->user()->role == 'admin')
    <div class="row">
        <div class="col-md-6 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-primary fw-bold text-left">Author Request</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Request Time</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                    @foreach ($author_req as $auth )

                    @if ($auth->approve_status == false)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $auth->name }}</td>
                        <td>{{ $auth->email }}</td>
                        <td> {{ \Carbon\Carbon::parse($auth->created_at)->diffForHumans() }}</td>
                        <td class="">
                        <div class="d-flex gap-3">
                         <a href="{{ route('home.approve.author', $auth->id ) }}" class="text-white badge bg-success">Accept</a>
                         <a href="{{ route('home.reject.author',$auth->id) }}" class="text-white badge bg-danger">Reject</a>
                        </div>
                        </td>
                      </tr>
                    @endif

                    @endforeach

                        </tbody>
                      </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-warning fw-bold text-left">Author Block List</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                    @foreach ($author_req as $auth )

                    @if ($auth->block_status == false)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $auth->name }}</td>
                        <td>{{ $auth->email }}</td>
                        <td class="">
                        <div class="">
                            <a href="{{ route('home.block.author',$auth->id) }}" class="text-white badge bg-danger">Block</a>
                        </div>
                        </td>
                      </tr>
                    @endif

                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
@endif




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
