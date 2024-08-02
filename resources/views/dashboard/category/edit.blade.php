@extends('layouts.dashboard_master')

@section('content')+

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1 class="text-warning">Category Edit</h1>
        </div>
    </div>
</div>

{{-- category edit --}}

<div class="row">
    <div class="col-md-6 col-lg">
        <div class="card">
            <div class="card-header">
                <label for="" class="text-warning">Category Edit</label>
            </div>
            <div class="card-body">
                <form action="{{ route('category.edit.update', $category->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $category->title }}">
                </div>
                <div class="mb-3">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
                </div>
                <div class="mb-3">
                <label for="">Description</label>
                <textarea name="description" cols="30" rows="4" class="form-control">{{ $category->description }}</textarea>
                </div>

                <div class="mb-3">
                    <img src="{{ asset('uploads/category') }}/{{ $category->image }}" style="width: 100px; height:100px; border: 1px solid red; border-radius:50%">
                </div>

                <div class="mb-3">
                <label for="">Insert Category Image</label>
                <input type="file" name="image" class="form-control">
                </div>
                <button class="btn btn-warning">update</button>
            </form>
            </div>
        </div>
    </div>
</div>





@endsection
