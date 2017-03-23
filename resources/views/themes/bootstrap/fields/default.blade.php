<div id="field_{{ $id }}"  class="form-group" {!! Html::classes(['form-group', 'has-error' => $hasErrors]) !!}>
    <label for="{{ $id }}" class="col-md-4 control-label">
        {{ $label }}
    </label>

    @if ($required)
        <span class="label label-info">Required</span>
    @endif

    <div class="col-md-6 controls">
        {!! $input !!}
        @foreach ($errors as $error)
            <p class="help-block">{{ $error }}</p>
        @endforeach
    </div>
</div>