@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Редагування округу</b></div>
                    <div class="panel-body">
                        @if (empty($entity->id))
                            <form class="form-horizontal" method="POST" action="{{ route("admin.$viewName.store") }}">
                        @else
                            <form class="form-horizontal" method="POST" action="{{ route("admin.$viewName.update", $entity->id) }}">
                        @endif
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Назва</label>

                                <div class="col-md-10">
                                    <input id="name" class="form-control" name="name" value="{{ old('name', $entity->name) }}" required autofocus>
                                    @include('_error', ['name' => 'name'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('polygon') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-2 control-label">Текст</label>

                                <div class="col-md-10">
                                    <textarea rows="10" class="form-control" name="polygon">{{ old('polygon',  $entity->polygon) }}</textarea>
                                    @include('_error', ['name' => 'polygon'])
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