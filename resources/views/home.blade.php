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
    
    <h1>Your Tasks</h1>
    <ul>
        @foreach ($tasks as $task)
            <li>
                <p>Title : {{ $task->title }}</p>
                <p>Description : {{ $task->description }}</p>
                <p>Category : {{ $task->category }}</p>
                <p>Status: {{ $task->status ? 'Completed' : 'Pending' }}</p>
                
                <!-- Button to show/hide edit form -->
                <button onclick="toggleEditForm({{ $task->id }}, '{{ $task->title }}', '{{ $task->description }}', '{{ $task->category }}', {{ $task->status }})">
                    Edit
                </button>
                
                <!-- Form to delete the task -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
                
                <!-- Hidden edit form for this task -->
                <div id="editForm-{{ $task->id }}" style="display: none; margin-top: 10px;">
                    <h2>Edit Task: {{ $task->title }}</h2>
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" required>

                        <label for="description">Description</label>
                        <input type="text" name="description" value="{{ old('description', $task->description) }}" required>

                        <label for="category">Category</label>
                        <input type="text" name="category" value="{{ old('category', $task->category) }}" required>

                        <label for="status">Status</label>
                        <select name="status" required>
                            <option value="0" {{ old('status', $task->status) == 0 ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ old('status', $task->status) == 1 ? 'selected' : '' }}>Completed</option>
                        </select>

                        <button type="submit">Update Task</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleEditForm(id, title, description, category, status) {
            // Get the specific edit form element
            const editForm = document.getElementById('editForm-' + id);

            // Toggle the visibility of the form
            if (editForm.style.display === 'none' || editForm.style.display === '') {
                // If the form is hidden, show it
                editForm.style.display = 'block';

                // Optionally, set the form input values with task data
                editForm.querySelector('input[name="title"]').value = title;
                editForm.querySelector('input[name="description"]').value = description;
                editForm.querySelector('input[name="category"]').value = category;
                editForm.querySelector('select[name="status"]').value = status ? '1' : '0';
            } else {
                // If the form is already visible, hide it
                editForm.style.display = 'none';
            }
        }
    </script>

@endsection
