@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Редагування даних про депутата</b></div>
                    <div class="panel-body">
                        @if (empty($entity->id))
                            <form class="form-horizontal" method="POST" action="{{ route("admin.$viewName.store") }}">
                        @else
                            <form class="form-horizontal" method="POST" action="{{ route("admin.$viewName.update", $entity->id) }}">
                        @endif
                            {{ csrf_field() }}

                                  Виборчий округ  Район у місті   Адреса  Локація Дні прийому громодян    Початок прийому Кінець прийому  Звіт депутата міської ради 2016 рік

                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label for="full_name" class="col-md-2 control-label">ПIБ</label>

                                <div class="col-md-10">
                                    <input id="full_name" class="form-control" name="full_name" value="{{ old('full_name', $entity->full_name) }}" required autofocus>
                                    @include('_error', ['name' => 'full_name'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="birthday" class="col-md-2 control-label">Дата народження</label>

                                <div class="col-md-10">
                                    <input id="birthday" class="form-control" name="birthday" value="{{ old('birthday', $entity->birthday) }}">
                                    @include('_error', ['name' => 'birthday'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('faction') ? ' has-error' : '' }}">
                                <label for="faction" class="col-md-2 control-label">Депутатська фракція</label>

                                <div class="col-md-10">
                                    <input id="faction" class="form-control" name="faction" value="{{ old('faction', $entity->faction) }}">
                                    @include('_error', ['name' => 'faction'])
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