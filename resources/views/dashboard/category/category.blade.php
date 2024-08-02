@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1 class="text-primary">Category</h1>
        </div>
    </div>
</div>

{{-- category --}}


<div class="row">
    <div class="col-md-6 col-lg-7">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($categories as $category )
                    <tr>
                        <td>{{  $categories->firstItem() + $loop->index}}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="d-flex gap-1">
                        <form action="{{ route('category.delete', $category->id) }}" method="POST">
                            @csrf
                            <button class="badge bg-danger">delete</button>
                        </form>
                        <button type="submit" class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $category->id }}">
                            Inventory
                           </button>
                           <form action="{{ route('category.status', $category->id ) }}" method="POST">
                            @csrf
                            @if ($category->status == 'active')
                            <button type="submit" class="badge bg-success">active</button>
                            @else
                            <button type="submit" class="badge bg-danger">deactive</button>
                            @endif
                        </form>
                           <a href="{{ route('category.edit', $category->slug ) }}" class="badge bg-primary">edit</a>
                        </td>
                      </tr>
                      {{-- modal --}}
                      <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ID: {{ $category->id }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card bg-primary">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <img src="{{ asset('uploads/category') }}/{{ $category->image }}" style="width: 150px; height:150px;">
                                        </div>
                                        <div class="mb-3">
                                        <b class="text-dark fs-5">Title: {{ $category->title}}</b>
                                        </div>
                                        <div class="mb-3">
                                        <p>Slug: {{ $category->slug}}</p>
                                        </div>
                                        <div class="mb-3">
                                        <p>Description: {{ $category->description}}</p>
                                        </div>
                                        <div class="mb-3">
                                        <p>Status: {{ $category->status}}</p>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                    @empty
                    <tr>
                        <td class="text-danger text-center fw-bold" colspan="4">
                            No Data Found
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                  </table>
                  {{ $categories->links() }}
            </div>
        </div>
    </div>

    {{-- insert category --}}

    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header">
                <label for="">Category Insert</label>
            </div>
            <div class="card-body">
                <form action="{{ route('category.insert') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control">
                </div>
                <div class="mb-3">
                <label for="">Description</label>
                <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                <label for="">Insert Category Image</label>
                <input type="file" name="image" class="form-control">
                </div>
                <button class="btn btn-primary">insert</button>
            </form>
            </div>
        </div>
    </div>
</div>


@endsection



{{-- sweet alret section --}}


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
