@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Whats On Your Mind?</div>

                <div class="panel-body">
                    <form action="post" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-10">
                            <input type="text" name="tweet" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Tweet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tweets</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach ($feed as $post)
                            <li href="#" class="list-group-item">
                                <p class="list-group-item-heading">
                                    <strong>{{ $post->user->name }}</strong>
                                    @ {{ $post->created_at->format('M j, h:iA') }}
                                </p>
                                <p class="list-group-item-text">{{ $post->body }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
