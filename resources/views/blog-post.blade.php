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
    tbody, td, tfoot, th, thead, tr {
        border-color: #e3e1e1;
        border-style: solid;
        border-width: 1px !important;
    }
</style>
    <!-- Page Header Gap -->
    <div class="h-148px"></div>
    <!-- Page Header Gap -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-5 mb-md-0">
                    <h2 class="title mb-3">{{ $blog->post_title }}</h2>
                    <div class="img">
                        <img class="img-fluid w-100" src="{{asset('storage/app/public/admin_feature')}}/{{ $blog->image ?? null }}" alt="">
                    </div>   
                    <div class="mb-5">
                        <div class="content" style="padding: 0px !important;margin: 40px 0px;">
                            <div class="date mb-1">Post Date - <small>{{ date("d M Y", $blog->time_id) }}</small></div>
                            <div class="post-content">
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>
                    @if($blog->type == "Recipe")
                        <div class="mb-5">
                            <h4 class="title mb-3">Recipe Ingredients</h4>
                            <div class="content" style="padding: 0px !important;margin: 40px 0px;">
                                <div class="post-content">
                                    @if (count($blog->RecipeIngredient) > 0)
                                    <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th scope="col" style="font-size: 16px;">Ingredient</th>
                                            <th scope="col" style="font-size: 16px;">Quantity</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blog->RecipeIngredient as $Ingredient)
                                            
                                                <tr>
                                                    <td>{{$Ingredient->ingredient}}</td>
                                                    <td>{{$Ingredient->quantity}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                        
                                            
                                        
                                        
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    @endif
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
