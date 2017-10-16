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

                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label for="full_name" class="col-md-2 control-label">ПIБ</label>

                                <div class="col-md-10">
                                    <input id="full_name" class="form-control" name="full_name" value="{{ old('full_name', $entity->full_name) }}" placeholder="Шевченко Тарас Григорович" required autofocus>
                                    @include('_error', ['name' => 'full_name'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="birthday" class="col-md-2 control-label">Дата народження</label>

                                <div class="col-md-10">
                                    <input id="birthday" class="form-control" name="birthday" value="{{ old('birthday', $entity->birthday) }}" placeholder="11.01.1974">
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

                            <div class="form-group{{ $errors->has('work') ? ' has-error' : '' }}">
                                <label for="work" class="col-md-2 control-label">Місце роботи, посада</label>

                                <div class="col-md-10">
                                    <input id="work" class="form-control" name="work" value="{{ old('work', $entity->work) }}" placeholder="ТОВ «IAM», директор">
                                    @include('_error', ['name' => 'work'])
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="district_id" class="col-md-2 control-label">Роздiл</label>

                                <div class="col-md-10">
                                    <select name="district_id" id="district_id" class="form-control">
                                        @foreach(\App\Models\District::orderBy('name')->get() as $district)
                                            <option {{ $entity->district_id === $district->id ? 'selected' : ''}} value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                <label for="region" class="col-md-2 control-label">Район у місті</label>

                                <div class="col-md-10">
                                    <input id="region" class="form-control" name="region" value="{{ old('region', $entity->region) }}">
                                    @include('_error', ['name' => 'region'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-2 control-label">Данi про прийоми депутата</label>

                                <div class="col-md-10">
                                    <textarea rows="10" class="form-control" name="details">{{ old('details',  $entity->details) }}</textarea>
                                    @include('_error', ['name' => 'details'])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url_report_2016') ? ' has-error' : '' }}">
                                <label for="url_report_2016" class="col-md-2 control-label">Звіт депутата міської ради 2016 рік</label>

                                <div class="col-md-10">
                                    <input id="url_report_2016" class="form-control" name="url_report_2016" value="{{ old('url_report_2016', $entity->url_report_2016) }}">
                                    @include('_error', ['name' => 'url_report_2016'])
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