@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Home Banner</div>

                <div class="card-body">
                    @include('layouts.messages')


                    <form id="banner_form" method="post" action="{{ url('/banner') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="file" name="file_banner" id="file_banner" class="form-control" required="required" pattern="" title="">

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                        <input name="_method" type="hidden" value="PUT">
                        <input name="banner_id" type="hidden" value="{{$banners}}">
                    </form>

                    <h4>Existing Banner</h4>
                    <img src="{{ asset('/storage/banners/'.$bannerImg) }}" class="img-responsive" width="300px">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
