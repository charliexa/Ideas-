@extends('layouts.layout')

@section("content")
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
                <div class="mt-3">
                    @include('shared.user-card')
                </div>
                <hr>
                @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('shared.idea-card')
                </div>
                @empty
                    <h1 class="text-center">
                        No Results Found!
                    </h1>
                @endforelse
                {{ $ideas->withQueryString()->links() }}
        </div>
        <div class="col-3">
            @include('shared.search')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
