<template>
  <Header/>
  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full lg:w-1/2 px-4 mb-8">
        <img alt="Product Image" class="w-full rounded-lg shadow-md" src="https://via.placeholder.com/400">
      </div>
      <div class="w-full lg:w-1/2 px-4 mb-8 text-right">
        <h2 class="text-3xl font-semibold mb-4">{{ product.name }}</h2>
        <p class="text-gray-700 mb-4">{{ product.description }}</p>
        <Form/>
        <div class="flex items-center mb-4">
          <span class="text-lg font-semibold text-gray-800 mr-4">Price:</span>
          <span class="text-xl font-bold text-blue-600">${{ product.price }}</span>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import Header from "../header.vue";
import Form from "../FromAddress.vue";

export default {
  components: {Form, Header},
  data() {
    return {
      product: {
        name: 'محصول نمونه',
        description: 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.',
        price: 49.99
      }
    };
  }
}
</script>

<style>
/* Add custom styles here if needed */
</style>
