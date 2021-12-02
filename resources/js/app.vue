<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <router-link to="/home"  class="nav-item nav-link">home</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'ProductIndex' }"  class="nav-item nav-link">Products</router-link>
                </li>
                </ul>
            </div>
        </nav>
        <router-view> </router-view>
    </div>
</template>

<script>
    export default {}
</script>