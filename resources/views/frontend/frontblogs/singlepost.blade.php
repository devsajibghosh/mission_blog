@extends('layouts.master')

@section('frontend_content')



    <!--post-single-->
    <section class="post-single">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-lg-12">
                    <!--post-single-image-->
                    <div class="post-single-image text-center">
                        <img  style="width: 800px; height:500px" src="{{ asset('uploads/blogs') }}/{{ $blog->image }}" alt="">
                    </div>

                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">
                            <h2>
                               {{  $blog->title }}
                            </h2>
                            <ul class="entry-meta">
                                <li class="post-author-img">
                                    <img src="{{ asset('uploads/profile') }}/{{$blog->RelationshipWithUSer->image}}" alt=""></li>
                                <li class="post-author"> <a href="author.html">{{$blog->RelationshipWithUSer->name}}</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span
                                            class="line"></span> {{$blog->RelationshipWithCategory->title}}</a></li>
                                <li class="post-date"> <span class="line"></span>{{ \Carbon\Carbon::parse($blog->date)->format('M,d - Y') }}</li>
                            </ul>

                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">
                            <p>
                            {{ $blog->description }}
                            </p>
                        </div>

                        <!--post-single-bottom-->
                        <div class="post-single-bottom">
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">
@foreach ($blog->RelationshipWithTag as $tag)
                                        <li>
                                            <a href="{{ route('tag.blog.post', $tag->id ) }}">{{ $tag->title }}</a>
                                        </li>
@endforeach
                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="author.html" class="image">
                                        <img style="border: 1px solid red; border-radius:50%" src="{{ asset('uploads/profile') }}/{{$blog->RelationshipWithUSer->image}}" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>{{$blog->RelationshipWithUSer->name}}</h4>
                                    <p>
                                        Okay thik ase
                                    </p>
                                    <div class="social-media">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-pinterest"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <!--post-single-comments-->
                        <div class="post-single-comments">
                            <!--Comments-->
                            <h4>Comments Here__</h4>
                            <ul class="comments">
                                <!--comment1-->

@foreach ($comments as $comment)

                                    <li class="comment-item pt-0">
                                <img style="width:50px; height:50px" src="{{ Avatar::create($comment->name)->toBase64() }}" alt="">
                                    <div class="content">
                                        <div class="meta">
                                            <ul class="list-inline">
                                                <li><a href="#">
                                                {{ $comment->name }}
                                                </a> </li>
                                                    <li class="slash"></li>
                                                    <li>
                                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <p>
                                        {{ $comment->message }}
                                            </p>
                                            <a href="#replys-to" onclick="clickS(event)" id="{{ $comment->id }}" class="btn-reply sajib"><i class="las la-reply"></i> Reply</a>
                                        </div>
                                    </li>


                    @foreach ($comment->relationwithreplay as $reply)

                    <li class="comment-item pt-0" style="margin-left: 60px !important;">
                        <img style="width:50px; height:50px" src="{{ Avatar::create($reply->name)->toBase64() }}" alt="">
                            <div class="content">
                                <div class="meta">
                                    <ul class="list-inline">
                                        <li><a href="#">
                                        {{ $reply->name }}
                                        </a> </li>
                                            <li class="slash"></li>
                                            <li>
                                    {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}
                                            </li>
                                        </ul>
                                    </div>
                                    <p>
                                {{ $reply->message }}
                                    </p>
                                    <a href="#replys-to" onclick="clickS(event)" id="{{ $reply->id }}" class="btn-reply sajib"><i class="las la-reply"></i> Reply</a>
                                </div>
                            </li>

        @foreach ($reply->relationwithreplay as  $subreply)
        {{-- subreply --}}

        <li class="comment-item pt-0" style="margin-left: 180px !important;">
            <img style="width:50px; height:50px" src="{{ Avatar::create($subreply->name)->toBase64() }}" alt="">
                <div class="content">
                    <div class="meta">
                        <ul class="list-inline">
                            <li><a href="#">
                            {{ $subreply->name }}
                            </a> </li>
                                <li class="slash"></li>
                                <li>
                        {{ \Carbon\Carbon::parse($subreply->created_at)->diffForHumans() }}
                                </li>
                            </ul>
                        </div>
                        <p>
                    {{ $subreply->message }}
                        </p>
                        {{-- <a href="#replys-to" onclick="clickS(event)" id="{{ $subreply->id }}" class="btn-reply sajib"><i class="las la-reply"></i> Reply</a> --}}
                    </div>
                </li>


        @endforeach



                    @endforeach

@endforeach

                            </ul>


                            <!--Leave-comments-->
                            @auth()

                            <div class="comments-form" >
                                <h4>Leave a Reply</h4>
                                <!--form-->

                                <form id="replys-to" class="form" action="{{ route('root.comment.post') }}" method="POST" id="main_contact_form">
                                    @csrf
                                    <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                    <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Name*" value="{{ auth()->user()->name }}">
                                    <input type="hidden" name="post_id" value="{{ $blog->id }}">
                                    <input type="hidden" name="user_id" value="{{ (auth()->id()) ? auth()->id() : '0' }}">
                                    <input class="ghosh" type="hidden" name="parent_id" value="">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Email*" value="{{ auth()->user()->email }}">
                                            </div>


                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*"
                                                    ></textarea>
                                            </div>
                                        </div>

                                            <button type="submit" name="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!--/-->
                            </div>

                            @else

                            <div class="comments-form" id="replys-to" >
                                <h4>Leave a Reply</h4>
                                <!--form-->

                                <form  class="form" action="{{ route('root.comment.post') }}" method="POST" id="main_contact_form">
                                    @csrf
                                    <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                    <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Name*">
                                    <input type="hidden" name="post_id" value="{{ $blog->id }}">
                                    <input type="hidden" name="user_id" value="{{ (auth()->id()) ? auth()->id() : '0' }}">
                                    <input class="ghosh" type="hidden" name="parent_id" value="">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Email*" >
                                            </div>


                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*"
                                                    ></textarea>
                                            </div>
                                        </div>

                                            <button type="submit" name="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!--/-->
                            </div>

                            @endauth



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('footer_content')

<script>

let sajib = document.querySelector('.sajib');
let input = document.querySelector('.ghosh');


function clickS(event){
    let x = event.target.getAttribute('id');
    input.value = x;
}


</script>

@endsection
