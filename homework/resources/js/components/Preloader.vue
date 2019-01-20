<template>
    <div id="preloader_mask" v-if="loading">
        <div class="progress">
            <div class="indeterminate"></div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    name: 'Preloader',
    computed: {
        ...mapState({
            loading: state => state.loading
        })
    }
}
</script>
<style scoped lang="scss">
    #preloader_mask {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255, 0.5);
        z-index: 99;
        .progress {
            margin: 0;
            background-color: #60bcf3;
            .indeterminate {
                background-color: #02579b;
            }
        }
    }
</style>