<template>

    <Panel>
        <template v-slot:header>
            <title>{{__('panel')}}</title>
        </template>


        <template v-slot:content>
            <!-- Content header -->
            <div
                class="flex items-center justify-between px-4 py-4 text-primary-500 border-b lg:py-6 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">{{ __('new_site') }}</h1>

            </div>

            <!-- Content -->
            <div class="mt-2">

            </div>
        </template>


    </Panel>
</template>

<script>
import Scaffold from "@/Layouts/Scaffold.vue";
import Panel from "@/Layouts/Panel.vue";
import {Head, Link} from "@inertiajs/vue3";
import {ChevronDownIcon, HomeIcon} from "@heroicons/vue/24/outline";

export default {
    components: {
        Head, Link, HomeIcon, ChevronDownIcon, Panel
    },
    mounted() {

    }

}
</script>
