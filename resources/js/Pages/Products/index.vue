<template>
    <div>
        <h1>Product List</h1>
        <ul>
            <li v-for="product in products" :key="product.id">
                {{ product.title }} - ${{ product.price }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        products: Array,
    },
}
</script>
