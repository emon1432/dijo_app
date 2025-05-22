@extends('layouts.admin.app')

@section('title', 'Edit FAQ')

@push('css_or_js')
    <link href="{{ asset('public/assets/admin/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
<style>
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
                <span>{{ translate('Edit FAQ') }}</span>
            </h1>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="card">
        <form action="{{ route('admin.faq.update', $faq->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <label class="form-label">Question
                            <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="Enter the FAQ question"></span>
                        </label>
                        <input type="text" maxlength="500" name="question" class="form-control"
                               placeholder="Enter Question"
                               value="{{ old('question', $faq->question) }}" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="form-label">Answer
                            <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="Enter the FAQ answer"></span>
                        </label>
                        <textarea name="answer" class="form-control" rows="2"
                                  placeholder="Enter Answer" required>{{ old('answer', $faq->answer) }}</textarea>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="Y" {{ $faq->is_active == 'Y' ? 'selected' : '' }}>Active</option>
                        <option value="N" {{ $faq->is_active == 'N' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="btn--container justify-content-end mt-3">
                    <button type="reset" class="btn btn--reset">{{ translate('Reset') }}</button>
                    <button type="submit" class="btn btn--primary mb-2">{{ translate('Update') }}</button>
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
</script>
@endpush
