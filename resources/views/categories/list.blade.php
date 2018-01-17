@extends('layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Create category</h1>
                <form action="/categories/create" method="post">
                    <div class="form-group">
                        <label for="name">Category name</label>
                        <input id="name" type="text" name="name" class="form-control">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <div class="form-group">
                        <label for="parent">Parent category</label>
                        <select id="parent" class="form-control" name="parent_id">
                            <option value="">Выберите категорию:</option>
                            {{ options($treeCategories) }}
                        </select>
                        <small class="form-text text-muted">
                            Не меняйте значение, если хотите, чтобы категория была родительской
                        </small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h1>All Categories</h1>
                <ul class="root">
                    {{ HTMListTree($treeCategories, '', $activeCatId) }}
                </ul>
            </div>
        </div>
    </div>
@endsection
