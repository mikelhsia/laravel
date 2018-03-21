@if (count($errors))
    <div class='alert alert-danger' style="background:pink; border: 1px solid red; border-radius: 2px;">
        <ul>
            @foreach($errors->all() as $error):
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
