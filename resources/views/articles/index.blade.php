@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Results <small>({{ $results->count() }})</small>
            </div>
            <div class="card-body">
                <form method="get">
                    <div class="form-group">
                        <input
                            type="text"
                            name="q"
                            class="form-control"
                            placeholder="Search..."
                            value="{{ request('q') }}"
                        />
                    </div>
                </form>
                @forelse ($results as $result)
                    <article class="mb-3">
                        <h2>{{ $result->title }}</h2>

                        <p class="m-0">{{ $result->body }}</body>
                        <div>
                            <span class="badge badge-light">{{ class_basename($result)}}</span>
                        </div>
{{--                        <div>--}}
{{--                            @foreach ($result->tags as $tag)--}}
{{--                                <span class="badge badge-light">{{ $tag}}</span>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
                    </article>
                @empty
                    <p>No Results found</p>
                @endforelse
            </div>
        </div>
    </div>
@stop
