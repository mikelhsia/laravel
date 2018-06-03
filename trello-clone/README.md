https://blog.pusher.com/web-application-laravel-vue-part-2/

Build a modern web application with Laravel and Vue – Part 1: Setting up your environment

blog.pusher.comMay 9, 2018 05:00 AM
In this series, we are going to walk through building modern web applications with Laravel and Vue. We will go from the basics, setting up your environment, to more technical concepts like building endpoints RESTfully and even testing your endpoints.

In this chapter, we will be setting up an environment for PHP development, Laravel to be specific. We will also be installing NodeJS and NPM as we will need them to manage and build our JavaScript and Vue files.


⚠️ Development environments differ a lot so it may be impossible to have a perfect setup guide that will be applicable to everyone. Therefore some of the setup guides contained in this article may not apply directly to your own OS or environment but there will be alternatives and I will try to mention any if I know of them. I am building on a Mac so other Mac users will be able to follow along 100%.


Prerequisites

To follow along in this series you will need the following:

Knowledge of PHP.
Very basic knowledge of the Laravel framework.
Knowledge of JavaScript and the Vue framework.
Basic knowledge of Node.js **and NPM.
SQLite installed on your machine. Installation guide.
Setting up for PHP development: installing composer


Composer is a package manager for PHP applications. It allows you install libraries and packages that are publicly available and make use of it in your own applications. This makes it easy to share reusable code among other PHP developers.

Laravel uses Composer to pull in the dependent libraries and so we need to install Composer on our machine so we can pull in these packages.

Installing Composer on Windows
Download and run Composer-Setup.exe. It will install the latest Composer version and set up your PATH so that you can just call composer from any directory in your terminal.

Installing on Linux/macOS
To install Composer, run the following script in your terminal:

    $ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

This will download the composer installer and then move it to your /usr/local/bin directory so you can call the composer command from anywhere on your terminal.

To test your installation, run:

    $ composer

And you should get output similar to this:

       ______
      / ____/___  ____ ___  ____  ____  ________  _____
     / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
    / /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
    \____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                        /_/
    Composer version 1.6.3 2018-01-31 16:28:17

    Usage:
     command [options] [arguments]

    Options:
     --help (-h)           Display this help message
     --quiet (-q)          Do not output any message
     --verbose (-v|vv|vvv) Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
     --version (-V)        Display this application version
     --ansi                Force ANSI output
     --no-ansi             Disable ANSI output
     --no-interaction (-n) Do not ask any interactive question
     --profile             Display timing and memory usage information
     --working-dir (-d)    If specified, use the given directory as working directory.
    ...

This means Composer was successfully installed on your system.

Setting up for PHP development: installing Valet (optional)


⚠️ Although Valet is only, officially, available to Mac users, there is a Linux port available here.


Valet is a Laravel development environment for Mac users. Laravel Valet configures your Mac to always run Nginx in the background when your machine starts. Valet also proxies all requests on the *.test domain to point to sites installed on your local machine. – Laravel Valet Documentation


Valet is not essential to follow along in this tutorial but is a good to have. With Valet you can quickly set up development environments for Laravel applications.

Before installation, you should make sure that no other programs such as Apache or Nginx are binding to your local machine’s port 80.

To install Valet, run the command below:

    $ composer global require laravel/valet

When composer is done, run the valet install command. This will configure and install Valet and DnsMasq, and register Valet’s daemon to launch when your system starts.

Once Valet is installed, you can check if it is installed correctly by pinging any *.test domain on your terminal using a command:

    ping -c 1 foo.test


If Valet is installed correctly you should see this domain responding on 127.0.0.1. You can read more about Laravel Valet in the documentation.

Setting up for PHP development: installing the Laravel CLI

Laravel makes building and managing applications easy. It bootstraps a lot of components that work together to create the perfect framework that would let you focus on what is core and important to your application. If this is your first time using Laravel, you may never go back to the old ways again.

The Laravel CLI can be installed easily with Composer. Run the following command to install it:

    $ composer global require "laravel/installer"

This command will install the Laravel CLI globally for you. So whenever you want to start a new project with Laravel, you’ll just need to run the following command:

    $ laravel new appname

When creation of the sample application is complete, you just need to cd appname and then if you are not using Laravel Valet, run the command below to start a PHP server on port 8000:

    $ php artisan serve


💡 You’ll need to press ctrl + c to exit the running Laravel application.


If you are using Laravel valet, you can link the project to a .test domain by running the command below in the root of the project:

    $ valet link appname

Then you can visit appname.test on your browser to see your new Laravel application. It’s that easy.

To see all the available Laravel CLI commands, run:

    $ php artisan list

Useful Laravel CLI commands
The make command is the one you’ll use the most. It lets you create different kinds of components for your application. You can use it to create models, controllers, database migrations, and other things which we will not cover in this series.

To make a new model class, that will be created in the app/ directory, run the command:

    $ php artisan make:model SampleModel

To make a new controller class, that will be created in the app/Http/Controller/directory, run the command:

    $ php artisan make:controller SampleController

To make a new database migration class, that will be created in the database/migrations/ directory, run the command:

    $ php artisan make:migration create_sample_table

To migrate changes to your database using the migrations you generated earlier, run the following command:

    $ php artisan migrate

For a really simple Laravel application, these are the commands you may likely use all through. We will learn more about them as we progress through the application. You can also check out the console documentation.

Should I use Lumen or Laravel

Lumen is a scaled down version of the Laravel framework. It removes a lot of components that it deems not as useful for lightweight development. Because it is made from Laravel, applications built in Lumen can easily be upgraded to Laravel.

It is mainly designed for building apps with microservice architecture or building APIs. In Lumen, sessions, cookies, and templating are not needed so they are taken away, keeping what’s essential – routing, logging, caching, queues, validation, error handling and a few more.

The choice between Lumen and Laravel comes when you are deciding how you want your application to function. If you want to build a single page application using Vue or React, you may decide to use Lumen to power your business logic.

If you want to integrate them into the application so that a few components are embedded directly in your templates, Laravel is the way to go. With Lumen you will not get the full functionality Laravel has to offer. So if you decide you need the full functionality, choose Laravel over Lumen.

For this series, we will be using Laravel in its full glory.

Installing and configuring dependencies (Passport)

Our application is going to be API based, so we need a way to secure our APIs so only recognized users can get into it.

Installing Laravel Passport
Laravel Passport is the tool for API Authentication. Passport makes authentication a breeze and provides a full OAuth2 server implementation for your Laravel application in a matter of minutes.

To install passport, run the following command:

    $ composer require laravel/passport

API Auth using Laravel Passport
There is an extensive article on authentication with Laravel Passport available here. You should give it a read before moving to the next part of this series as it will help you get familiar with Laravel Passport.

Conclusion

In this part, we considered how you can set up your development environment for building modern web applications. In the next parts, we will build a Laravel application and while building, we will explain some concepts you need to know.

As we progress with building our application, you will see how we can bring all the tools together to build modern applications using Vue and Laravel. See you in the .

In the last chapter, we looked at how to successfully set up a development environment preparing us for PHP Development. Through the rest of the series, we will be building a simple “Trello Clone”.

In this chapter, we will take a closer look at how setting up out application “RESTully” will play a role in us building modern apps using Vue and Laravel.

At the end of the series, what we’ll have will look like this:


Prerequisites

This part of the series requires that you have:

Completed the first part of the series and have setup your development environment properly.
Creating the application

To get started, we need to create our application. Since we have already set up our development environment in part one, all we need to is run the following command to create a new Laravel application:

    $ laravel new trello-clone

To give your application a test run, cd into the trello-clone directory and then run the command:

    $ php artisan serve

This runs your Laravel application on 127.0.0.1:8000. To kill the server press ctrl+c on your machine. If you have Laravel valet installed and configured on your machine then you can cd to the trello-clone directory, run the command below:

    $ valet link trello-clone

Then head over to http://trello-clone.test. You should see the Laravel welcome page as seen below:


Building the models

For our simple trello clone, we are going to have the following models:

User.
Task.
Category.
To build a model, run the following below. Since we already have the User model, we need models for the Task and Category resources. You can go ahead and create the models now.

    $ php artisan make:model ModelName -mr


💡 The -mr flag creates an accompanying migration file and resource controller for the model.


The User model
Laravel comes bundled with a default User model so you do not need to create one. The User model will have the following fields:

id – the unique auto-incrementing ID of the user.
name – the name of the user.
email – the email of the user.
password – used in authentication.
Open the User model which is in the app directory and update it as below:

    <?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class User extends Authenticatable
    {
        use SoftDeletes, Notifiable;

        protected $fillable = ['name', 'email', 'password'];

        protected $hidden = [
            'password', 'remember_token',
        ];

        public function tasks(){
            return $this->hasMany(Task::class);
        }
    }


💡 A fillable column in Laravel is a database column that is mass assignable. This means you can just pass an array to the create function of the model with the data you want to get assigned.


💡 SoftDeletes is a way of deleting resources without actually deleting the data from the database. What happens is that when the table is created, there will be a field called ‘deleted_at’ and when a user tries to delete a task, the ‘deleted_at’ field will be populated with the current date time. And so when fetches are made for resources, the ‘deleted’ resource will not be part of the response


Task model
The task model will have the following fields:

id – a unique identifier for the task.
name – the name of the task.
category_id – ID of the category the task belongs to.
user_id – ID of the user the task belongs to.
order – the order of the task in its respective category.
Create a Task model using the artisan command. Then open it from the app directory and replace the contents with the following:

    <?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Task extends Model
    {
        use SoftDeletes;

        protected $fillable = ['name', 'category_id', 'user_id', 'order'];

        public function category() {
            return $this->hasOne(Category::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }
    }

Category model
The category model will have the following fields:

id – this will uniquely identify every category.
name – represents the name of the category.
Create a Category model using the artisan command. Then open it from the app directory and replace the contents with the following:

    <?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Category extends Model
    {
        use SoftDeletes;

        protected $fillable = ['name'];

        public function tasks() {
            return $this->hasMany(Task::class);
        }
    }

Here, the tasks() function is to help define relationships between the Category model and the Task model as a one-to-many relationship. What this means is one category has many tasks.

Writing our migrations

For this application to work, we need to create the database. To keep track of changes going on in our database, we make use of migrations, which is an in-built feature of Laravel.

As part of the prerequisites mentioned in the first part of this series, you need SQLite installed on your machine. To create an SQLite database that Laravel can connect to create an empty new file in the database directory called database.sqlite.

Next open your .env file in the root of your project and replace the following lines:

    DB_CONNECTION=mysql
    DB_DATABASE=homestead
    DB_USERNAME=username
    DB_PASSWORD=password

with

    DB_CONNECTION=sqlite
    DB_DATABASE=/full/path/to/database/database.sqlite

That is all for our database setup. However while you’re in the .env file, change the APP_URL value from http://localhost to http://127.0.0.1:8000 as this will be the application URL.

If you wanted to create migrations, the artisan command is:

    $ php artisan make:migration create_tablename_table

You can name your migration file whatever you like, but it is always good to name it like verb_tablename_table as shown above. The file will be created in the database/migrations directory.

However since we have already used the -mr flag earlier while creating our models, the migrations should have been created for us already.


⚠️ Migrations are run time-based. So you need to consider this when making migrations for tables that are dependent on each other.


Updating our user migration
Open the create users migration file in the database/migrations directory and replace the content with the code below:

    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUsersTable extends Migration
    {
        public function up()
        {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users');
        }
    }

Updating our category migration
Since we had created the category migration earlier, open the file and replace the content with the code below:

    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateCategoriesTable extends Migration
    {
        public function up()
        {
            Schema::create('categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        public function down()
        {
            Schema::dropIfExists('categories');
        }
    }

Creating our task migration
Since we created the task migration file earlier, open the file and replace the content with the code below:

    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateTasksTable extends Migration
    {
        public function up()
        {
            Schema::create('tasks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->unsignedInteger('category_id');
                $table->unsignedInteger('user_id');
                $table->integer('order');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('category_id')->references('id')->on('categories');
            });
        }

        public function down()
        {
            Schema::dropIfExists('tasks');
        }
    }

Now that we have our migration files, let’s run the artisan command to execute the migrations and write to the database:

    $ php artisan migrate


💡 Migrations are like version control for your database. It allows you create, modify or tear down your database as your application evolves, without having to manually write SQL queries (or whatever queries your database of choice uses). It also makes it easy for you and your team to easily modify and share the application’s database schema. Learn more.


Database seeders
Now that we have created our database migrations, lets see how to put in dummy data for when we are testing our applications. In Laravel, we have something called seeders.


💡 Seeders allow you automatically insert dummy data into your database.


This is the command to make a seeder:

    $ php artisan make:seeder TableNameSeeder

Creating our users table seeder
To create our database seeder type the following command:

    $ php artisan make:seeder UsersTableSeeder

This creates a UsersTableSeeder.php file in the database/seeds directory. Open the file and replace the contents with the following code:

    <?php

    use App\User;
    use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder
    {
        public function run()
        {
            User::create([
                'name' => 'John Doe',
                'email' => 'demo@demo.com',
                'password' => bcrypt('secret'),
            ]);
        }
    }

The run function contains the database query we want to be executed when the seeders are run.


💡 You can use model factories to create better-seeded data.


💡 We use the bcrypt to hash the password before storing it because this is the default hashing algorithm Laravel uses to hash passwords.


Creating our categories table seeder
To create our database seeder type the following command:

    $ php artisan make:seeder CategoriesTableSeeder

This creates a CategoriesTableSeeder.php file in the database/seeds directory. Open the file and replace the contents with the following code:

    <?php

    use App\Category;
    use Illuminate\Database\Seeder;

    class CategoriesTableSeeder extends Seeder
    {
        public function run()
        {
            $categories = ['Ideas', 'On Going', 'Completed'];

            foreach ($categories as $category) {
                Category::create(['name' => $category]);
            }
        }
    }

Running our database seeders
To run the database seeders, open the database/DatabaseSeeder.php file and replace the run method with the code below:

    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
        ]);
    }

Next, run the command below on your terminal:

    $ php artisan db:seed

This should update the databases with data. If at some point you want to refresh and seed your data again, run the command below:

    $ php artisan migrate:fresh --seed

This will delete the database tables, add them back and run the seeder.

REST in a nutshell

In technical terms, REST stands for REpresentational State Transfer (elsewhere, it just means “to relax”). In order for you get a good grasp of this article, there are couple of terms that need to be broken down into bite-sized nuggets.

Clients, statelessness, resources – what’s the relationship?
Clients are the devices that interact with your application. For any given application, the number of clients that interact with it can range from one to billions. When you go to a website (e.g. https://pusher.com) your client sends a request to the server. The server then processes your request and then sends a response back to your client for interaction.

Statelessness in the simplest of terms means building your application in such a way that the client has all it needs to complete every request. When the client makes subsequent requests, the server won’t store or retrieve any data relating to the client. When your application starts having more active concurrent users, it will be an unnecessary burden on your server managing states for the client. Being stateless also simplifies your application design so unless you have specific reasons not to be, then why not?

Resources are a representation of real-life instances in your code. Take for example you are building an application that allows students to check their grades, a good example of resources in such an application will be your students, courses etc. These resources are linked with the data that will be stored in the database.

Now when we are building RESTful applications, our server gives the client access to the resources. The client is then able to make requests to fetch, change, or delete resources. Resources are usually represented in JSON or XML formats but there are many more formats and it’s up to you during your implementation to decide the format.

Creating your first few REST endpoints

Before we start creating the endpoints, make sure you get familiar with best practices on naming REST resources.

We currently have the following HTTP Verbs which we are going to apply:

GET – this is usually used to fetch a resource
POST – this is used to create a new resource
PUT/PATCH – used to replace/update an existing resource
DELETE – used to delete a resource
Here is a tabular representation of how our REST endpoints for our tasks resource will look:

Lets start creating the routes in our application. Open the routes/api.php file and updated:

    <?php

    Route::resource('/task', 'TaskController');
    Route::get('/category/{category}/tasks', 'CategoryController@tasks');
    Route::resource('/category', 'CategoryController');

Above, we defined our routes. We have two route resources that register all the other routes for us without having to create them manually. Read about resource controllers and routes here.

Formatting responses and handling API errors

Earlier in the article, we spoke about making requests from the client. Now let’s look at how to create and format our responses when a request has been handled.

Creating our controllers
Now that we have our routes, we need to add some controller logic that will handle all our requests. To create a controller, you need to run the following command on the terminal:

    $ php artisan make:controller NameController

However since we have created our requests when we used the -mr earlier, let’s edit them.

Open the controller file TaskController.php in the app/Http/Controller/ directory. In there, we will define a few basic methods that’ll handle the routes we created above.

In the file update the store method as seen below:

    public function store(Request $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'order' => $request->order
        ]);

        $data = [
            'data' => $task,
            'status' => (bool) $task,
            'message' => $task ? 'Task Created!' : 'Error Creating Task',
        ];

        return response()->json($data);
    }


💡 On line 16 we can see that the response is set to be in the JSON format. You can specify what response format you want the data to be returned in, but we will be using JSON.


⚠️ We are not focusing on creating the meat of the application just yet. We are explaining how you can create RESTful endpoints. In later parts, we will create the controllers fully.


Securing our endpoints with Passport

Now that we have our routes, we have to secure them. As they are now, anyone can access them without having to verify that they should be able to.

Laravel, by default, has support for web and api routes. Web routes handle routing for dynamically generated pages accessed from a web browser, while, api routes handle requests from clients that require a response in either JSON or XML format.

Authentication and authorization (JWT) to secure the APIs
In the first part of this series, we talked about API authentication using Laravel Passport. If you read this guide, you would already have the idea of how to make this work. For that reason, we would go over a lot of things fairly quickly in this section.

First, install Laravel Passport:

    $ composer require laravel/passport  

Laravel Passport comes with the migration files for the database table it needs to work, so you just need to run them:

    $ php artisan migrate

Next, you should run the passport installation command so it can create the necessary keys for securing your application:

    php artisan passport:install

The command will create encryption keys needed to generate secure access tokens plus “personal access” and “password grant” clients which will be used to generate access tokens.

After the installation, you need to use the Laravel Passport HasApiToken trait in the User model. This trait will provide a few helper methods to your model which allow you to inspect the authenticated user’s token and scopes.

File: app/User.php

    <?php

    [...]

    use Laravel\Passport\HasApiTokens;

    class User extends Authenticatable
    {
        use HasApiTokens, SoftDeletes, Notifiable;

        [...]
    }

Next, call the Passport::routes method within the boot method of your AuthServiceProvider. This method will register the routes necessary to issue the tokens your app will need:

File: app/Providers/AuthServiceProvider.php

    <?php

    [...]

    use Laravel\Passport\Passport;

    class AuthServiceProvider extends ServiceProvider
    {
        [...]

        public function boot()
        {
            $this->registerPolicies();

            Passport::routes();
        }

        [...]
    }

Finally, in your config/auth.php configuration file, you should set the driver option of the api authentication guard to passport.

File: config/auth.php

    [...]

    'guards' => [
        [...]

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

    [...]

Log in and register using the API
Now that you have setup the API authentication for this application using Laravel Passport, we will need to make the login and registration endpoints.

Add the following routes in routes/api.php file:

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

You also need to create the UserController to handle authentication requests for the API. Create a new file UserController.php in app/Http/Controllers and place the following code in it:

    <?php

    namespace App\Http\Controllers;

    use App\User;
    use Validator;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class UserController extends Controller
    {
        public function login()
        {
            $credentials = [
                'email' => request('email'), 
                'password' => request('password')
            ];

            if (Auth::attempt($credentials)) {
                $success['token'] = Auth::user()->createToken('MyApp')->accessToken;

                return response()->json(['success' => $success]);
            }

            return response()->json(['error' => 'Unauthorised'], 401);
        }

        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);

            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            return response()->json(['success' => $success]);
        }

        public function getDetails()
        {
            return response()->json(['success' => Auth::user()]);
        }
    }

In the code above we have the:

Login Method: in here we call Auth::attempt with the credentials the user supplied. If authentication is successful, we create access tokens and return them to the user. This access token is what the user would always send along with all API calls to have access to the APIs.

Register Method: like the login method, we validated the user information, created an account for the user and generated an access token for the user.

Grouping routes under a common middleware
For our routes, we can group the routes we need authentication for under a common middleware. Laravel comes with the auth:api middleware in-built and we can just use that to secure some routes as seen below in the routes/api.php file:

    <?php

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::resource('/task', 'TasksController');
        Route::resource('/category', 'CategoryController');
        Route::get('/category/{category}/tasks', 'CategoryController@tasks');
    });

Handling API errors

In the event that our server encountered errors while serving or manipulating our resources, we have to implement a way to communicate to the client that something went wrong. For this, we have to serve the responses with specific HTTP status codes.

If you look at the UserControlle``r.php file you can see us implementing HTTP status code 401 which signifies that the client is not authorized to view the resource:

    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        [...]

        return response()->json($response, $status);
    }

Conclusion

In this part of the series, we have considered how you can create RESTful endpoints for your application. We also considered how you can handle errors and serve the correct HTTP status code to the client.

In the , we will address how to test your API endpoints using Postman. We will set up some unit tests, which will be useful for our own testing from the command-line.

In the last chapter, we looked at how to make RESTful API Endpoints. The next thing we will consider is how to test the application’s endpoints before releasing it for public consumption. This is useful because it makes sure that throughout the lifetime of the application, you can be sure that the API works as expected.

Prerequisites

This part of the series requires that you have:

Postman installed on your machine.
Completed part 2 of the series.
When you have met all the requirements above, let’s continue.

Using Postman for testing endpoints

To test our API endpoints, we are going to use Postman. Postman is a complete tool-chain for API developers and is available on all desktop platforms.

Download and installation
To download Postman, head over here. Once you have successfully downloaded and installed Postman, run it and when you get the interface below, you’re good to go.


Now that we have Postman successfully installed, we can start making our requests to the API. Let’s start by making a GET request to fetch the resources from our API Server.


💡 For brevity, we will show examples for a few endpoints and you can repeat the rest for other endpoints.


For all requests made using Postman, remember to set the header Accept: application/json in the headers tab of Postman to make sure we get the right response from our API.


💡 Postman collections help you organise and save all your requests. This makes it easier to go back to an existing request without having to retype it.


Fetching resources in Postman
To fetch resources, you need to provide the HTTP method, usually GET, and the URL to fetch the resources from. In the case of our application, we will test a simple endpoint.

Start your Laravel server, if it’s not already running, using the php artisan serve command and hit the following endpont:


⚠️ Because we have added an authorization middleware to the routes, calling these endpoints without authentication will fail with a “401 Unauthorized” response. We will consider how to make authorized requests later in this article.


URL: http://127.0.0.1:8000/api/category/ 
Method: GET


Creating resources using Postman
To create resources, you need to provide the HTTP method, usually POST, and the URL to post the data to be created to. In the case of our application, we will test a simple endpoint.

Start your Laravel server, if it’s not already running, using the php artisan serve command and hit the following endpont:

URL: http://127.0.0.1:8000/api/category 
Method: POST 
Body: name


Updating resources using Postman
To update a resource, you need to provide the HTTP method, usually PUT (or PATCH, depending on your preference), and the URL to post the data to be updated to. In the case of our application, we will test a simple endpoint.

Start your Laravel server, if it’s not already running, using the php artisan serve command and hit the following endpont:

Good Read: Difference between PUT and PATCH.

URL: http://127.0.0.1:8000/api/category/{category_id} 
Method: PUT 
Body: name


Deleting resources using Postman
To delete a resource, you need to provide the HTTP method, usually DELETE, and the URL to the resource to be deleted. In the case of our application, we will test a simple endpoint.

Start your Laravel server, if it’s not already running, using the php artisan serve command and hit the following endpont:

URL: http://127.0.0.1:8000/api/category/{category_id} 
Method: DELETE


Making authorized requests using access tokens

Certain parts of our application can only be accessed by authenticated users. For this, in the previous article, we added a few endpoints for authentication. When a user hits these endpoints, they will be authenticated and provided with an access token. Attaching this access token to a request on a protected route will grant the user access to the resource.

To create tokens on the backend for the API, we will be using Laravel Passport we setup earlier. Now we will be looking at how to use our access tokens with Postman. First of all, you need to get the token by logging the user in. If the user doesn’t have an account, we create one and then log in.

Creating a new user account
To create a new user, make a POST request using Postman as shown below:

URL: http://127.0.0.1:8000/api/register 
Method: POST 
Body: name, email, password


As seen from the response above, there is a token that is returned with the response. The client can make requests using the token obtained from the API as the access_token for further request.


💡 You will need to copy this token for use on other API endpoints except the /api/login endpoint.


Logging in to a user account
To log into a user account, send a request to the endpoint using Postman as seen below:

URL: http://127.0.0.1:8000/api/login 
Method: POST 
Body: email, password


Applying access tokens to authenticate requests
Now that we have obtained the token from the previous requests, the next we want to do is to now use the access tokens to make our next request. We are going to make a request to fetch all the categories.

Before doing this, go to the CategoryController.php and update the index method as seen below:

    [...]

    public function index()
    {
        return response()->json(Category::all()->toArray());
    }

    [...]

Now we can make our request in Postman.


💡 Making a request without specifying the mode of authentication and the token will fail. To authenticate the request, go to the Authorization tab and then paste the token obtained from the last login/register request.


URL: http://127.0.0.1:8000/api/category 
Method: GET


As seen from the screenshot above, the categories are displayed in the response section. If you remove or change the token and make a new request you will get an “Unauthorised” response.

Automatically generating access tokens for Postman requests
Now that we know how to use access tokens to make requests with Postman, you’ll notice how manual the process is. Since we know we will be making a lot of requests using Postman, let’s get Postman to generate our access tokens automatically.

To get started, we need to create a Postman environment. In the environment, we are going to create some variables. To create a new environment, click the Environment quick look button on the top right and then enter the name of the environment you want to create.


Next, add the environment variables. We’ll create a variable for the url and also one for the token.


💡 We will leave the value for the token field blank as that is what we are going to generate so we don’t need to put a value.



Save your new environment. Next, on the top right of the panel where the url is usually entered, you need to change the environment from No Environment to the name of the environment you want to use – in this case, Trello Clone.


Let’s modify the login request we made earlier. Now in the Tests tab, add the following code:

    postman.setEnvironmentVariable("token",  JSON.parse(responseBody).success.token);

What this script does is that it fetches the token from the response and then sets the value to our token environment variable. It’s a bit hacky but it will solve the issue of having to copy the data manually.


After doing this, make the request to the login endpoint. Next, go to any endpoint that requires an access token and add {{token}} to the Authorization tab. After that the token will be automatically added there and you won’t need to copy the access token to make other requests.


Quick dive into unit tests for your endpoints

By now you have probably heard of Test Driven Development and writing tests for your application. Some developers shy away from writing tests but writing tests is a good way to make sure that you can update your code confidently without worrying about introducing bugs.

What are unit tests?

In computer programming, unit testing is a software testing method by which individual units of source code, sets of one or more computer program modules together with associated control data, usage procedures, and operating procedures, are tested to determine whether they are fit for use. – Wikipedia.


Writing unit tests in Laravel
Let’s take a look at how to write unit tests. We are going to write tests for the Trello Clone application. We are not going to have 100% coverage, it’s just a few to show you how you can write your own tests.

Laravel comes built with some starter code for unit tests and we will be building on top of that in the following examples. To make a new test in Laravel, you run the following artisan command:

    $ php artisan make:test APITest --unit

Test registering a new user
Let’s write a test to check if our register endpoint works. Open the APITest.php file in the tests/Unit directory and paste this into the file:

    <?php

    namespace Tests\Unit;

    use Tests\TestCase;

    class APITest extends TestCase
    {
        public function testUserCreation()
        {
            $response = $this->json('POST', '/api/register', [
                'name' => 'Demo User',
                'email' => str_random(10) . '@demo.com',
                'password' => '12345',
            ]);

            $response->assertStatus(200)->assertJsonStructure([
                'success' => ['token', 'name']
            ]);
        }
    }

In the code above, we created a mock request using the json method that comes with Laravel’s TestCase class and then checked the response to see if the status code is 200 and if the returned structure matches what we expect.

Test logging in a new user
To test if the login endpoint works, let’s add a new method to the APITest class:

    public function testUserLogin()
    {
        $response = $this->json('POST', '/api/login', [
            'email' => 'demo@demo.com',
            'password' => 'secret'
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'success' => ['token']
        ]);
    }

Test fetching all categories
Next, let’s test fetching categories. Add the following method to the class:

    public function testCategoryFetch()
    {
        $user = \App\User::find(1);

        $response = $this->actingAs($user, 'api')
            ->json('GET', '/api/category')
            ->assertStatus(200)->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ]
            ]
        );
    }

The above structure assertion is indicated by the * that the key can be any string.

Since we don’t have any logic for some methods in our category controller, lets add some make-believe logic for now. We will update it in one of the next parts. Open the CategoryController and update the following methods as seen below:

    public function store(Request $request)
    {
        return response()->json(['status' => true, 'message' => 'Category Created']);
    }

    public function destroy(Category $category)
    {
        return response()->json(['status' => true, 'message' => 'Category Deleted']);
    }

Now let’s test these endpoints.

Test creating a new category resource
To test adding a new category, add the following method to the APITest class:

    public function testCategoryCreation()
    {
        $this->withoutMiddleware();

        $response = $this->json('POST', '/api/category', [
            'name' => str_random(10),
        ]);

        $response->assertStatus(200)->assertJson([
            'status' => true,
            'message' => 'Category Created'
        ]);
    }

In the above, we make a call to $this->withoutMiddleware(). This leaves out the middleware(s) registered to this endpoint. Because the auth:api is a middleware registered to this endpoint, it is left put and we can call without authentication. This is not a recommended method but it’s good to know it exists.

Test deleting a category resource
Let’s write a test to test deleting a resource. In the test class, add the following method:

    public function testCategoryDeletion()
    {
        $user = \App\User::find(1);

        $category = \App\Category::create(['name' => 'To be deleted']);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', "/api/category/{$category->id}")
            ->assertStatus(200)->assertJson([
                'status' => true,
                'message' => 'Category Deleted'
            ]);
    }

Running the unit tests
Now that you have written your tests, you can run them using the command below in the root of your project:

    $ ./vendor/bin/phpunit


From the output above, can see that all our tests passed and we are good to continue writing more test cases or maybe release our API for public consumption!

Bonus: using a separate database for unit tests
On a side note, when running tests, we will definitely want to use a different database from our current one so it does not become cluttered. Laravel helps us handle this effectively.

If you want to do this in any other project you are working with, open the phpunit.xml file in the root of your project and look for the <php> tag. Replace the children of this tag with the following:

    [...]
    <env name="APP_ENV" value="testing"/>
    <env name="APP_URL" value="http://127.0.0.1:8000"/>
    <env name="DB_CONNECTION" value="sqlite"/>
    <env name="DB_DATABASE" value=":memory:"/>
    <env name="CACHE_DRIVER" value="array"/>
    <env name="SESSION_DRIVER" value="array"/>
    <env name="QUEUE_DRIVER" value="sync"/> 
    [...]

This forces PHPUnit to use in-memory SQLite as its database. Next, in the test class, add the following:

    <?php

    [...]
    use Illuminate\Foundation\Testing\DatabaseMigrations;

    class SomeTest extends TestCase
    {
        use DatabaseMigrations;

        [...]
    }

    [...]

You don’t need to do this in the current project’s tests though as the project was not set up for that. It’s just a good to know.


💡 The DatabaseMigrations trait makes sure that a migration is run before the test is run. This ensures the tables exist before the tests are run so we do not get database errors.


Conclusion

In this part of the series, we have seen how to use Postman to test API endpoints. We also automate the token generation process for requests. We have also seen how to unit test our API Endpoints.

​​In the we will diverge from PHP a little and look at how to create our front facing Vue Application.

In the last chapter, we talked about how you can create API endpoints in a Laravel application. We also explored how you can take it a step further by integrating tests into the application.

In this chapter, we are going to change our point of view, slightly overused pun intended, and look at how we can create the frontend of our application using Vue. It is very common nowadays for web applications to have a front and backend in a somewhat separate fashion. So let’s explore different ways we could build a Vue application on Laravel and see how it all ties together.

Prerequisites

To follow this chapter you need:

Basic knowledge of VueJS.
Basic knowledge of Laravel.
Part 1 – 3 of this series completed.
Different ways to vue things

There are different ways we can use Vue with Laravel. We can choose to build a standalone Vue application, Single Page Application, and have Laravel provide the API endpoints, or we can integrate the Vue components into Laravel blade templates as Multi Page Applications. Whichever method you choose is up to you and it depends on your situation.

Single Page Applications (SPA)
SPAs work inside a browser and do not need page reload. They create a wonderful user experience and can simulate native applications that you can install on your device. The key thing to note is that they load data and markup independently.

This means that for an SPA to change the content on the page, it would never reload, but fetch the data using JavaScript. Although SPAs are fast and require minimal access to the internet after they are loaded, they don’t do too well in search rankings and usually require some extra optimization for SEO.

In our case, the SPA will load on the first call to your application, then swap out the different pages as you continue to use the application with the aid of vue-router. All the data required for each page would be loaded when the components are mounted via calls to your backend API.

Multi Page Applications (MPA)
MPAs are the traditional way web applications have been built for years. They typically reload the browser every time data needs to be changed or a request for a new resource is made. You can certainly use AJAX to simplify some MPA operations and reduce page reloads.

MPAs have an edge when it comes to SEO as they are by default crawlable. Unlike SPAs, you do not need to do anything special to make your MPA crawlable. You just need to serve the pages as they are and it will be crawled by search engines unless they are explicitly told not to.

When using Vue in a Laravel MPA, you’ll embed your Vue components directly in your blade file. You can pass data as props to the component. This won’t disrupt the page and its assets and you can easily your normal CSS and JS in addition to Vue.

Building a standalone Vue application

To get started with Vue, you will need to create a new Vue application. To do so, we would need the Vue-CLI which is a command-line tool we can use to scaffold new Vue applications. To use the vue-cli to setup a standalone project, open your terminal and run the following:

    $ npm install --global vue-cli

When vue-cli has been installed, you can create a standalone Vue application anywhere by running the following command:

    $ vue init webpack my-new-app

We won’t need to do this though as we are using the built-in Laravel installation.


💡 webpack in the command above specifies the template we want to use. Vue projects can be initialized with different templates.


The above command will create a new Vue project using the webpack template. From here you can start building your Vue application.

Vue-Laravel integration

Laravel comes pre-packaged with Vue, which means you don’t need to use the vue-cli, especially if you want to build your application with a single codebase. In a new installation of Laravel, you can see the Vue files by going to the resources/assets/js/components directory.

For brevity, we will be developing using the inbuilt Laravel integration since it already comes with the build tools and all.

Setting up vue-router
There are a lot of packages that work with Vue and if you need to add more you can always install them using NPM. Packages installed get saved in a package.json file and this comes with the Laravel installation.

Install predefined modules in package.json file first:

    $ npm install

After the modules are installed, we can install the vue-router with the command below:

    $ npm install vue-router

When the installation is complete, open your resources/assets/js/app.js file and replace the contents with the following code:

    import Vue from 'vue'
    import VueRouter from 'vue-router'

    Vue.use(VueRouter)

    import App from './views/App'
    import Welcome from './views/Welcome'

    const router = new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/',
                name: 'home',
                component: Welcome
            },
        ],
    });

    const app = new Vue({
        el: '#app',
        components: { App },
        router,
    });

Above, we have imported the VueRouter and we added it to our Vue application. We defined routes for our application and then registered it to the Vue instance so it is available to all Vue components.


💡 The VueRouter constructor takes an array of routes. In there we define the URL path, the name of the route, and the component used to fulfill requests to the route.


Next, we need to make the route for our Vue app. We’ll use a Laravel web route to load the app, and the vue router will take over the rest from there. Open your routes/web.php file and add the following route before the default route:

    Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

We also need to create the SpaController to handle the requests. Run the following command:

    $ php artisan make:controller SinglePageController

After it is created, go to your app/Http/Controller directory and open the SinglePageController.php file, and add the following method to the class:

    [...]

    public function index()
    {
        return view("landing");
    }

    [...]

Next, let’s make the landing view file. Create the file resources/views/landing.blade.php and add the following code:

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Treclon</title>
        <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script src="{{ mix('js/bootstrap.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
    </html>

In the code above, we just have the HTML for our application. If you look closely, you can see the app tag. This will be the entry point to our Vue application and where the App component will be loaded in.

Next, let’s edit the webpack.mix.js file so it compiles our assets. Update the mix declarations in the file to the following:

    [...]

    mix.js('resources/assets/js/app.js', 'public/js')
       .js('resources/assets/js/bootstrap.js', 'public/js')
       .sass('resources/assets/sass/app.scss', 'public/css');


💡 webpack.mix.js file holds the configuration files for laravel-mix which provides a wrapper around Webpack. It lets us take advantage of webpack’s amazing asset compilation abilities without having to write Webpack configurations by ourselves. You can learn more about Webpack here.


Now, let us setup a simple welcome page for our Vue application. Create a new file, resources/assets/js/views/Welcome.vue, and add the following code to the file:

    <template>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div  class="m-b-md">
                    <h2 class="title m-b-md">
                        Treclon
                    </h2>
                    <h3>
                        Your efficent task planner
                    </h3>
                </div>
            </div>
        </div>
    </template>

The code above within the template tags defines the HTML of our Vue component. In the same file, append the code below the closing template tag:

    <style scoped>
    .full-height {
        height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 60px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
        color: #000000;
    }
    </style>

In the code above, we have defined the style to use with the welcome component.


💡 When a <style> tag has the scoped attribute, its CSS will apply to elements of the current component only. This is similar to the style encapsulation found in Shadow DOM. It comes with some caveats but doesn’t require any polyfills. – Vue documentation.


Next, append the code below to the file:

    <script>
    export default {}
    </script>

Because our component does not need scripting logic, we leave it empty.

Next create another file, resources/assets/js/views/App.vue. This will be the application 
container and all other components will be loaded into this container using the vue-router. In this file, add the following code:

    <template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <router-link :to="{name: 'home'}" class="navbar-brand">Treclon</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-link"> Hi, There</li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                <router-view></router-view>
            </main>
        </div>
    </template>

As we said earlier, the template tag holds the HTML for our component. However, we used some Vue specific tags in the code above like router-link, which helps us generate links for routing to pages defined in our router. We also have the router-view, which is where all the child component pages will be loaded.

Since we don’t need scripting on this page also, append the following to the file:

    <script>
    export default {}
    </script>

Now, build the Vue application with the command below:

    $ npm run dev

This will compile all our js assets and put them inside the public/js folder. To test the application and see what we have been able to achieve, run the php artisan serve command as we have done before.

    $ php artisan serve

When you visit the page you should see something like this:


Authentication

As with most web applications, authentication is important. We had, in the previous parts, discussed authentication and set up endpoints for authenticating users. In the next and final part, we will see how to protect pages we do not want unauthenticated users to see and how to make authenticated requests to the API.

Conclusion

In this chapter, we have looked at the basics of building a simple standalone application with vue-cli and also how we can build same using the built-in Laravel integration. In , we will continue building our Treclon app and see how everything ties in together.

In previous chapters of this series, we considered a couple of concepts useful for developing modern web applications with Laravel and Vue. In this final part, we are going to combine all the concepts from the previous parts into building a Trello clone using Laravel and Vue.

Here is a screen recording of what the application will look like when complete: 

Prerequisites

To follow along in this part of the series you must:

Have read part all previous parts of the series.
Have all the requirements from previous parts of the series.
When you have all the requirements, we can continue.

Setting up for development

We have already discussed setting up your environment in previous parts of this series so if you need help please read the previous parts. If you have also been following up with the other parts, you should have already set up a Laravel project.

If you have not set up a project, then you should go back to the previous parts and read them as they give a detailed guide on how to set all set up for this part of the series.

Creating API routes

In one of the earlier chapters, we spoke about creating RESTful APIs, so the techniques mentioned there will be applied here. Let’s create the endpoints for the API of our Trello clone.

In our routes/api.php file, make sure the file contains the following code:

    <?php

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/category/{category}/tasks', 'CategoryController@tasks');    
        Route::resource('/category', 'CategoryController');
        Route::resource('/task', 'TaskController');
    });


💡 As a good practice, when creating routes, always put more specific routes ahead of less specific ones. For instance, in the code above the /category/{category}/tasks route is above the less specific /category route.


In the code above, we defined our API routes. Putting the definitions in the routes/api.php file will tell Laravel that the routes are API routes. Laravel will prefix the routes with a /api in the URL to differentiate these routes from web routes.

Also in the Route group above, we added a middleware auth:api, this makes sure that any calls to the routes in that group must be authenticated.

A thing to note is, using the resource method on the Route class helps us create some additional routes under the hood. Here is a summary of all the routes available when we added the code above to the file:

Routes for the category resource
Routes for the task resource
Routes for the user resource

💡 To see the full route list, run the following command: $ php artisan route:list.


Now that we have a clear understanding of our routes, let’s see how the controllers will work.

Creating the controller logic

We are going to take a deeper look at the implementation of our different controllers now.

User controller
Since we already created and fully implemented this in the second part of the series, we can skip that and move on to the next controller.

Category controller
Next, open the CategoryController and replace the contents with the following code:

    <?php

    namespace App\Http\Controllers;

    use App\Category;
    use Illuminate\Http\Request;

    class CategoryController extends Controller
    {
        public function index()
        {
            return response()->json(Category::all()->toArray());
        }

        public function store(Request $request)
        {
            $category = Category::create($request->only('name'));

            return response()->json([
                'status' => (bool) $category,
                'message'=> $category ? 'Category Created' : 'Error Creating Category'
            ]);
        }

        public function show(Category $category)
        {
            return response()->json($category);
        }

        public function tasks(Category $category)
        {
            return response()->json($category->tasks()->orderBy('order')->get());
        }

        public function update(Request $request, Category $category)
        {
            $status = $category->update($request->only('name'));

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Category Updated!' : 'Error Updating Category'      
            ]);
        }

        public function destroy(Category $category)
        {
            $status  = $category->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Category Deleted' : 'Error Deleting Category'
            ]);
        }

    }

The functions in the controller above handle the basic CRUD operations for the resource. The tasks methods returns tasks associated with a category.

Task controller
Next, open the TaskController. In this controller, we will manage tasks. A task is given an order value and is linked to a category. Replace the contents with the following code:

    <?php

    namespace App\Http\Controllers;

    use App\Task;
    use Illuminate\Http\Request;

    class TaskController extends Controller
    {
        public function index()
        {
            return response()->json(Task::all()->toArray());
        }

        public function store(Request $request)
        {
            $task = Task::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
                'order' => $request->order
            ]);

            return response()->json([
                'status' => (bool) $task,
                'data'   => $task,
                'message' => $task ? 'Task Created!' : 'Error Creating Task'
            ]);
        }

        public function show(Task $task)
        {   
           return response()->json($task); 
        }

        public function update(Request $request, Task $task)
        {
            $status = $task->update(
                $request->only(['name', 'category_id', 'user_id', 'order'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Task Updated!' : 'Error Updating Task'
            ]);
        }

        public function destroy(Task $task)
        {
            $status = $task->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Task Deleted!' : 'Error Deleting Task'
            ]);
        }

    }

That’s all for the controllers. Since we have already created the models in a previous chapter, let’s move on to creating the frontend.

Building the frontend

Since we are done building the backend, let’s make the frontend using VueJS. To work with Vue, we will need the Vue and Vue router packages we installed in a previous chapter. We will also need the [vuedraggable](https://github.com/SortableJS/Vue.Draggable) package. To install it, run the command below:

    $ npm install vuedraggable --save

Creating the Vue router routes
Since we are building a Single Page App, we are going to setup our vue-router to handle switching between the different pages of our application. Open the resources/assets/js/app.js file and replace the contents with the following code:

    import Vue          from 'vue'
    import VueRouter    from 'vue-router'

    Vue.use(VueRouter)

    import App          from './views/App'
    import Dashboard    from './views/Board'
    import Login        from './views/Login'
    import Register     from './views/Register'
    import Home         from './views/Welcome'

    const router = new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/',
                name: 'home',
                component: Home
            },
            {
                path: '/login',
                name: 'login',
                component: Login,
            },
            {
                path: '/register',
                name: 'register',
                component: Register,
            },
            {
                path: '/board',
                name: 'board',
                component: Dashboard,
            },
        ],
    });

    const app = new Vue({
        el: '#app',
        components: { App },
        router,
    });

Next, open the routes/web.php file and replace the contents with the code below:

    <?php

    Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

This will route incoming traffic to the index method of our SinglePageController which we created in the previous chapter.

Dealing with authentication
Since our API is secure we’d need access tokens to make calls to it. Tokens are generated and issued when we successfully log in or register. We are going to use localStorage to hold the token generated by our application so we can very easily get it when we need to make API calls.


⚠️ Although this is out of the scope of the article it may be worth knowing that contents in local storage are readable from the browser so you might want to make sure your tokens are short-lived and refreshed often.


Let’s set up register component. Create the file resources/assets/js/views/Register.vue and add the following for the template:

    <template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">Register</div>

                        <div class="card-body">
                            <form method="POST" action="/register">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" v-model="email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" v-model="password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

Then for the script, add the following in the same file below the closing template tag:

    <script>
        export default {
            data(){
                return {
                    name : "",
                    email : "",
                    password : "",
                    password_confirmation : ""
                }
            },
            methods : {
                handleSubmit(e) {
                    e.preventDefault()

                    if (this.password === this.password_confirmation && this.password.length > 0)
                    {
                        axios.post('api/register', {
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            c_password : this.password_confirmation
                          })
                          .then(response => {
                            localStorage.setItem('user',response.data.success.name)
                            localStorage.setItem('jwt',response.data.success.token)

                            if (localStorage.getItem('jwt') != null){
                                this.$router.go('/board')
                            }
                          })
                          .catch(error => {
                            console.error(error);
                          });
                    } else {
                        this.password = ""
                        this.passwordConfirm = ""

                        return alert('Passwords do not match')
                    }
                }
            },
            beforeRouteEnter (to, from, next) { 
                if (localStorage.getItem('jwt')) {
                    return next('board');
                }

                next();
            }
        }
    </script>

In the code above, we have a handleSubmit method that is called when a user submits the registration form. It sends all the form data to the API, takes the response and saves the jwt to localStorage.

We also have a beforeRouterEnter method which is called by the vue-router before loading a component. In this callback, we check if the user is already logged in and redirect to the application’s board if the user is.

The login component is setup in a similar manner. Create the file resources/assets/js/views/Login.vue and add the following for the template:

    <template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">Login</div>

                        <div class="card-body">
                            <form method="POST" action="/login">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" v-model="password" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

And for the script, add the following code to the file below the closing template tag:

    <script>
        export default {
            data(){
                return {
                    email : "",
                    password : ""
                }
            },
            methods : {
                handleSubmit(e){
                    e.preventDefault()

                    if (this.password.length > 0) {
                        axios.post('api/login', {
                            email: this.email,
                            password: this.password
                          })
                          .then(response => {
                            localStorage.setItem('user',response.data.success.name)
                            localStorage.setItem('jwt',response.data.success.token)

                            if (localStorage.getItem('jwt') != null){
                                this.$router.go('/board')
                            }
                          })
                          .catch(function (error) {
                            console.error(error);
                          });
                    }
                }
            },
            beforeRouteEnter (to, from, next) { 
                if (localStorage.getItem('jwt')) {
                    return next('board');
                }

                next();
            }
        }
    </script>

That’s all for the Login component.

We need to make a little modification to our application wrapper component. Open the file resources/assets/js/views/App.vue file and update the file with the following code in the template section:

    [...]

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
        <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
        <li class="nav-link" v-if="isLoggedIn"> Hi, {{name}}</li>
        <router-link :to="{ name: 'board' }" class="nav-link" v-if="isLoggedIn">Board</router-link>
    </ul>

    [...]

Also replace the contents of the script tag in the same file with the following:

    export default {
        data(){
            return {
                isLoggedIn : null,
                name : null
            }
        },
        mounted(){
            this.isLoggedIn = localStorage.getItem('jwt')
            this.name = localStorage.getItem('user')
        }
    }

In the code above, we do a check to see if the user is logged in or not and then use this knowledge to can hide or show route links.

Making secure API calls
Next, let’s create the main application board and consume the meat of the API from there. Create a resources/assets/js/views/Board.vue file add the following code to the file:

    <template>
        <div class="container">
            <div class="row justify-content-center">
                <draggable element="div" class="col-md-12" v-model="categories" :options="dragOptions">
                    <transition-group class="row">
                        <div class="col-md-4" v-for="element,index in categories" :key="element.id">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{element.name}}</h4>
                                </div>
                                <div class="card-body card-body-dark">
                                    <draggable :options="dragOptions" element="div" @end="changeOrder" v-model="element.tasks">
                                        <transition-group :id="element.id">
                                            <div v-for="task,index in element.tasks" :key="task.category_id+','+task.order" class="transit-1" :id="task.id">
                                                <div class="small-card">
                                                    <textarea v-if="task === editingTask" class="text-input" @keyup.enter="endEditing(task)" @blur="endEditing(task)" v-model="task.name"></textarea>
                                                    <label for="checkbox" v-if="task !== editingTask" @dblclick="editTask(task)">{{ task.name }}</label>
                                                </div>
                                            </div>
                                        </transition-group>
                                    </draggable>
                                    <div class="small-card">
                                        <h5 class="text-center" @click="addNew(index)">Add new card</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition-group>
                </draggable>
            </div>
        </div>
    </template>

In the template above we have implemented the [vue-draggable](https://github.com/SortableJS/Vue.Draggable) component we installed earlier. This gives us a draggable div that we can use to mimic how Trello cards can be moved from one board to another. In the draggable tag we passed some options which we will define in the script section of the component soon.

To ensure we can drag across multiple lists using vue draggable, we had to bind our categories attribute to the parent draggable component. The most important part is binding the element.tasks to the child draggable component as a prop using v-model. If we fail to bind this, we would not be able to move items across the various categories we have.

We also define a method to be called when the dragging of an item is done (@end), when we click to edit an item or when we click the Add New Card.

For our style add the following after the closing template tag:

    <style scoped>
    .card {
        border:0;
        border-radius: 0.5rem;
    }
    .transit-1 {
        transition: all 1s;
    }
    .small-card {
        padding: 1rem;
        background: #f5f8fa;
        margin-bottom: 5px;
        border-radius: .25rem;
    }
    .card-body-dark{
        background-color: #ccc;
    }
    textarea {
        overflow: visible;
        outline: 1px dashed black;
        border: 0;
        padding: 6px 0 2px 8px;
        width: 100%;
        height: 100%;
        resize: none;
    }
    </style>

Right after the code above, add the following code:

    <script>
        import draggable from 'vuedraggable'
        export default {
            components: {
                draggable
            },
            data(){
                return {
                    categories : [],
                    editingTask : null
                }
            },
            methods : {
                addNew(id) {
                },
                loadTasks() {
                },
                changeOrder(data){
                },
                endEditing(task) {
                },
                editTask(task){
                    this.editingTask = task
                }
            },
            mounted(){
            },
            computed: {
                dragOptions () {
                  return  {
                    animation: 1,
                    group: 'description',
                    ghostClass: 'ghost'
                  };
                },
            },
            beforeRouteEnter (to, from, next) { 
                if ( ! localStorage.getItem('jwt')) {
                    return next('login')
                }

                next()
            }
    }
    </script>

Loading our categories
Next, let’s load our categories as we mount the Board component. Update the mounted method of the same file to have the following:

    mounted() {
        let token = localStorage.getItem('jwt')

        axios.defaults.headers.common['Content-Type'] = 'application/json'
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

        axios.get('api/category').then(response => {
            response.data.forEach((data) => {
                this.categories.push({
                    id : data.id,
                    name : data.name,
                    tasks : []
                })
            })
            this.loadTasks()
        })
    },

In the code above, we set up axios. This is very important because vue will call the mounted method first before the page loads, so it is a convenient way to actually load data we need to use on our page.


💡 We set up some default axios headers so we no longer need to pass the headers for each call we make.


Loading our tasks
Next, let’s add the logic to load the tasks from a category. In the methods object of the Board component, update the loadTasks method to the following code:

    [...]

    loadTasks() {
      this.categories.map(category => {
          axios.get(`api/category/${category.id}/tasks`).then(response => {
              category.tasks = response.data
          })
      })
    },

    [...]

Adding new tasks
Let’s add the logic to add new tasks. In the methods object of the Board component, update the addNew method to the following:

    [...]

    addNew(id) {
        let user_id = 1
        let name = "New task"
        let category_id = this.categories[id].id
        let order = this.categories[id].tasks.length

        axios.post('api/task', {user_id, name, order, category_id}).then(response => {
            this.categories[id].tasks.push(response.data.data)
        })
    },

    [...]

When the addNew method is called the id of the category is passed in, which helps us determine where the new task should be added. We create the task for that category and pass in a dummy text as a placeholder so the user can see it come up.

Editing tasks
Let’s add the logic to edit tasks. In the methods object of the Board component, update the endEditing method to the following:

    [...]

    endEditing(task) {
        this.editingTask = null

        axios.patch(`api/task/${task.id}`, {name: task.name}).then(response => {
            // You can do anything you wan't here.
        })
    },

    [...]

When a task is edited, we pass it to the endEditing method which sends it over to the API.

Reordering tasks
Let’s add the logic to reorder tasks. In the methods object of the Board component, update the changeOrder method to the following:

    [...]

    changeOrder(data) {
        let toTask = data.to
        let fromTask = data.from
        let task_id = data.item.id
        let category_id = fromTask.id == toTask.id ? null : toTask.id
        let order = data.newIndex == data.oldIndex ? false : data.newIndex

        if (order !== false) {
            axios.patch(`api/task/${task_id}`, {order, category_id}).then(response => {
                // Do anything you want here
            });
        }
    },

    [...]

Draggable returns an object when you drop an element you dragged. The returned object contains information of where the element was moved from and where it was dropped. We use this object to determine which category a task was moved from.


💡 If you go over the draggable component again, you’d notice we bound :id when we were rendering categories. This is the same id referenced above.


Build the application

The next thing we need to do is build the assets. Run the command below to build the application:

    $ npm run prod


💡 Using prod will optimize the build. Recommended especially when you want to build for production. The other value available here is dev which is used during the development process


When the build is complete, we can now run the application:

    $ php artisan serve

Conclusion

In this series, we have seen how to build a simple Trello clone and in the process explained some key concepts you need to know when building modern web applications using Laravel and Vue.

Here’s a link to the source code.