@extends('layouts.app')

@section('content')
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Add discussion</div>

            <div class="card-body">
                <form action="{{route('discussions.store')}}" method="post">
                    @csrf
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title">
                    @error('title')<p class="text-danger">{{$message}}</p>@enderror

                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
                    @error('content')<p class="text-danger">{{$message}}</p>@enderror

                    <label for="channel">channel</label>
                    <select name="channel" id="" class="form-control">
                        <option value="">Choose channel</option>
                        @forelse($channels as $channel)
                            <option value="{{$channel->id}}">{{$channel->name}}</option>
                        @empty
                            <option value="">No channel found</option>
                        @endforelse
                    </select>
                    @error('channel')<p class="text-danger">{{$message}}</p>@enderror
                    <button type="submit" class="btn btn-success my-4">Create discussion</button>
                </form>
            </div>
        </div>
@endsection

@section('css')
            <link rel="stylesheet" href="/css/trix.css">
@endsection
@section('scripts')
            <script src="/js/trix.js"></script>
@endsection
