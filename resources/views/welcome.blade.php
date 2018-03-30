@extends('layout')

@section('content')
    <h3>Normal PHP</h3>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo $task; ?>
            </li>
        <?php endforeach; ?>

    </ul>
    <h3>Blade template</h3>
    <ul>
    <!--  Blade command template: equal to above php code -->
        @foreach ($tasks as $task)
            <li>
                {{ $task }}
            </li>
        @endforeach
    </ul>
@endsection

@section('footer')
    @include('layouts.nav')
@endsection
