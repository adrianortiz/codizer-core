@if (count($errors) > 0)
    <div class="alert alert-danger">
        <div class="alert-title-danger">
            @lang('auth.errors_title')
            <button type="button" class="close close-alert-codizer" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
        </div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif