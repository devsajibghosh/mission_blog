@extends('layouts.master')

@section('frontend_content')


 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{ $tag_name->title }}</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">

@forelse ($blog as $blog_item)
                     <div class="post-list post-list-style2">
                         <div class="post-list-image">
                             <a href="post-single.html">
                                 <img src="{{ asset('uploads/blogs') }}/{{ $blog_item->image }}" alt="blog_image">
                             </a>
                         </div>
                         <div class="post-list-content">
                             <h3 class="entry-title">
                                 <a href="post-single.html">{{ $blog_item->title }}</a>
                             </h3>
                             <ul class="entry-meta">
                                 <li class="post-author-img"><img src="{{ Avatar::create($blog_item->RelationshipWithUSer->name)->toBase64() }}" alt=""></li>
                                 <li class="post-author"> <a href="author.html">{{ $blog_item->RelationshipWithUSer->name }}</a></li>
                                 <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span>{{ $blog_item->RelationshipWithCategory->title }}</a></li>
                                 <li class="post-date"> <span class="line"></span> {{ \Carbon\Carbon::parse($blog_item->date)->diffForHumans() }}</li>
                             </ul>
                             <div class="post-exerpt">
                                 <p>
                                    <?php
                                    $blog_des = strip_tags($blog_item->description);
                                    $blog_id = $blog_item->id;
                                    if(strlen($blog_des > 250)):
                                        $blog_cut = substr($blog_des,0,250);
                                        $endpoint = strrpos($blog_cut, " ");
                                        $blog_des = $endpoint?substr($blog_cut,0,$endpoint):substr($blog_cut,0);
                                        $blog_des .=" |";
                                    endif;
                                    echo $blog_des;
                                ?>
                                 </p>
                             </div>
                             <div class="post-btn">
                                 <a href="{{ route('single.blog.post', $blog_item->id ) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                             </div>
                         </div>
                     </div>

                     @empty

                     <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                <img src="{{ Avatar::create('No Image')->toBase64() }}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="post-single.html" class="text-danger">
                                    NO TITLE
                                </a>
                            </h3>
                            <ul class="entry-meta">
                                <li class="post-author-img">
                                    <img src="{{ Avatar::create('No Image')->toBase64() }}" alt="">
                                </li>
                                <li class="post-author"> <a href="author.html">No Name</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span>no found data</a></li>
                                <li class="post-date"> <span class="line"></span>date not found</li>
                            </ul>
                            <div class="post-exerpt">
                                <p>not found description</p>
                            </div>
                            <div class="post-btn">
                                <a href="post-single.html" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>

@endforelse

         </div>
     </div>
</div>
</section>


@endsection
