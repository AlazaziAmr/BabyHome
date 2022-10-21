@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h6>@lang('site.inspect_result')</h6>
        </div>
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $data['babysitter']->getMainAttachmentAttribute() }}" alt="profile_image"
                             class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $data['nursery']->owner ? $data['nursery']->owner->name : '' }}
                        </h5>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1" style="text-align: center">
                                @lang('site.inspector'): {{ ($result->inspector) ? $result->inspector->name : '' }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1" style="text-align: center">
                                @lang('site.date'): {{ date('Y-m-d',strtotime($result->created_at)) }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="timeline timeline-one-side mt-3" data-timeline-axis-style="dotted">
                @if($result->details)
                    @foreach($result->details as $d)
                        <div class="timeline-block mb-3">
<span class="timeline-step">
<i class="fa fa-bell text-success text-gradient"></i>
</span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $d->criteria }}</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    <i class="fa {{ ($d->rating >= 1) ? 'fa-star' : 'fa-star-o' }} "
                                       aria-hidden="true"></i>
                                    <i class="fa {{ ($d->rating >= 2) ? 'fa-star' : 'fa-star-o' }} "
                                       aria-hidden="true"></i>
                                    <i class="fa {{ ($d->rating >= 3) ? 'fa-star' : 'fa-star-o' }} "
                                       aria-hidden="true"></i>
                                    <i class="fa {{ ($d->rating >= 4) ? 'fa-star' : 'fa-star-o' }} "
                                       aria-hidden="true"></i>
                                    <i class="fa {{ ($d->rating >= 5) ? 'fa-star' : 'fa-star-o' }} "
                                       aria-hidden="true"></i>
                                </p>
                                <p class="text-sm mt-3 mb-2">
                                    {{ $d->comment }}
                                </p>

                                @if($d->matching == "Matched")
                                    <span class="badge badge-sm bg-gradient-success">مطابق للمواصفات</span>
                                @elseif($d->matching == "Partially Matched")
                                    <span class="badge badge-sm bg-gradient-warning">مطابق جزئيا</span>
                                @elseif($d->matching == "Not Matched")
                                    <span class="badge badge-sm bg-gradient-danger">غير مطابق</span>
                                @endif

                                @if($d->recommendation == "Recommended")
                                    <span class="badge badge-sm bg-gradient-success">يوصى به</span>
                                @else
                                    <span class="badge badge-sm bg-gradient-danger">لا يوصى به</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="row">
                @if($result->attachmentable)
                    @foreach($result->attachmentable as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('storage/inspections-results/' . $image->path) }}">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function activaTab(tab) {
            $('.nav-pills a[href="#' + tab + '"]').tab('show');
        };
    </script>
    <script>
        $("#add_new_form").submit(function (e) {
            e.preventDefault();
            btn = $(this).children('btn');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var actionurl = e.currentTarget.action;
            $.ajax({
                type: 'POST',
                url: actionurl,
                data: new FormData(this),
                dataType: 'text',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#value').show();
                },
                complete: function () {
                    $('#value').hide();
                    $('button').removeAttr('disabled');
                },
                success: function (data) {
                    result = jQuery.parseJSON(data);
                    if (result.success == '3') {
                        $('#error_msg').modal(result.msg);
                        $('#error_modal').modal('show');
                    } else if (result.success) {
                        swal("{{ __('site.create') }}", "{{ __('site.added_successfully') }}", "success");
                        location.reload();
                        $('#add_new_form').trigger('reset');
                        $('.form-group').removeClass('has-error');
                        $('.help-block').text('');
                    } else {
                        var errors = result.errors;
                        var html_errors = '<ul>';

                        $('#error').html('');
                        $.each(errors, function (key, val) {
                            key = key.replace('[', '');
                            key = key.replace(']', '');
                            key = key.replace('.', '');
                            $("#" + key + "_error").text(val[0]);
                            $("#" + key + "_div").addClass('has-error');
                            html_errors += "<li>" + val[0] + "<\li>";
                        });
                        html_errors += '</ul>';
                    }
                },
                error: function (data) {

                }
            });
        });
    </script>
@endpush
