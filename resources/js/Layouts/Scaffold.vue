<template>
  <header :dir="dir()">
    <Navbar :theme="navbarTheme"/>
  </header>
  <main :dir="dir()" class="min-h-screen ">
    <Head>
      <meta name="author" :content="__('app_name')">

      <slot name="header"/>
    </head>
    <Alert v-show="$page.props.flash.status" ref="alert"/>
    <Dialog ref="modal"/>
    <Toast ref="toast"/>
    <!-- Loading screen -->
    <div v-if="loading" class="  fixed w-screen h-screen backdrop-blur-sm     z-[999999]">

      <div class="flex items-center justify-center  w-full h-full  ">
        <div class="flex justify-center items-center space-x-1 text-sm text-gray-700">
          <LoadingIcon type="line-dot" class=" fill-primary"/>

        </div>
      </div>
    </div>
    <slot/>
  </main>
  <Footer/>

  <!--Footer-->
</template>

<script>
import {Head, Link} from '@inertiajs/vue3';
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import Toast from "@/Components/Toast.vue";
import Dialog from "@/Components/Dialog.vue";
import Alert from "@/Components/Alert.vue";
import LoadingIcon from "@/Components/LoadingIcon.vue";
import mitt from 'mitt'

export const emitter = mitt()
export default {
  data() {
    return {
      loading: false,
    }
  },
  props: ['navbarTheme'],
  components: {
    Head, Link, Navbar, Footer, Alert, Dialog, Toast, LoadingIcon,
  },
  mounted() {
    window.tailwindElements();
    this.emitter.on('showToast', (e) => {
      if (this.$refs.toast)
        this.$refs.toast.show(e.type, e.message);
    });

    this.emitter.on('showAlert', (e) => {
      if (this.$refs.alert)
        this.$refs.alert.show(e.type, e.message);
    });

    this.emitter.on('showDialog', (e) => {

      if (this.$refs.modal)
        this.$refs.modal.show(e.type, e.message);
    });

    this.emitter.on('loading', (e) => {
      this.loading = e;
    });
  }
}
</script>
