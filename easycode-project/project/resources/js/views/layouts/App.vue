<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <router-link class="navbar-brand text-white" to="/">Test Task</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
<!--                <div class="collapse navbar-collapse" id="navbarNav">-->
<!--                    <ul class="navbar-nav">-->
<!--                        -->
<!--                    </ul>-->
<!--                </div>-->
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container my-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>

</script>
