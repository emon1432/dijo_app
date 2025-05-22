@extends('layouts.landing.app')

@section('title', 'Blogs')
@section('about', 'active')

@section('content')
<link rel="stylesheet" href="{{asset('/assets/blog/css/main.css')}}" />
<style>
    :root {
        --base-1: #039D55;
        --base-rgb: 255, 255, 255;
        --base-2: #04F485;
        --base-rgb-2:0, 0, 0;
    }
</style>
    <!-- Page Header Gap -->
    <div class="h-148px"></div>
    <!-- Page Header Gap -->
    <section class="py-5">
        <div class="container">
          
            @php
                // dd('test');
            @endphp
            <div class="row">
                <div class="col-md-8 mb-5 mb-md-0">
                    <h4 class="subtitle mb-5">THE LATEST & GREATEST </h4>
                    @if(count($stories) > 0)
                        @foreach ($stories as $story)
                        <div class="post">
                            <div class="img">
                                <a href="{{ route('blog-detail', $story->slug."-".$story->id)}}">
                                <img class="img-fluid w-100" src="{{asset('storage/app/public/admin_feature')}}/{{ $story->image ?? null }}" alt="">
                                </a>
                            </div>
                            <div class="content">
                                <div>
                                    <div class="date mb-1"><small>{{ date("d M Y", $story->time_id) }}</small></div>
    
                                    <h2 class="title mb-3">{{ $story->post_title }}</h2>
                                    <p class="mb-5">{{ $story->meta_description }}</p>
                                    <p class="fs-4"><a href="{{ route('blog-detail', $story->slug."-".$story->id)}}" class="fw-bold text-warning">Continue Reading</a></p>
                                </div>
                              
                            </div>
                        </div>
                        @endforeach
                    @endif
                     
                    {{ $stories->links() }}
                      
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-3">
                        <h4 class="subtitle mb-3 ">RECIPE COLLECTIONS </h4>
                        @if (count($recipies) > 0)
                            <ul class="recipie-collections">
                                @foreach ($recipies as $recipe)
                                    <li><a href="{{ route('blog-detail', $recipe->slug."-".$recipe->id)}}"><span>{{$recipe->post_title}}</span></a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
