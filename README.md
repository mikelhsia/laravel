# laravel

## Route to controller instead of inline function
***********************************************
* Route::get('/tasks', 'TasksController@index');
* Route::get('/tasks/{task}', 'TasksController@show');

## Route with layout file
***********************************************
* Route::get('/posts', 'PostsController@index');
* Route::get('/posts/create', 'PostsController@create');
* Route::post('/posts', 'PostsController@store');

## Route without controller
***********************************************
* Route::get('/', function () {...});

