@extends('layouts.app')

@section('content')
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                <form action="{{route('profile.update',Auth::id())}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <label>Profile</label>
                    <input class="form-control" type="file" name="image">
                   @if(isset($user->image))
                        <p><img class="w-25" src="/storage/{{$user->image}}" alt=""></p>
                    @else
                        <p><img class="w-25" src="/storage/profiles/{{'noimage.gif'}}" alt=""></p>
                    @endif
                    @error('image')<p class="text-danger">{{$message}}</p>@enderror
                    <button type="submit" class="btn btn-success mt-4">Update profile</button>
                </form>
            </div>
        </div>
@endsection
