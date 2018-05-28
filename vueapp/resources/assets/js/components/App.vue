<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <ul class="navbar-nav">
                    <!--The <router-link> is responsible for navigating between components.-->
                    <router-link :to="{name: 'welcome'}" class="nav-link">Home</router-link>
                    <router-link :to="{name: 'page'}" class="nav-link">SPA-page</router-link>
                </ul>
            </div>
        </nav>
        <main>
            <!--Vue will use <router-view> as the outlet for any component we visit as its URL.-->
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    export default {}
</script>