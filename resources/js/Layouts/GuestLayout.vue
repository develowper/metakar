<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link} from '@inertiajs/vue3';
</script>

<template>
  <div class="px-2 min-h-screen flex flex-col sm:justify-center items-center   pt-2 bg-gray-100">
    <div>
      <Link href="/">
        <ApplicationLogo type="outline-dark" class="w-20 h-20 fill-current text-gray-500"/>
      </Link>
    </div>

    <div
        class="w-full sm:max-w-md    mt-6 px-6 py-4 bg-white shadow-md overflow-hidden  rounded-lg"
    >
      <slot/>
    </div>
  </div>
</template>
