@extends('layouts.admin.app')

@section('title', 'Blogs')

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/admin/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <style>
        .d-none{
            display: none;
        }
        .--f-left{
            float: left;
        }
    </style>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <!-- Page Header -->
                <h1 class="page-header-title text-capitalize">
                    <!--<div class="card-header-icon d-inline-flex mr-2 img">-->
                    <!--    <img src="{{ asset('/public/assets/admin/img/landing-page.png') }}" class="mw-26px" alt="public">-->
                    <!--</div>-->
                    <span>
                        {{ translate('Blogs') }}
                    </span>
                </h1>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="lang_form default-form">

                        <div class="row g-4" >
                            <div class="col-sm-6">
                                <label class="form-label">Post Title
                                    <span class="input-label-secondary text--title"  data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                                <input type="text"  maxlength="200"  name="post_title" value="" class="form-control post_title" placeholder="Enter Title">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Post Slug
                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                                <input type="text" maxlength="200"  name="post_slug" value="" class="form-control post_slug" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="row g-4" >
                            <div class="col-sm-6">
                                <label class="form-label">Post Type
                                    <span class="input-label-secondary text--title"  data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="Story">Story</option>
                                    <option value="Recipe">Recipe</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Meta Title
                                    <span class="input-label-secondary text--title"  data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                                <input type="text"  maxlength="200"  name="meta_title" value="" class="form-control" placeholder="Enter Title">
                            </div>
                        </div>
                        <div class="row g-4" >
                            <div class="col-sm-6">
                                <label class="form-label">Meta Tags
                                    <span class="input-label-secondary text--title"  data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                                <input type="text"  maxlength="200"  name="meta_tags" value="" class="form-control" placeholder="Enter Title">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Meta Description
                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                                <textarea name="meta_description" value="" class="form-control" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="row g-4" >
                            <div class="col-sm-12">
                                <label class="form-label">Post Content
                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                                <div class="form-group lang_form" id="default-form">
                                    <textarea class="ckeditor form-control" name="content"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 recipe-ingrediant d-none">
                            <div class="col-sm-12">
                                <label class="form-label">Recipe Ingredients
                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title=""></span>
                                </label>
                            </div>
                            <div class="col-sm-12 ingrdiant">
                                <div class="col-sm-4 --f-left">
                                    <div class="form-group lang_form" id="default-form">
                                        <input class="form-control" name="ingrediant_name[]" type="text" value="" placeholder="Type Ingrediant">
                                    </div>
                                </div>
                                <div class="col-sm-4 --f-left">
                                    <div class="form-group lang_form" id="default-form">
                                        <input class="form-control" name="ingrediant_qty[]" type="text" placeholder="Type Quantity" value="">
                                    </div>
                                </div>
                                <div class="col-sm-1 --f-left">
                                    <button class="btn btn-sm btn--primary --add">Add</button>
                                </div>
                                <div class="col-sm-1 --f-left">
                                    <button class="btn btn-sm btn--reset --remove">Remove</button>
                                </div>
                            </div>
                            
                        </div>
                        <div>
                            <label class="form-label d-block mb-2">
                                Top Image
                            </label>
                                <div class="position-relative">
                                    <label class="upload-img-3 m-0 d-block">
                                            <div class="img">
                                                <img src="{{asset('public/assets/admin/img/add-new.png')}}/{{ $image_content['header_content_image'] ?? null }}" alt="" class="vertical-img max-w-187px">
                                            </div>
                                        <input type="file" name="post_image" hidden="">
                                    </label>
                                    @if (isset($image_content['header_content_image'] ))
                                    <span id="header_content_image" class="remove_image_button"
                                        onclick="toogleStatusModal(event,'header_content_image','mail-success','mail-warninh','{{translate('Important!')}}','{{translate('Warning!')}}',`<p>{{translate('Are_you_sure_you_want_to_remove_this_image')}}</p>`,`<p>{{translate('Are_you_sure_you_want_to_remove_this_image.')}}</p>`)"
                                        > <i class="tio-clear"></i></span>
                                    @endif
                                </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset">{{translate('Reset')}}</button>
                        <button type="submit" onclick="" class="btn btn--primary mb-2">{{translate('Save')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
    </div>
        <!-- Header -->
@endsection

@push('script_2')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
    console.log('1');
    $(document).on("change", "#type", function(){
        let type    = $(this).val();
        console.log("type",type);
        if(type == "Recipe"){
            $(".recipe-ingrediant").removeClass("d-none");
        }else{
            $(".ingrediant").val('');
            $(".recipe-ingrediant").addClass("d-none");
        }
    });
    $(document).on("keyup, change", ".post_title", function(){
        let titile      = $(this).val();
        let slug        = "";
        slug            =  titile.toLowerCase()
                            .replace(/ /g, "-")
                            .replace(/[^\w-]+/g, "");
        $('.post_slug').val(slug);
    });
    $(document).on('click', '.--add', function(event) {
        var parent_selector                 = '.recipe-ingrediant';
        var print_location_template         = $(this).closest(parent_selector).find(".ingrdiant").first().clone();
        var print_location_parent           = $(this).closest(parent_selector);
        var new_print_location_template     = print_location_template.clone();
        event.preventDefault();
        print_location_parent.append(new_print_location_template);
        new_print_location_template.find('input').val(null);
    });
    $(document).on('click', '.--remove', function(e) {
        let count                           = $('.recipe-ingrediant').find('.ingrdiant').length;
        console.log(count);
        e.preventDefault();
        if(count > 1){
            $(this).closest('.ingrdiant').remove();
        }
    });
</script>

@endpush
