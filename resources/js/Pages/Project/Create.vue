<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {UserIcon, EyeIcon, EyeSlashIcon, KeyIcon, Bars2Icon} from "@heroicons/vue/24/outline";
import {ref} from 'vue'
import PhoneFields from "@/Components/PhoneFields.vue";

defineProps({
  canResetPassword: Boolean,
  status: String,
});
let showPassword = ref(false);
const form = useForm({
  fullname: null,
  password: null,
  password_confirmation: null,
  phone: null,
  phone_verify: null,
  cmnd: 'register',
  accesses: [],
});

const submit = () => {

  form.clearErrors();
  form.post(route('register'), {
    onFinish: () => (!form.errors) ? form.reset('password') : null,
  });
};
</script>

<template>
  <GuestLayout :dir="dir()"

               aria-expanded="false"
  >
    <Head :title="__('signin')"/>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">


      <div class="my-2">
        <TextInput
            id="fullname"
            type="text"
            :placeholder="__('fullname')"
            classes="  "
            v-model="form.fullname"
            autocomplete="fullname"
            :error="form.errors.fullname"
        >
          <template v-slot:prepend>
            <div class="p-3">
              <Bars2Icon class="h-5 w-5"/>
            </div>
          </template>

        </TextInput>
      </div>
      <div class="my-2">
        <PhoneFields
            v-model:phone="form.phone"
            v-model:phone-verify="form.phone_verify"
            :phone-error="form.errors.phone"
            for="users"
            :disable="false"
            :phone-verify-error="form.errors.phone_verify"
        />
      </div>

      <div class="mt-4">
        <InputLabel for="password" :value="__('password')"/>

        <TextInput
            id="password"
            :type="showPassword?'text':'password'"
            classes=" "
            v-model="form.password"
            required
            :error="form.errors.password"
            autocomplete="current-password">

          <template v-slot:prepend>
            <div class="p-3" @click="showPassword=!showPassword">
              <EyeIcon v-if="!showPassword"
                       class="h-5 w-5   "/>
              <EyeSlashIcon v-else class="h-5 w-5 "/>
            </div>
          </template>
        </TextInput>

      </div>
      <div class="my-2">
        <TextInput
            id="new_password_confirmation"
            :type="showPassword?'text':'password'"
            :placeholder="__('confirm_password')"
            classes="  "
            v-model="form.password_confirmation"
            :autocomplete="form.password_confirmation"
            :error="form.errors.password_confirmation"
        >
          <template v-slot:prepend>
            <div class="p-3" @click="showPassword=!showPassword">
              <EyeIcon v-if="!showPassword"
                       class="h-5 w-5   "/>
              <EyeSlashIcon v-else class="h-5 w-5 "/>
            </div>
          </template>

        </TextInput>

      </div>

      <div class="my-4 border rounded-lg">
        <div class="p-2 border-b">{{ __('select_jobs_if_need') }}</div>
        <div v-for="(access,idx) in $page.props.accesses" class="inline-flex items-center">
          <label
              class="relative flex items-center    p-3 rounded-full cursor-pointer "
              :for="`access${idx}`"
              data-ripple-dark="true"
          >
            <input :value="access.role" v-model="form.accesses"
                   :checked="form.accesses.indexOf(access.role)>-1"
                   :id="`access${idx}`"
                   type="checkbox"
                   class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-primary-500 checked:bg-primary-500 checked:before:bg-primary-500 hover:before:opacity-10"
            />
            <div
                class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-3.5 w-3.5"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  stroke="currentColor"
                  stroke-width="1"
              >
                <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                ></path>
              </svg>
            </div>
          </label>
          <label
              class="mt-px font-light text-sm text-gray-500 cursor-pointer select-none"
              :for="`access${idx}`"
          >
            {{ __(access.name) }}
          </label>
        </div>
        <InputError class="mt-1" :message="form.errors.accesses"/>
      </div>


      <div class="    mt-4">

        <PrimaryButton class="w-full    " :class="{ 'opacity-25': form.processing }"
                       :disabled="form.processing">
          <span class=" text-lg w-full">  {{ __('register') }}</span>
        </PrimaryButton>

      </div>
      <div class="w-full mt-5">
        <span>{{ __('register_before?') }}</span>
        <Link
            :href="route('login')"
            class="underline mx-2 text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          {{ __('signin') }}
        </Link>
      </div>
    </form>
  </GuestLayout>
</template>
