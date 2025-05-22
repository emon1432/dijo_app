@extends('layouts.admin.app')

@section('title','Blogs Setup')

@push('css_or_js')

@endpush

@section('content')
@php
    // dd($blogs);
@endphp
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <h1 class="page-header-title"><i class="tio-calendar"></i> Blogs <span class="badge badge-soft-dark ml-2" id="itemCount">{{$blogs->total()}}</span></h1>
            </div>

            <div class="col-sm-auto">
                <a class="btn btn--primary" href="{{route('admin.blog.create') }}">
                    <i class="tio-add"></i> Add Post
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
                                "paging":false
                            }'>
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Post Title</th>
                            <th >Slug </th>
                            <th >Created At</th>
                            <th class="text-center">{{translate('messages.action')}}</th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                            @include('admin-views.blog.partials._table',['blogs' => $blogs])
                        </tbody>
                    </table>
                    @if(count($blogs) === 0)
                    <div class="empty--data">
                        <img src="{{asset('/public/assets/admin/img/empty.png')}}" alt="public">
                        <h5>
                            {{translate('no_data_found')}}
                        </h5>
                    </div>
                    @endif
                    <div class="page-area px-4 pb-3">
                        <div class="d-flex align-items-center justify-content-end">
                            <div>
                                {!! $blogs->links() !!}
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
    <script>
        $('#system-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.shift.store')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                $('#addSystemModal').modal('toggle')
;

                },
                success: function (data) {
                    if(data.errors){
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    }
                    else{
                        toastr.success('{{ translate('messages.Shift_added_successfully') }}', {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                                // console.log(data.token);
                                // $('#System_Token').modal('show');
                                // document.getElementById('token').value=data.token;
                                setTimeout(function() {
                                    location.href =
                                        '{{ route('admin.shift.list') }}';
                                },800);
                    }
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function(key,value) {
                        toastr.error(value, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    });
                    },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
    <script>
        $('#system-form-update').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.shift.update')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                    $('#exampleModal').modal('toggle');
                },
                success: function (data) {
                    $('#loading').hide();
                    if(data.errors){
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else{
                    toastr.success('{{ translate('messages.Update_successful') }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            // console.log(data.token);
                            // $('#addSystemModal').modal('toggle');
                            // $('#System_Token').modal('show');
                            // document.getElementById('token').value=data.token;
                            setTimeout(function() {
                                location.href =
                                    '{{ route('admin.shift.list') }}';
                            }, 800);
                        }
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function(key,value) {
                        toastr.error(value, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    });
                    },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
        <script>
            $('#reset_btn').click(function(){
                $('#name').val(null);
                $('#start_time').val(null);
                $('#end_time').val(null);
            })

            function edit_shift(){
            $(".add_active").addClass('active');
            $(".lang_form").addClass('d-none');
            $(".add_active_2").removeClass('d-none');
        }

    $(".lang_link").click(function(e){
        e.preventDefault();
        $(".lang_link").removeClass('active');
        $(".lang_form").addClass('d-none');
        $(".add_active").removeClass('active');
        $(this).addClass('active');

        let form_id = this.id;
        let lang = form_id.substring(0, form_id.length - 5);

        console.log(lang);

        // $("#"+lang+"-form").removeClass('d-none');

        @foreach ($blogs as $cu )
        $("#"+lang+"-form_{{ $cu->id }}").removeClass('d-none');
        @endforeach
        if(lang == 'default')
        {
            $(".from_part_2").removeClass('d-none');
        }
        if(lang == 'default')
        {
            $(".default-form").removeClass('d-none');
        }
        else
        {
            $(".from_part_2").addClass('d-none');
        }
    });

    $(".lang_link1").click(function(e){
        e.preventDefault();
        $(".lang_link1").removeClass('active');
        $(".lang_form1").addClass('d-none');
        $(this).addClass('active');
        let form_id = this.id;
        let lang = form_id.substring(0, form_id.length - 6);
        $("#"+lang+"-form1").removeClass('d-none');
            if(lang == 'default')
        {
            $(".default-form1").removeClass('d-none');
        }
    })

        </script>
@endpush

