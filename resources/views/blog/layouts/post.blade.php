@extends('blog.layouts.master', [
  'title' => $post->title,
  'meta_description' => $post->meta_description ?? config('blog.description'),
])

@section('page-header')
    <header class="masthead" style="background-image:url('{{asset('/img/post-bg.jpg')}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">{{ $post->subtitle }}</h2>
                        <span class="meta">
                            Posted on {{ $post->published_at }}
                            @if ($post->tags->count())
                                in
                                {!! join(', ', $post->tagLinks()) !!}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('content')

                {{-- 文章详情 --}}
                <article >
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>

                </article>

                <hr>

                {{-- 上一篇、下一篇导航 --}}
                <div class="clearfix">
                     Reverse direction
                            <a class="btn btn-primary float-left" href="">
                                ←
                                Previous laravel Post
                            </a>
                            <a class="btn btn-primary float-right" href="">
                                Next php Post
                                →
                            </a>
                </div>

@stop