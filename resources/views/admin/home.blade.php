@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home Page</div>

                {{-- <div class="card-body">
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
                    @if (isset($errors))
    
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $element)
                                    <li>{{ $element }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form id="banner_form" method="post" action="{{ url('/banner') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="file" name="file_banner" id="file_banner" class="form-control" required="required" pattern="" title="">

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
