@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Редагування теми</b></div>
                    <div class="panel-body">
                        @if (empty($entity->id))
                            <form class="form-horizontal" method="POST" action="{{ route("admin.$viewName.store") }}" enctype="multipart/form-data">
                        @else
                            <form class="form-horizontal" method="POST" action="{{ route("admin.$viewName.update", $entity->id) }}" enctype="multipart/form-data">
                        @endif
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label">Роздiл</label>

                                <div class="col-md-10">
                                    <select name="theme_category_id" id="theme_category_id" class="form-control">
                                        @foreach(\App\Models\ThemeCategory::orderBy('title')->get() as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-2 control-label">Заголовок</label>

                                <div class="col-md-10">
                                    <input id="name" class="form-control" name="title" value="{{ old('title', $entity->title) }}" required autofocus>
                                    @include('_error', ['name' => 'title'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('preview_image') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-2 control-label">Зображення попереднього перегляду (263х140px)</label>

                                <div class="col-md-10">
                                    <input name="preview_image" type="file">

                                    @if ($entity->preview_image)
                                        <br>
                                        <img src="{{ $entity->preview_url }}">
                                    @endif
                                    @include('_error', ['name' => 'preview_image'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('html') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-2 control-label">Текст</label>

                                <div class="col-md-10">
                                    <textarea id="summernote" class="form-control summernote" name="html">{{ old('html',  $entity->html) }}</textarea>
                                    @include('_error', ['name' => 'html'])
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_published" class="col-md-2 control-label">Опублiкована</label>

                                <div class="col-md-10 checkbox">
                                    <label>
                                        <input type="checkbox" id="is_published" name="is_published" @if (old('is_published',  $entity->is_published)) checked @endif>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a style="margin-right: 10px" href="{{ route("admin.$viewName.index") }}">Назад</a>
                                    <button type="submit" class="btn btn-primary">
                                        Зберегти
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="_method" value="{{ empty($entity->id) ? 'POST' : 'PUT' }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('_editor_with_file_upload')