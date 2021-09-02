@extends('layout')
@section('content')

<h1>Mise à jour informations</h1>

<form method="post" action="{{ route('update', $user->id) }}">
@method('PUT')
@csrf
    <label>name
        <input type="name" name="name" value="{{ $user->name }}">
    </label>
    <label>email
        <input type="email" name="email" value="{{ $user->email }}">
    </label>
    <label>password
        <input type="password" name="password">
    </label>
    <label>password_confirmation
        <input type="password" name="password_confirmation">
    </label>
    <button type="submit">Changer</button>
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
