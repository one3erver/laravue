<template>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform hover:scale-105 relative w-52" v-for="product in products">
      <img alt="Placeholder Image" class="w-full" :src="product.image">
      <div
          class="absolute inset-0 bg-black opacity-0 hover:opacity-75 transition-opacity flex items-center justify-center mb-20">
        <p class="text-white text-lg">product.name</p>
      </div>
      <div class="p-4">
        <h3 class="text-lg font-semibold">{{ product.name }}</h3>
        <p class="text-sm">{{ product.description }}</p>
      </div>
    </div>
</template>

<script>
export default {
  props: {
    products:Array,
    index: {
      type: Number,
      required: true,
    },
  },
  computed: {
    title() {
      return `کارت ${this.index}`;
    },
    description() {
      return `توضیحات کارت ${this.index}.`;
    },
  },
};
</script>

<style scoped>
div {
  direction: rtl;
}
</style>
