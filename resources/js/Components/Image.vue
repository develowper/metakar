<template>

    <img :src="src" :alt="alt" :class="classes+(loading?' animate-pulse bg-gray-200 ':' ')"
         @load="loading=!loading"
         @error="imageError ">
</template>

<script>
import {UserIcon} from "@heroicons/vue/24/outline";

let self;

export default {
    data() {
        return {
            loading: true,
            retry: 1,
        }
    },
    components: {UserIcon},
    mounted() {
        self = this;
    },
    watch: {
        loading() {

        }
    },
    props: ['type', 'src', 'alt', 'classes'],
    methods: {
        imageError: (e) => {

            self.loading = false;
            if (self.retry < 0) return;
            self.loading = true;
            if (self.type == 'user')
                e.target.src = "/assets/images/def-user.png";
            else
                e.target.src = "/assets/images/noimage.png";
            self.retry--;
        }
    }
}
</script>
