<!DOCTYPE html>
<html>
    <head>
        <title>Restore com laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Recuperar dados deletados com laravel</h1>
            @if(request()->has('view_deleted'))
            <a href="{{ route('users.index') }}" class="btn btn-info">Ver todos usuários</a>
            <a href="{{ route('users.restore') }}" class="btn btn-success">Restaurar todos</a><br/><br/>
            @else
            <a href="{{ route('users.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary">Ver registros deletados</a><br/><br/>
            @endif
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(request()->has('view_deleted'))
                            <a href="{{ route('users.restore', $user->id) }}" class="btn btn-success">Restaurar</a>
                            @else
                            <form method="POST" action="{{ route('users.delete', $user->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE"/>
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Excluir</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
    <script type="text/javascript">
        $('.show_confirm').click(function(e){
            if(!confirm('Você deseja realmente excluir este item ?')){
                e.preventDefault();
            }
        });
    </script>
</html>