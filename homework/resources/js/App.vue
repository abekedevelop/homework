<template>
    <div id="app">
        <!--<preloader/>-->
        <router-view/>
    </div>
</template>
<script>
import 'materialize-css/dist/css/materialize.min.css'
import 'materialize-css/dist/js/materialize.min'
import { mapState } from 'vuex'

//import Preloader from './components/Preloader.vue'
export default {
    components: {
//        Preloader
    }
}
</script>
<style scoped lang="scss"></style>