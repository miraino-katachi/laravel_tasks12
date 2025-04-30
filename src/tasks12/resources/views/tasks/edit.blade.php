@extends('layouts.app')

<style>
    input[type="date"] {
        width: 200px;
    }
</style>

@section('content')

<h1>タスクを修正</h1>
<form action="{{ route('tasks.update', $task) }}" method="post">
@csrf
@method('PATCH')
    <div class="mb-3">
        <label for="title">タイトル</label>
        <input type="text" name="title" id="title" class="form-control
        @error('title')
            is-invalid
        @enderror
        " value="{{ old('title', $task->title) }}" aria-describedby="validTitle">
        @error('title')
            <div id="validTitle" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="expiration_date">期限日</label>
        <input type="date" name="expiration_date" id="expiration_date" class="form-control
        @error('expiration_date')
            is-invalid
        @enderror
        " value="{{ old('expiration_date', $task->expiration_date->format('Y-m-d')) }}"
        aria-describedby="validExpirationDate">
        @error('expiration_date')
            <div id="validExpirationDate" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="completion_date">完了日</label>
        <input type="date" name="completion_date" id="completion_date" class="form-control
        @error('completion_date')
            is-invalid
        @enderror
        " value="{{ old('completion_date',
            !is_null($task->completion_date) ? $task->completion_date->format('Y-m-d') : '') }}"
        aria-describedby="validCompletionDate">
        @error('completion_date')
            <div id="validCompletionDate" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description">説明</label>
        <textarea name="description" id="description" rows="5" class="form-control
        @error('description')
            is-invalid
        @enderror
        " aria-describedby="validDescription">{{ old('description', $task->description) }}</textarea>
        @error('description')
            <div id="validDescription" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit">送信</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">もどる</a>
</form>

@endsection