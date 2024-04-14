<template>
  <Head :title="data.title" />
  <Header/>
  <div class="flex justify-center bg-gray-400">
    <div class="grid grid-cols-3 gap-3">
      <Card :products="products"/>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import Card from '../card.vue';
import product from "./Contact.vue";
import Header from "../header.vue";
export default {
    props: ['data','products'],
  components: {
    Header,
    Card,product,Head
  }
};
</script>
