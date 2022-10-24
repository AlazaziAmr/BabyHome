<div class="row mt-2">
{{--    <div class="col-md-6">--}}
{{--        <div class="form-group">--}}
{{--            <label for="general_{{ $c }}_input" class="form-control-label">--}}
{{--                @lang('site.general_rate')--}}
{{--            </label>--}}
{{--            <input required name="general_{{ $c }}" id="general_{{ $c }}_input" class="form-control" type="number">--}}
{{--            <span class="has-error" id="general_{{ $c }}_error"></span>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="col-md-6">--}}
{{--        <div class="form-group">--}}
{{--            <label for="recommend_{{ $c }}_input" class="form-control-label">--}}
{{--                @lang('site.recommend')--}}
{{--            </label>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <input type="radio" name="recommend_{{ $c }}" value="1"> @lang('site.recommend_one')--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <input type="radio" name="recommend_{{ $c }}" value="2"> @lang('site.recommend_two')--}}
{{--                </div>--}}
{{--                <span class="has-error" id="recommend_{{ $c }}_error"></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="col-md-6">
        <div class="form-group">
            <label for="match_{{ $c }}_input" class="form-control-label">
                @lang('site.match')
            </label>
            <div class="row">
                <div class="col-md-4">
                    <input type="radio" name="match_{{ $c }}" value="1"> @lang('site.match_one')
                </div>
                <div class="col-md-4">
                    <input type="radio" name="match_{{ $c }}" value="2">@lang('site.match_two')
                </div>
                <div class="col-md-4">
                    <input type="radio" name="match_{{ $c }}" value="3">@lang('site.match_three')
                </div>
            </div>
            <span class="has-error" id="match_{{ $c }}_error"></span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="comment_{{ $c }}_input" class="form-control-label">
                @lang('site.comment')
            </label>
            <textarea id="comment_{{ $c }}_input" class="form-control" name="comment_{{ $c }}"></textarea>
            <span class="has-error" id="comment_{{ $c }}_error"></span>
        </div>
    </div>

    @if(isset($submit) and $submit)
        <div class="col-md-12">
            <div class="form-group">
                <label for="attachments_input" class="form-control-label">
                    @lang('site.attachments')
                </label>
                <input id="attachments_input" type="file" name="attachments[]">
            </div>
        </div>
    @endif

    <div class="col-md-6">
        @if(isset($prev) and $prev)
            <a class="nav-link btn btn-sm btn-success"
               onclick="activaTab('{{ $prev }}')">
                @lang('site.prev')
            </a>
        @endif
    </div>

    <div class="col-md-6">
        @if(isset($next) and $next)
            <a class="nav-link btn btn-sm btn-success"
               onclick="activaTab('{{ $next }}')">
                @lang('site.next')
            </a>
        @elseif(isset($submit) and $submit)
            <button type="submit" class="nav-link btn btn-sm btn-primary">
                @lang('site.submit')
            </button>
        @endif
    </div>

</div>
