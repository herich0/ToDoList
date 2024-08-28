@extends('layouts.base')

@section('title', 'Home')

@section('body')
    <form action="{{ route('task_register') }}" method ="post">
        @csrf
        <label for="name">Title</label>
        <input type="text" name="title">

        <label for="email">Description</label>
        <input type="text" name="description">

        <label for="email">Category</label>
        <input type="text" name="category">

        <button type="submit">Submit</button>
    </form>
    
    <h2>Your Tasks</h2>
    @if ($tasks->isEmpty())
        <p>No tasks found.</p>
    @else
        <ul>
            @foreach ($tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong> - {{ $task->description }}
                    <br>
                    <em>Category: {{ $task->category }}</em>
                </li>
            @endforeach
        </ul>
    @endif
    
@endsection