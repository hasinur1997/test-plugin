<template>
    <div class="main">
        <div id="overlay" v-if="loading">
            <div class="loader"></div>
        </div>
        <nav-bar></nav-bar>
        <router-view></router-view>

    </div>
</template>

<script>
import NavBar from './components/NavBar.vue';
import { mapGetters } from 'vuex';

export default {
    name: 'App',
    components: {
        NavBar,
    },

    /**
     * Computed properties.
     */
    computed: {
        ...mapGetters([
            'loading'
        ])
    }
}
</script>

<style>
    #overlay {
        position: fixed;
        display: block;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 2;
        cursor: pointer;
    }

    .loader {
        border: 7px solid #f3f3f3;
        border-top: 7px solid rgb(57, 55, 55);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;

        position: absolute;
        top: 40%;
        left: 50%;
        font-size: 50px;
        color: white;
        transform: translate(-40%,-50%);
        -ms-transform: translate(-40%,-40%);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>