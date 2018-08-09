@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update About us content</div>

                <div class="card-body">
                    {{-- for errors and messages --}}
                    @include('layouts.messages')


                    <form id="about_form" method="post" action="{{ route('about.update') }}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea name="content" id="editor" class="form-control" rows="20" required="required">{!! $about_content !!}</textarea>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                        <input name="_method" type="hidden" value="PUT">
                        <input name="about_id" type="hidden" value="1">
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'editor' );
    </script>
@endsection
