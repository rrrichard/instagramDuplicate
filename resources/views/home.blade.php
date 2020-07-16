@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="../svg/playstation.png" alt="psnlogo"
                style="max-height: 100px;"
                class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div>
                <h1>
                    {{ $user->username }}
                </h1>
            </div>
            <div class="d-flex">
                <div class="pr-5">
                    <strong>153</strong> posts
                </div>
                <div class="pr-5">
                    <strong>23k</strong> followers
                </div>
                <div class="pr-5">
                    <strong>212</strong> following
                </div>
            </div>
            <div class="pt-4 font-weight-bold">
                {{ $user->profile->title }}
            </div>
            <div class="">
                {{ $user->profile->description }}
            </div>
            <div class="font-weight-bold">
                <a href="{{ $user->profile->url }}">
                    {{ $user->profile->url }}
                </a>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-4">
            <img src="../svg/lastofus.png" alt="lastofus"
                class="w-100">
        </div>
        <div class="col-4">
            <img src="../svg/deals.png" alt="hotdeals"
                class="w-100">
        </div>
        <div class="col-4">
            <img src="../svg/cyberpunk.png" alt="cyberpunk"
                class="w-100">
        </div>
    </div>
</div>
@endsection
