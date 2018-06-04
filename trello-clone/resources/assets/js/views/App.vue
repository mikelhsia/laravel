<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <router-link :to="{name: 'home'}" class="navbar-brand">Treclon</router-link>
                <button class="navbar-toggler" type="button"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left side of navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right side of navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <router-link class="nav-link" :to="{name: 'login'}" v-if="!isLoggedIn">Login</router-link>
                        <router-link class="nav-link" :to="{name: 'register'}" v-if="!isLoggedIn">Register</router-link>
                        <li class="nav-link" v-if="isLoggedIn">Hi, {{name}}</li>
                        <router-link class="nav-link" :to="{name: 'board'}" v-if="isLoggedIn">Board</router-link>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                isLoggedIn: null,
                name: null,
            };
        },
        mounted () {
            this.isLoggedIn = localStorage.getItem('jwt');
            this.name = localStorage.getItem('user');
        }
    };
</script>