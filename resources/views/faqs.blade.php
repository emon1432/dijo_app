@extends('layouts.landing.app')

@section('title', 'FAQs')
@section('about', 'active')

@section('content')
<link rel="stylesheet" href="{{asset('/assets/blog/css/main.css')}}" />
<style>
    :root {
        --base-1: #039D55;
        --base-rgb: 255, 255, 255;
        --base-2: #04F485;
        --base-rgb-2: 0, 0, 0;
    }
    .accordion-button {
        font-weight: 600;
    }
    .accordion-body {
        white-space: pre-line;
    }
</style>

<!-- Page Header Gap -->
<div class="h-148px"></div>
<!-- Page Header Gap -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- FAQ Section -->
            <div class="col-md-12 mb-5 mb-md-0">
                <h4 class="subtitle mb-5">FREQUENTLY ASKED QUESTIONS</h4>

                @if(count($faqs) > 0)
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $index }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                            aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p>No FAQs available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
