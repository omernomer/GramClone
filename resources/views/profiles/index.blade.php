@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
                <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100 border-2 border-danger"/>
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h1>{{$user->username}}</h1>
                <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @can('update',$user->profile)
                    <a href="/p/create" class="btn btn-info h-25 text-white">Add New Post</a>
                @endcan
            </div>
            @can('update',$user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-3"><b>{{ $user->posts->count() }}</b> Posts</div>
                <div class="pr-3"><b>{{ $user->profile->followers->count() }}</b> followers</div>
                <div class="pr-3"><b>{{ $user->following->count() }}</b> followings</div>
            </div>
            <div class="pt-4">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->image }}" class="w-100"/>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
