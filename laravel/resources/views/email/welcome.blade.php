<h2>Welcome {{$user->username}}</h2>
<div>
    <h2>You created {{$post->title}}</h2>
    <p>{{$post->body}}</p>
    <img width="300" src="{{message->embed('storage/'.$post->image_path)}}" alt="">
</div>