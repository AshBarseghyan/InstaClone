@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('p.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row  ">
                <div class="col-8 offset-2">
                    <div class="row"><h1> Add New Post</h1></div>

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label ">Post Caption </label>
                        <input id="caption"
                               type="text"
                               class="form-control
                        @error('email') is-invalid @enderror"
                               name="caption"
                               value="{{ old('caption') }}"
                               autocomplete="caption">

                        @error('caption')
                        <span class="alert-warning mt-3">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>


                    <div class="row mb-4">
                        <label for="image" class="col-md-4 col-form-label ">Post Image</label>

                        <input type="file" class="form-control-file" id="image" name="image">
                        @error('image')
                        <span class="alert-warning mt-3" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="row"><input type="submit" class="btn btn-outline-dark " value="Add"></div>


                </div>
            </div>


        </form>
    </div>
@endsection
