<script setup>
import {onMounted, ref,} from 'vue';

defineProps(['modelValue', 'type', 'id', 'classes']);


defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <div class="relative mb-4 mt-2 flex flex-wrap items-stretch">

        <span v-if="$slots.prepend"
              class="flex bg-gray-100  text-gray-500 items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-300  text-center text-base font-normal leading-[1.6]   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
              id="basic-addon1">
            <slot name="prepend"></slot>
        </span>
        <input
            :id="id"
            :type="type"
            :class="classes +( $slots.append && $slots.prepend ? ' rounded-0 ':$slots.append? ' rounded-s ':$slots.prepend?' rounded-e ':' rounded ')"
            class="  flex-auto border border-solid border-neutral-300    px-3   text-neutral-700   transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700   dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            @visibility.window="$el.type = ($el.type == 'password') ? 'text' : 'password' "
            ref="input"/>

        <span v-if="$slots.append"
              class="flex bg-gray-100 items-center whitespace-nowrap rounded-e border border-s-0 border-solid border-neutral-300 px-3 py-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
              id="basic-addon1">
            <slot name="append"></slot>
        </span>
    </div>
</template>
