@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Список тем</b>
                        <a href="{{ route("admin.$viewName.create") }}" class="btn btn-primary pull-right btn-xs">
                            <i class="glyphicon glyphicon-plus-sign"></i> Додати
                        </a>
                    </div>
                    <div class="panel-body">
                        @if (!$entities->isEmpty())
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Роздiл</th>
                                <th>Заголовок</th>
                                <th>Опубліковано</th>
                                <th>Дата</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($entities as $entity)
                                <tr>
                                    <td class="text-left">
                                        {{ $entity->category->title }}
                                    </td>
                                    <td class="text-left">
                                        {{ $entity->title }}
                                    </td>
                                    <td class="text-left">
                                        {{ $entity->is_published ? 'Так' : 'Нi' }}
                                    </td>
                                    <td class="text-left">
                                        {{ $entity->created_at }}
                                    </td>
                                    <td>
                                        <a title="Редагувати" href="{{ route("admin.$viewName.edit", $entity->id) }}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                        @include('_delete_btn')
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">{{ $entities->links() }}</div>
                        @else
                            <div class="text-center">
                                <span>Записи вiдсутнi</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
