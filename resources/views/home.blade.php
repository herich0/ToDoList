@extends('layouts.base')

@section('title', 'Home')

@section('body')
    <form action="{{ route('home') }}" method ="post">
        @csrf
        <label for="name">Title</label>
        <input type="text" name="task_table">

        <label for="email">Description</label>
        <input type="text" name="task_description">

        <label for="email">Category</label>
        <input type="text" name="task_category">

        <button type="submit">Submit</button>
    </form>
@endsection