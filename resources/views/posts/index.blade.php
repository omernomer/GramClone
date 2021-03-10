@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="w-100"/>
            </div>
            <div class="col-4">
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="w-100 rounded-circle"/>
                    </div>
                    <h4 class="col-9"><a href="/profile/{{ $post->user->id }}" class="text-dark">{{ $post->user->username }}</a></h4>
                    <a href="#">Follow</a>
                </div>
                <hr>
                <p>{{ $post->caption }}</p>
            </div>
        </div>
        @endforeach
            <div class="row">
                <div class="col-12  justify-content-center d-flex">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
    </div>

@endsection
