<template>
    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                Predictor League
            </a>

            <div>
                <!-- Right Side Of Navbar -->
                <ul v-if="user.name == 'Guest'" class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
                <ul v-else class="navbar-nav ml-auto">
                    <li v-if="user.email == 'ryan@x4iiiis.com'" class="nav-item">
                        <a class="nav-link" href="/backend">Backend</a>
                    </li>
                    
                    <div class="dropdown show">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ user.name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" @click="$emit('account')" >My Account</a>
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    props: [ 'user' ],
}
</script>