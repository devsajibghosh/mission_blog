@extends('layouts.dashboard_master')

@section('content')
<div class="row">
    <div class="col">
        <div class="page-description">
            <h1 class="text-primary">Tags Edit</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md col-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tag.update', $tag->id ) }}" method="POST">
                    @csrf
                 <div class="mb-3">
                    <label for="" class="fw-4 text-primary">Title</label>
                    <input type="text" name="title" class="form-control mt-3" value="{{ $tag->title }}">
                 </div>
                 <button class="btn btn-primary">update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
