@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <span class="h2">{{ $user->name }}</span>, <span>{{ $user->email }}</span>

                    @if ($user->id != Auth::user()->id)
                        <button
                            type="button"
                            id="toggleFollowButton"
                            class="btn btn-primary pull-right"
                            onclick="handleToggleFollow()"
                            data-user-id="{{ Auth::user()->id }}"
                            data-other-user-id="{{ $user->id }}"
                            data-status="{{ $user->followed ? 0 : 1 }}"
                        >
                            @if ($user->followed)
                                Unfollow
                            @else
                                Follow
                            @endif
                        </button>
                    @endif
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
                                    <strong><a href="/{{ $post->user->name }}">{{ $post->user->name }}</a></strong>
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

<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->

<script type="text/javascript">

    function handleToggleFollow()
    {
        const $button = document.getElementById('toggleFollowButton');

        axios.patch('/followers', {
            user_id : $button.getAttribute('data-user-id'),
            other_user_id : $button.getAttribute('data-other-user-id'),
            status: $button.getAttribute('data-status')
        })
        .then(function(res) {
            // location.reload();
            if (res.status == 200) {
                console.log($button.getAttribute('data-status'));

                $button.innerHTML = $button.getAttribute('data-status') == 1 ? 'Unfollow' : 'Follow';

                $button.setAttribute(
                    'data-status',
                    $button.getAttribute('data-status') == 1 ? 0 : 1
                );

            }
        });
    }


</script>
@endsection
