@extends('layouts.base')

@section('title', 'Home')

@section('body')
<div class="container mt-5">
    <!-- Formulário de Cadastro (Create Task) Centralizado -->
    <div class="d-flex justify-content-center">
        <div class="card mb-4 w-50">
            <div class="card-header text-center">
                <h4>Create Task</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('task_register') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Lista de Tarefas -->
    <h1 class="text-center">Your Tasks</h1>
    <div class="d-flex justify-content-center">
        <ul class="list-group w-50">
            @foreach ($tasks as $task)
                <li class="list-group-item mb-3">
                    <h5 class="mb-1 text-center">{{ $task->title }}</h5>
                    <p class="mb-1">Description: {{ $task->description }}</p>
                    <p class="mb-1">Category: {{ $task->category }}</p>
                    <p>Status: <span class="badge {{ $task->status ? 'bg-success' : 'bg-warning' }}">
                        {{ $task->status ? 'Completed' : 'Pending' }}</span></p>

                    <!-- Botões Edit e Delete logo abaixo da task -->
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-secondary" onclick="toggleEditForm({{ $task->id }}, '{{ $task->title }}', '{{ $task->description }}', '{{ $task->category }}', {{ $task->status }})">Edit</button>
                        
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>

                    <!-- Formulário de edição oculto -->
                    <div id="editForm-{{ $task->id }}" class="mt-3" style="display: none;">
                        <h4>Edit Task: {{ $task->title }}</h4>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" value="{{ old('title', $task->title) }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" value="{{ old('description', $task->description) }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" name="category" value="{{ old('category', $task->category) }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="0" {{ old('status', $task->status) == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ old('status', $task->status) == 1 ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Update Task</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    function toggleEditForm(id, title, description, category, status) {
        const editForm = document.getElementById('editForm-' + id);
        if (editForm.style.display === 'none' || editForm.style.display === '') {
            editForm.style.display = 'block';
            editForm.querySelector('input[name="title"]').value = title;
            editForm.querySelector('input[name="description"]').value = description;
            editForm.querySelector('input[name="category"]').value = category;
            editForm.querySelector('select[name="status"]').value = status ? '1' : '0';
        } else {
            editForm.style.display = 'none';
        }
    }
</script>
@endsection
