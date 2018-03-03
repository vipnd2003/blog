<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="input-title" class="col-md-4 control-label">{{ trans('Title') }}</label>
    <div class="col-md-6">
        {{ Form::text('title', null, ['id' => 'input-title', 'class' => 'form-control', 'maxlength' => 255, 'placeholder' => trans('Title')]) }}
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="input-content" class="col-md-4 control-label">{{ trans('Content') }}</label>
    <div class="col-md-6">
        {{ Form::textArea('content', null, ['id' => 'input-content', 'class' => 'form-control', 'placeholder' => trans('Content')]) }}
        @if ($errors->has('content'))
            <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
        @endif
    </div>
</div>

@if (Auth::user()->role == \App\Models\User::ROLE_ADMIN)
    <div class="form-group{{ $errors->has('is_public') ? ' has-error' : '' }}">
        <label for="input-public" class="col-md-4 control-label">{{ trans('Public') }}</label>
        <div class="col-md-6">
            {{ Form::select('is_public', [0 => 'Private', 1 => 'Public'], null, ['id' => 'input-public', 'class' => 'form-control']) }}
            @if ($errors->has('is_public'))
                <span class="help-block">
                    <strong>{{ $errors->first('is_public') }}</strong>
                </span>
            @endif
        </div>
    </div>
@endif

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            {{ trans('Submit') }}
        </button>
    </div>
</div>
