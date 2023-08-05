<template>
  <div>
    <div>
      <InputLabel class="my-2" for="phone" :value="__('phone')"/>
      <div class="relative mb-2 mt-2 flex flex-wrap items-stretch">

      <span
          class="flex bg-gray-100  text-gray-500 items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-300  text-center text-base font-normal leading-[1.6]   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
          id="basic-addon1">
             <div class="p-3">
                 <PhoneIcon class="h-5 w-5"/>
            </div>
        </span>
        <input
            :value="phone"
            @input="$emit('update:phone', $event.target.value); "
            class="  flex-auto rounded-e  border border-solid border-neutral-300    px-3   text-neutral-700   transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
            @visibility.window="$el.type =  'text'  "
            ref="input_phone"/>

      </div>

    </div>
    <div>
      <InputLabel class="my-2" for="phone_verify" :value="__('phone_verify')"/>
      <div class="relative mb-2 mt-2 flex flex-wrap items-stretch">

      <span
          class="flex bg-gray-100  text-gray-500 items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-300  text-center text-base font-normal leading-[1.6]   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
          id="basic-addon1">
             <div class="p-3">
                 <PhoneArrowDownLeftIcon class="h-5 w-5"/>
            </div>
        </span>
        <input
            :value="phoneVerify" id="phone_verify"
            @input="$emit('update:phoneVerify', $event.target.value)"
            class="  flex-auto rounded-0   border border-solid border-neutral-300    px-3   text-neutral-700   transition duration-200 ease-in-out focus:z-[3] focus:border-primary-500 focus:text-neutral-700   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
            @visibility.window="$el.type =  'text'  "
            ref="input_phone_verify"/>
        <span @click="!loading && timer>=60 ?sendVerificationCode(phone):null"
              class="flex  cursor-pointer hover:bg-primary-400 bg-primary-500 items-center whitespace-nowrap rounded-e border border-s-0 border-solid border-neutral-300 px-3 py-[0.25rem] focus:border-primary text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
              :class="{ 'opacity-25':loading || timer<60 && timer>0}"
              :disabled="loading || timer<60 && timer>0"
        >
          <LoadingIcon v-if="loading" class="w-4 h-4 mx-3 "/>
          <span v-if="timer<60 && timer>0" class="text-white">{{ timer }}</span>
          <span v-else class="text-white">{{ __('send_verification_code') }}</span>
          <!--            <PaperAirplaneIcon class="h-5 w-5 text-white font-bold "/>-->
        </span>
      </div>

    </div>
  </div>

</template>

<script>
import Scaffold from "@/Layouts/Scaffold.vue";
import Image from "@/Components/Image.vue";
import {Link} from "@inertiajs/vue3";
import {CurrencyDollarIcon, EyeIcon} from "@heroicons/vue/24/outline";
import LoadingIcon from "@/Components/LoadingIcon.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {getCurrentInstance} from 'vue'
import {
  TagIcon,
  CheckIcon,
  PlusIcon,
  XMarkIcon,
  PhoneIcon,
  PaperAirplaneIcon,
  PhoneArrowDownLeftIcon,


} from "@heroicons/vue/24/outline";

export default {
  props: ['phone', 'phoneVerify', 'phoneError', 'phoneVerifyError',],
  emits: ['update:phone', 'update:phoneVerify'],
  data() {
    return {
      loading: false,
      timer: 60,
    }
  },
  components: {
    PhoneArrowDownLeftIcon,
    LoadingIcon,
    PhoneIcon,
    InputLabel,
  },
  created() {
    // this.isLoading(true);
  },
  mounted() {
  },
  methods: {
    sendVerificationCode(phone) {
      this.loading = true;
      window.axios.post(route('sms.send.verification'), {phone: phone, type: 'verification'},)

          .then((response) => {
            if (response.data && response.data.message) {
              this.showToast('success', response.data.message);
            }
            this.startTimer();
          })
          .catch((error) => {
            console.log(error);
            error = this.getErrors(error);

            this.showToast('danger', error);
          })
          .finally(() => {
            // always executed
            this.loading = false;
          });
    },
    startTimer() {
      this.timer = 60;
      const intervalId = setInterval(function () {
        this.timer--;
        if (this.timer <= 0) {
          clearInterval(intervalId);
          this.timer = 60
        }
      }.bind(this), 1000);
    }
  },
}
</script>