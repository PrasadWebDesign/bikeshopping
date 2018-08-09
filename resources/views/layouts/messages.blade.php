@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@if (isset($status))
    <div class="alert alert-success" role="alert">
        {{$status}}
    </div>

@endif
@if (count($errors)>0)

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $element)
                <li><b>{{ $element }}</b></li>
            @endforeach
        </ul>
    </div>
@endif