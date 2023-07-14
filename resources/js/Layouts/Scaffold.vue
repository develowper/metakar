<template>
    <header :dir="dir()">
        <Navbar/>
    </header>
    <main :dir="dir()" class="min-h-screen ">
        <Head>
            <slot name="header"/>

        </head>
        <slot/>
    </main>
    <Footer/>

    <!--Footer-->
</template>

<script>
import {Head, Link} from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";

export default {
    components: {
        Head, Link, Navbar, Footer
    },
    mounted() {
        window.tailwindElements();
    }
}
</script>
