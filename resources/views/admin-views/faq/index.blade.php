@extends('layouts.admin.app')

@section('title', 'FAQs Setup')

@push('css_or_js')
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-help-outlined"></i> FAQs 
                    <span class="badge badge-soft-dark ml-2" id="itemCount">{{ $faqs->total() }}</span>
                </h1>
            </div>

            <div class="col-sm-auto">
                <a class="btn btn--primary" href="{{ route('admin.faq.create') }}">
                    <i class="tio-add"></i> Add FAQ
                </a>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row gx-2 gx-lg-3">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <!-- Card -->
            <div class="card">
                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="columnSearchDatatable"
                           class="font-size-sm table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                           data-hs-datatables-options='{
                               "order": [],
                               "orderCellsTop": true,
                               "paging": false
                           }'>
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-center">{{ translate('messages.action') }}</th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                            @include('admin-views.faq.partials._table', ['faqs' => $faqs])
                        </tbody>
                    </table>

                    @if(count($faqs) === 0)
                    <div class="empty--data">
                        <img src="{{ asset('/public/assets/admin/img/empty.png') }}" alt="public">
                        <h5>{{ translate('no_data_found') }}</h5>
                    </div>
                    @endif

                    <div class="page-area px-4 pb-3">
                        <div class="d-flex align-items-center justify-content-end">
                            <div>
                                {!! $faqs->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>
@endsection

@push('script')
<!-- You can remove or add scripts as needed -->
@endpush
