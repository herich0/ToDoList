@extends('layouts.base')

@section('title', 'Sign Up')

@section('body')
    <form action="{{ route('signup') }}" method="post">
        @csrf

        <label for="name">Name</label>
        <input type="text" name="name">

        <label for="email">Email</label>
        <input type="email" name="email">

        <label for="cpf">CPF</label>
        <input type="text" name="cpf">

        <label for="birthDate">Birth Date</label>
        <input type="date" name="birthDate">

        <label for="password">Password</label>
        <input type="password" name="password">

        <button type="submit">Submit</button>
    </form>
@endsection