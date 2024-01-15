<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            font-family: 'JetBrains Mono';
        }
    </style>
    <title>Document</title>
</head>

<body>
    @if (Auth::check())
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
        <p>Name : {{ $user->name }}</p>
        <p>Email : {{ $user->email }}</p>
        <p>Id : {{ $id }}</p>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endif
    <table border="1px">
        <tr>
            <th>ID</th>
            <th>NAMA</th>
            <th>SCORE</th>
            <th>Actions</th>
        </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td><a href=" {{ route('show', $student->id) }}">{{ $student->name }}</a></td>
                <td>{{ $student->score }}</td>
                <td>
                    <form action="{{ route('edit', $student) }}" method="get">
                        <button type="submit">Edit</button>
                    </form>
                    <form action="{{ route('delete', $student) }}" method="post">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    Current page: {{ $students->currentPage() }} <br>
    Total data: {{ $students->total() }} <br>
    Data per page: {{ $students->perPage() }} <br>

    {{ $students->links('pagination::bootstrap-4') }}
</body>

</html>
