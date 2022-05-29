<template>
    <div class="wp-miusage-nav">
        <router-link to="/" class="miusage-nav-tab">{{ __( 'Table', 'wp-miusage' ) }}</router-link>
        <router-link to="/graph" class="miusage-nav-tab">{{ __( 'Graph', 'wp-miusage' ) }}</router-link>
        <router-link to="/settings" class="miusage-nav-tab">{{ __( 'Settings', 'wp-miusage' ) }}</router-link>
    </div>
</template>

<script>
export default {
    name: 'NavBar',
}
</script>