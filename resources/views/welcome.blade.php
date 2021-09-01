@extends('layout')
@section('content')

<h1>Essai log</h1>

<form method="post" action="{{ route('login.custom') }}">
@csrf
    <label>email
        <input type="email" name="email">
    </label>
    <label>password
        <input type="password" name="password">
    </label>
    <button type="submit">Valider</button>
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
