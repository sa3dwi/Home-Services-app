@if($errors->has($input))
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        {!!$errors->first($input)!!}
    </div>
@endif