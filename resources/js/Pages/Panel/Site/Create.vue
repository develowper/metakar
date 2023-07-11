<template>

    <Panel>
        <template v-slot:header>
            <title>{{__('new_site')}}</title>
        </template>


        <template v-slot:content>
            <!-- Content header -->
            <div
                class="flex items-center justify-between px-4 py-2 text-primary-500 border-b md:py-4 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">{{ __('new_site') }}</h1>

            </div>

            <!-- Content -->
            <div class="mt-2 ">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="login" :value="__('email')+ '/'+__('phone')"/>

                        <TextInput
                            id="login"
                            type="text"
                            classes="  "
                            v-model="form.login"
                            required
                            autofocus
                            autocomplete="login">


                            <template v-slot:prepend>
                                <div class="p-3">
                                    <UserIcon class="h-5 w-5"/>
                                </div>
                            </template>

                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.login"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" :value="__('password')"/>

                        <TextInput
                            id="password"
                            :type="showPassword?'text':'password'"
                            classes=" "
                            v-model="form.password"
                            required
                            autocomplete="current-password">

                            <template v-slot:prepend>
                                <div class="p-3" @click="showPassword=!showPassword">
                                    <EyeIcon v-if="!showPassword"
                                             class="h-5 w-5   "/>
                                    <EyeSlashIcon v-else class="h-5 w-5 "/>
                                </div>
                            </template>
                        </TextInput>

                        <InputError class="mt-2" :message="form.errors.password"/>
                    </div>

                    <div class="flex mt-4  items-center  justify-between">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember"/>
                            <span class="m-2 text-sm text-gray-600">{{ __('remember_me') }}</span>
                        </label>
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            {{ __('forgot_my_password') }}
                        </Link>
                    </div>

                    <div class="    mt-4">

                        <PrimaryButton class="w-full    " :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                            <span class=" text-lg w-full">  {{ __('signin') }}</span>
                        </PrimaryButton>

                    </div>
                    <div class="w-full mt-5">
                        <span>{{ __('not_have_account?') }}</span>
                        <Link
                            v-if="canResetPassword"
                            :href="route('register')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            {{ __('signup') }}
                        </Link>
                    </div>
                </form>
            </div>
        </template>


    </Panel>
</template>

<script>
import Scaffold from "@/Layouts/Scaffold.vue";
import Panel from "@/Layouts/Panel/User.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import {ChevronDownIcon, HomeIcon} from "@heroicons/vue/24/outline";
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

export default {

    data() {
        return {
            form: useForm({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
                status: false,

            }),
        }
    },
    components: {
        Head, Link, HomeIcon, ChevronDownIcon, Panel, InputLabel, TextInput, InputError, PrimaryButton
    },
    mounted() {

    },
    methods: {
        submit() {
            form.post(route('site.create'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        }
    },

}
</script>
