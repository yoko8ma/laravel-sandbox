<template lang="html">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><router-link class="nav-link active" :to="{ name: 'list' }">一覧</router-link></li>
            <li class="nav-item"><router-link class="nav-link active" :to="{ name: 'create' }">新規作成</router-link></li>
        </ul>
    </nav>
</template>