@extends('errors.layout')

@section('title', __('Forbidden'))

@section('content')
    <section class="error">
        <div class="error__inner">
            <h1>403</h1>
            <h2>Sorry, you are forbidden from accessing this page.</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-lg btn-primary">Go back home</a>
        </div>
    </section>
@endsection