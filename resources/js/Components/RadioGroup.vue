<template>
    <div class="    flex justify-center my-3    rounded-lg bg-gray-200  ">
        <div v-for="item,idx in items" class="   grow justify-center   ">
            <input :checked="item==selected||null" v-model="selected" type="radio" :name="name" :id="item"
                   :value="item"
                   class="peer hidden"/>
            <label :for="item" :class="idx==0? 'rounded-s-lg' : idx==items.length-1? 'rounded-e-lg':'rounded-0'"
                   class="duration-300 transition-all     flex justify-center text-center cursor-pointer select-none   p-2  peer-checked:bg-primary-500 peer-checked:font-bold peer-checked:text-white">
                {{ __(item) }}
            </label>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            selected: this.items[0]
        }
    },
    props: ['name', 'items'],
}
</script>
