@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h3 class="text-primary">Blogs Page</h3>
        </div>
    </div>
</div>

{{-- restore and parmanent trash --}}

<div class="row">
    <div class="col">
        <div class="d-flex justify-content-end gap-2 mb-3 mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Restore</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#forcedelet" title="permanent delete">Trash</button>
        </div>
    </div>
</div>

{{-- end restore and permatnent delete button --}}

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
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">User_Name</th>
                    <th scope="col">Category_Title</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $trashes as $trash)
                    <tr>
                        <td>{{ $trashes->firstItem() + $loop->index }}</td>
                        <td>
                            <img src="{{ asset('uploads/blogs') }}/{{ $trash->image }}"
                            style="width: 120px; height:100px;">
                        </td>
                        <td>{{ $trash->title }}</td>
                        <td>{{ $trash->RelationshipWithUSer->name }}</td>
                        <td>{{ $trash->RelationshipWithCategory->title }}</td>
                        <td>
                            <form action="{{ route('blog.new.restore', $trash->id ) }}" method="POST">
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

{{-- permanent delete --}}


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
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">User_Name</th>
                    <th scope="col">Category_Title</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ( $trashes as $trash )
                    <tr>
                        <td>{{ $trashes->firstItem() + $loop->index }}</td>
                        <td>
                            <img src="{{ asset('uploads/blogs') }}/{{ $trash->image }}"
                            style="width: 120px; height:100px;">
                        </td>
                        <td>{{ $trash->title }}</td>
                        <td>{{ $trash->RelationshipWithUSer->name }}</td>
                        <td>{{ $trash->RelationshipWithCategory->title }}</td>
                        <td>
                            <form action="{{ route('blog.new.forcedelete',$trash->id) }}" method="POST">
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

{{-- blogs lists --}}
<div class="row">
    <div class="col-md col-lg">
        <div class="card">
            <div class="card-header">
                <label for="">Blogs Lists</label>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">User_Name</th>
                            <th scope="col">Category_Title</th>
                            <th scope="col">Action</th>
                          </tr>
                    </thead>
                    <tbody>
@if (auth()->user()->role == 'visitor')
                        @forelse ($blogs as $blog)
                        <tr>
                            <td>{{  $loop->index +1 }}</td>
                            <td>
                                <img src="{{ asset('uploads/blogs') }}/{{ $blog->image }}"
                                style="width: 120px; height:100px;">
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->RelationshipWithUSer->name }}</td>
                            <td>{{ $blog->RelationshipWithCategory->title }}</td>
                            <td class="d-flex gap-1">
                                <form action="{{ route('blog.new.delete', $blog->id ) }}" method="POST">
                                    @csrf
                                    <button class="badge bg-danger">delete</button>
                                </form>
                                <form action="{{ route('blog.new.status', $blog->id ) }}" method="POST">
                                    @csrf
                                    @if ($blog->status == 'active')
                                    <button class="badge bg-success">active</button>
                                    @else
                                    <button class="badge bg-danger">deactive</button>
                                    @endif
                                </form>
                                {{-- edit option of blogs --}}
                                <a href="{{ route('blog.edit', $blog->id ) }}" class="badge bg-primary">edit</a>
                            </td>
                          </tr>
                        @empty
                        <tr>
                            <td class="text-danger text-center fw-bold" colspan="6">No Data found❌</td>
                        </tr>
                        @endforelse

                        @else
                        @forelse ($admin_blog as $blog)
                        <tr>
                            <td>{{  $loop->index +1 }}</td>
                            <td>
                                <img src="{{ asset('uploads/blogs') }}/{{ $blog->image }}"
                                style="width: 120px; height:100px;">
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->RelationshipWithUSer->name }}</td>
                            <td>{{ $blog->RelationshipWithCategory->title }}</td>
                            <td class="d-flex gap-1">
                                <form action="{{ route('blog.new.delete', $blog->id ) }}" method="POST">
                                    @csrf
                                    <button class="badge bg-danger">delete</button>
                                </form>
                                <form action="{{ route('blog.new.status', $blog->id ) }}" method="POST">
                                    @csrf
                                    @if ($blog->status == 'active')
                                    <button class="badge bg-success">active</button>
                                    @else
                                    <button class="badge bg-danger">deactive</button>
                                    @endif
                                </form>
                                {{-- edit option of blogs --}}
                                <a href="{{ route('blog.edit', $blog->id ) }}" class="badge bg-primary">edit</a>

                                {{-- feture button --}}

@if (auth()->user()->role == 'admin')
                            @if ($blog->feature == 'active')
                            <a href="{{ route('blog.feature', $blog->id ) }}" class="badge bg-success">feature</a>
                            @else
                            <a href="{{ route('blog.feature', $blog->id ) }}" class="badge bg-danger">feature</a>
                            @endif

@else

@endif

                            </td>
                          </tr>
                        @empty
                        <tr>
                            <td class="text-danger text-center fw-bold" colspan="6">No Data found❌</td>
                        </tr>
                        @endforelse

@endif
                    </tbody>
                  </table>
                  {{-- {{ $blogs->links() }} --}}
            </div>
        </div>
    </div>
</div>

@endsection

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
