<template>
    <Scaffold>
        <template v-slot:header>
            <title>{{__('podcasts')}}</title>
        </template>


    </Scaffold>
</template>

<script>
import Scaffold from "@/Layouts/Scaffold.vue";

export default {
    components: {Scaffold},
    mounted() {

    }

}
</script>
