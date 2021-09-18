@extends('layouts.app')

@section('content')
    @forelse($discussions as $discussion)
        <div class="justify-content-center">
            <div class="card">
                @include('partials.discussion-header')
                <div class="card-body">
                    <div class="text-center">
                        <strong>{{$discussion->title}}</strong>
                    </div>
                </div>
            </div>
            @empty
                <h2>No discussion yet!</h2>
            @endforelse
            <div class="text-center my-4">{{$discussions->links()}}</div>
@endsection
