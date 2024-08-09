@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h2 class="text-primary">Role Mangaer</h2>
        </div>
    </div>
</div>

{{-- modal of restore and permanet delete data --}}

<div class="row mb-3">
    <div class="col-lg-12 cols-md-6">
        <div class="d-flex justify-content-end gap-3">
            {{-- permanent delet --}}
            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#forcedelet">Trash</button>
            {{-- restore trash --}}
            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Restore</button>
        </div>
    </div>
</div>

{{-- restore data --}}

<div class="modal fade bg-success" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center">
            Restore All Trashes
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $trashes as $trash )
                    <tr>
                        <td>{{ $trashes->firstItem() + $loop->index }}</td>
                        <td>{{ $trash->name }}</td>
                        <td>{{ $trash->email }}</td>
                        <td><a href="javascript::vloid(0)" class="badge bg-primary">{{ $trash->role }}</a></td>
                        <td>
                            <form action="{{ route('role.restore', $trash->id ) }}" method="POST">
                                @csrf
                                <button class="btn btn-success">
                                   Restore
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-danger text-center" colspan="4">
                            No Data Found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
              </table>
              {{ $trashes->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bg-danger" id="forcedelet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center">
            Delete All Trashes
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $trashes as $trash )
                    <tr>
                        <td>{{ $trashes->firstItem() + $loop->index }}</td>
                        <td>{{ $trash->name }}</td>
                        <td>{{ $trash->email }}</td>
                        <td><a href="javascript::vloid(0)" class="badge bg-primary">{{ $trash->role }}</a></td>
                        <td>
                            <form action="{{ route('role.forcedelete', $trash->id ) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger">
                                   Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-danger text-center" colspan="4">
                            No Data Found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
              </table>
              {{ $trashes->links() }}
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row">
    <div class="col-md col-lg-7">
        <div class="card">
            <div class="card-header">
                <h3 class="text-primary">Modaretor List</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Create Time</th>
                        @if (auth()->user()->role == 'admin')
                        <th scope="col">Handle</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
@forelse ($modaretors as $modaretor)
                          <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $modaretor->name }}</td>
                            <td>{{ $modaretor->email }}</td>
                            <td><a href="javascript::vloid(0)" class="badge bg-primary">{{ $modaretor->role }}</a></td>
                            <td>{{ $modaretor->created_at }}</td>

                            @if (auth()->user()->role == 'admin')
                            <td>
                            <form action="{{ route('role.at',$modaretor->id ) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                            </form>
                            </td>
                            @else

                            @endif

                          </tr>
@empty
<td class="text-danger text-center fw-bold" colspan="6">
    No Data Found
</td>
</tr>
@endforelse
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    {{-- insert modaretor --}}

@if (auth()->user()->role == 'admin')
            <div class="col-md col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-primary">Modaretor Insert</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role.modaretor') }}" method="POST">
                            @csrf
                        <div class="auth-credentials m-b-xxl">
                            <label for="signUpUsername" class="form-label">Name</label>
                            <input type="name" name="name" class="form-control m-b-md  @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name') }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="signUpEmail" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control m-b-md @error('email') is-invalid @enderror" placeholder="example@neptune.com" value="{{ old('email') }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="signUpPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <label for="signUpPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                        </div>

                        <div class="auth-submit">
                            <button type="submit" class="btn btn-primary">insert</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
@else


<div class="col-md col-lg-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-primary">All User List</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                    {{-- <th scope="col">Create Time</th> --}}
                  </tr>
                </thead>
                <tbody>
@forelse ($specific_user as $modaretor)
                      <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{ $modaretor->name }}</td>
                        <td>{{ $modaretor->email }}</td>
                        <td><a href="javascript::vloid(0)" class="badge bg-primary">{{ $modaretor->role }}</a></td>
                        {{-- <td>{{ $modaretor->created_at }}</td> --}}
                      </tr>
@empty
<td class="text-danger text-center fw-bold" colspan="6">
    No Data Found
</td>
@endforelse
                </tbody>
              </table>
        </div>
    </div>
</div>


@endif

</div>

@if (auth()->user()->role == 'admin')
    <div class="row">
        <div class="col-md col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">Role Assign</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.assign') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Users</label>
                          <select name="user_id" id=""  class="form-control">
                           @foreach ($specific_user as $user)
                           <option value="{{ $user->id }}">{{ $user->name }}</option>
                           @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Role Assign</label>
                        <select name="role_name" id="" class="form-control">
                            <option value="modaretor">Modaretor</option>
                            <option value="author">Author</option>
                            <option value="member">Member</option>
                            <option value="visitor">Visitor</option>
                        </select>
                        </div>
                        <button class="btn btn-primary">promoted</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@else

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
