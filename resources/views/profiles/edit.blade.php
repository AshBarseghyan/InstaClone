@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post" >
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row"> <h1> Edit Profile</h1></div>

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label ">Title </label>
                        <input id="title"
                               type="text"
                               class="form-control

                        @error('email') is-invalid @enderror"
                               name="title"
                               value="{{ old('title') ?? $user->profile->title }}"
                               autocomplete="title">

                        @error('title')
                        <span class="alert-warning mt-3">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label ">Description </label>
                        <input id="description"
                               type="text"
                               class="form-control
                        @error('email') is-invalid @enderror"
                               name="description"
                               value="{{ old('description') ?? $user->profile->description }}"
                               autocomplete="description">

                        @error('description')
                        <span class="alert-warning mt-3">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label ">URL</label>
                        <input id="url"
                               type="text"
                               class="form-control
                        @error('email') is-invalid @enderror"
                               name="url"
                               value="{{ old('url') ?? $user->profile->url }}"
                               autocomplete="url">

                        @error('url')
                        <span class="alert-warning mt-3">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>


                    <div class="row mb-4">
                        <label for="image" class="col-md-4 col-form-label ">Post Image</label>

                        <input type="file" class="form-control-file" id="image" name="image" >
                        @error('image')
                        <span class="alert-warning mt-3">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="row"> <input type="submit" class="btn btn-outline-danger " value="Save Changes"> </div>


                </div>
            </div>






        </form>
    </div>
@endsection
