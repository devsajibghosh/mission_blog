@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h3 class="text-warning">Blog Create</h3>
        </div>
    </div>
</div>

@if (auth()->user()->role == 'admin' || auth()->user()->role == 'author' )
@if (auth()->user()->block_status == 0 )
        <div class="row">
            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-warning">Create Blog Post</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('blog.new.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category Names</label>
                                <select name="category_id" class="form-control">
                                    <option>Select One Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-control">Tags</label>
                                @foreach ( $tags as $tag)
                                <br>
                                <input type="checkbox" id="tag_check{{ $tag->id }}" name="tag_id[]" value="{{ $tag->id }}">
                                <label for="tag_check{{ $tag->id }}" class="form-label">{{ $tag->title }}</label>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="6" id="summernote"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endif
@endif

@endsection



