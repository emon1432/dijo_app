@extends('layouts.admin.app')

@section('title', 'FAQs')

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/admin/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <style>
        .d-none {
            display: none;
        }
        .--f-left {
            float: left;
        }
    </style>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <h1 class="page-header-title text-capitalize">
                    <!--<div class="card-header-icon d-inline-flex mr-2 img">-->
                    <!--    <img src="{{ asset('/public/assets/admin/img/faq.png') }}" class="mw-26px" alt="FAQ">-->
                    <!--</div>-->
                    <span>
                        {{ translate('FAQs') }}
                    </span>
                </h1>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card">
            <form action="{{ route('admin.faq.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="faq_form default-form">

                        <div class="row g-4 faq-entry">
                            <div class="col-sm-6">
                                <label class="form-label">Question
                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="Enter the FAQ question"></span>
                                </label>
                                <input type="text" maxlength="500" name="question[]" class="form-control" placeholder="Enter Question" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Answer
                                    <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="Enter the FAQ answer"></span>
                                </label>
                                <textarea name="answer[]" class="form-control" rows="2" placeholder="Enter Answer" required></textarea>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <button class="btn btn-sm btn--primary --add">Add</button>
                                <button class="btn btn-sm btn--reset --remove">Remove</button>
                            </div>
                        </div>

                    </div>

                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset">{{ translate('Reset') }}</button>
                        <button type="submit" class="btn btn--primary mb-2">{{ translate('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
    </div>
@endsection

@push('script_2')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Add new FAQ entry
    $(document).on('click', '.--add', function(event) {
        event.preventDefault();
        var parentSelector = '.faq_form';
        var container = $(this).closest(parentSelector);
        var firstEntry = container.find('.faq-entry').first();
        var newEntry = firstEntry.clone();

        // Clear input fields in the cloned entry
        newEntry.find('input, textarea').val('');
        container.append(newEntry);
    });

    // Remove FAQ entry
    $(document).on('click', '.--remove', function(event) {
        event.preventDefault();
        var container = $('.faq_form');
        var count = container.find('.faq-entry').length;

        if(count > 1){
            $(this).closest('.faq-entry').remove();
        }
    });
</script>
@endpush
