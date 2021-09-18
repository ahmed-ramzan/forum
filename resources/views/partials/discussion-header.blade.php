<div class="card-header">
    <div class="d-flex justify-content-between">
        <div>
            <img style="width: 40px;height: 40px;border-radius: 50%" src="/storage/{{$discussion->user->image}}" alt="">
            <strong>{{$discussion->user->name}}</strong>
        </div>
        <div>
            <a href="{{route('discussions.show',$discussion->slug)}}" class="btn btn-success">view</a>
        </div>
    </div>
</div>
