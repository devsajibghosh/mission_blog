@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1 class="text-warning">Tags</h1>
        </div>
    </div>
</div>


<div class="row">
    <div class="col">
        <div class="d-flex justify-content-end gap-2 mb-3 mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Restore</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#forcedelet" title="permanent delete">Trash</button>
        </div>
    </div>
</div>

{{-- modal of restore --}}

<div class="modal fade bg-primary" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $trashes as $trash)
                    <tr>
                        <td>{{ $trashes->firstItem() + $loop->index }}</td>
                        <td>{{ $trash->title }}</td>
                        <td>
                            <form action="{{ route('tag.restore', $trash->id ) }}" method="POST">
                                @csrf
                                <button class="btn btn-success">
                                   Restore
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-danger text-center fw-bold" colspan="4">
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

{{-- permanent delet from database --}}

<div class="modal fade bg-danger" id="forcedelet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $trashes as $trash )
                    <tr>
                        <td>{{ $trashes->firstItem() + $loop->index }}</td>
                        <td>{{ $trash->title }}</td>
                        <td>
                            <form action="{{ route('tag.forcedelete',$trash->id) }}" method="post">
                                @csrf
                                <button class="btn btn-danger">
                                    Permanent Delete
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

{{-- tags-table --}}
<div class="row">
    <div class="col-md-6 col-lg-7">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($tags as $tag)
                    <tr>
                        <td>{{ $tags->firstItem() + $loop->index }}</td>
                        <td>{{ $tag->title }}</td>
                        <td class="d-flex gap-1">
                            {{-- tags edit --}}
                            <a href="{{ route('tag.edit',$tag->title) }}" class="badge bg-primary">edit</a>
                            {{-- tag delete --}}
                            <form action="{{ route('tag.delete',$tag->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="badge bg-danger">delete</button>
                            </form>
                            <form action="{{ route('tag.status', $tag->id ) }}" method="POST">
                                @csrf
                                @if ($tag->status == 'active')
                                <button type="submit" class="badge bg-success">active</button>
                                @else
                                <button type="submit" class="badge bg-danger">deactive</button>
                                @endif
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
                  {{ $tags->links() }}
            </div>
        </div>
    </div>
    {{-- insert tags --}}
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header">
                <label for="" class="fs-3 text-warning">Insert Tags</label>
            </div>
            <div class="card-body">
                <form action="{{ route('tag.insert') }}" method="POST">
                    @csrf
                 <div class="mb-3">
                    <label for="" class="fw-4 text-primary">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="enter tag title">
                 </div>
                 <button class="btn btn-warning">insert</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

{{-- alret section --}}

@section('foter_content')

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
