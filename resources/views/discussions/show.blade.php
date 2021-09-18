@extends('layouts.app')

@section('content')
        <div class="justify-content-center">
            <div class="card">
                @include('partials.discussion-header')
                <div class="card-body">
                    <div class="text-center">
                        <strong>{{$discussion->title}}</strong>
                    </div>
                    <hr>
                    {!! $discussion->content !!}
                    @if($discussion->bestReply)
                        <div class="card bg-success text-white my-2">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div>Best Reply</div>
                                    <div>
                                        {{$discussion->bestReply->user->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! $discussion->bestReply->content !!}
                            </div>
                        </div>
                        @endif
                </div>
            </div>

            @foreach($discussion->replies()->paginate(3) as $reply)
                <div class="card my-2">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <img style="width: 40px;height: 40px;border-radius: 50%" src="/storage/{{$reply->user->image}}" alt="">
                                <strong>{{$reply->user->name}}</strong>
                            </div>
                            <div>
                                @if(Auth::id() === $discussion->user_id)
                                    <form action="{{route('discussions.best-reply',['discussion'=>$discussion->slug,'reply'=>$reply->id])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Mark as best reply</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $reply->content !!}
                    </div>
                </div>
            @endforeach

            <div>
                {{$discussion->replies()->paginate(3)->links()}}
            </div>

            <div class="card my-4">
                <div class="card-header">
                    Add reply
                </div>
                <div class="card-body">
                    @auth
                    <form action="{{route('replies.store',$discussion->slug)}}" method="post">
                        @csrf
                        <input id="content" type="hidden" name="content">
                        <trix-editor input="content"></trix-editor>
                        <button type="submit" class="btn btn-success my-4">Add reply</button>
                    </form>
                    @else
                        <a href="{{route('login')}}" class="btn btn-info my-2 text-white w-100">Sign in</a>
                    @endauth
                </div>
            </div>

@endsection

            @section('css')
                <link rel="stylesheet" href="/css/trix.css">
            @endsection
            @section('scripts')
                <script src="/js/trix.js"></script>
        @endsection
