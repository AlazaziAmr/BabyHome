<div class="row mt-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="general_{{ $c }}_input" class="form-control-label">
                التقييم العام
            </label>
            <input required name="general_{{ $c }}" id="general_{{ $c }}_input" class="form-control" type="number">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="recommend_{{ $c }}_input" class="form-control-label">
                التوصية
            </label>
            <div class="row">
                <div class="col-md-6">
                    <input type="radio" name="recommend_{{ $c }}" value="1"> يوصى به
                </div>
                <div class="col-md-6">
                    <input type="radio" name="recommend_{{ $c }}" value="2">لا يوصى به
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="match_{{ $c }}_input" class="form-control-label">
                المطابقة
            </label>
            <div class="row">
                <div class="col-md-4">
                    <input type="radio" name="match_{{ $c }}" value="1"> مطابق للمواصفات
                </div>
                <div class="col-md-4">
                    <input type="radio" name="match_{{ $c }}" value="2">مطابق جزئياً
                </div>
                <div class="col-md-4">
                    <input type="radio" name="match_{{ $c }}" value="3">غير مطابق
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="comment_{{ $c }}_input" class="form-control-label">
                التعليق
            </label>
            <textarea id="comment_{{ $c }}_input" class="form-control" name="comment_{{ $c }}"></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="image_{{ $c }}_input" class="form-control-label">
                المرفقات
            </label>
            <input id="image_{{ $c }}_input" type="file" name="image_{{ $c }}[]">
        </div>
    </div>
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
            <button class="nav-link btn btn-sm btn-primary">
                @lang('site.submit')
            </button>
        @endif
    </div>

</div>
