@extends('layout')
@section('content')

<h1>S'inscrire</h1>

<form method="post" action="/register">
@csrf
    <label>name
        <input type="name" name="name">
    </label>
    <label>email
        <input type="email" name="email">
    </label>
    <label>password
        <input type="password" name="password">
    </label>
    <label>password_confirmation
        <input type="password" name="password_confirmation">
    </label>
    <button type="submit">S'inscrire</button>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
