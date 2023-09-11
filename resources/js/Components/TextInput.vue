<script setup>
import {onMounted, ref,} from 'vue';
import {initTE, Input} from "tw-elements";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

defineProps(['modelValue', 'type', 'id', 'classes', 'verified', 'placeholder', 'error', 'multiline']);


defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }

});

defineExpose({focus: () => input.value.focus()});

const focusNext = (elem) => {
  if (!elem || !elem.form) return;
  const currentIndex = Array.from(elem.form.elements).indexOf(elem);
  elem.form.elements.item(
      currentIndex < elem.form.elements.length - 1 ?
          currentIndex + 1 :
          0
  ).focus();
}
</script>

<template>
  <div>
    <div class="flex items-center">
      <InputLabel :for="id" :value="placeholder"/>
      <span v-if="verified==0" class="text-danger text-xs mx-1">({{ __('not_verified') }})</span>
      <span v-else-if="verified==1" class="text-success text-xs mx-1">({{ __('verified') }})</span>
    </div>
    <div class="relative mb-1 mt-2 flex flex-wrap items-stretch">


        <span v-if="$slots.prepend"
              class="flex bg-gray-100  text-gray-500 items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-300  text-center text-base font-normal leading-[1.6]   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
              id="basic-addon1">
            <slot name="prepend"></slot>
        </span>
      <input v-if="!multiline"
             @keydown.enter.prevent="focusNext($event.target)"
             :id="id"
             :type="type"
             :class="classes +( $slots.append && $slots.prepend ? ' rounded-0 ':$slots.append? ' rounded-s ':$slots.prepend?' rounded-e ':' rounded ')"
             class="  flex-auto border border-solid border-neutral-300    px-3   text-neutral-700   transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
             :value="modelValue"
             @input="$emit('update:modelValue', $event.target.value)"
             @visibility.window="$el.type = ($el.type == 'password') ? 'text' : 'password' "
             ref="input"/>
      <textarea v-else
                rows="5"
                :id="id"
                :class="classes +( $slots.append && $slots.prepend ? ' rounded-0 ':$slots.append? ' rounded-s ':$slots.prepend?' rounded-e ':' rounded ')"
                class="  flex-auto border border-solid border-neutral-300    px-3   text-neutral-700   transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                ref="input"></textarea>

      <span v-if="$slots.append"
            class="flex bg-gray-100 items-center whitespace-nowrap rounded-e border border-s-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
            id="basic-addon2">
            <slot name="append"></slot>
        </span>
    </div>
    <InputError class="mt-1" :message="error"/>
  </div>

</template>
