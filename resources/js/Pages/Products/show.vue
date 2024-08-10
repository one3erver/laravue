<template>
    <div>
        <ul>
                {{ product.title }} - ${{ product.price }}
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        product: Array,
    },
}
</script>
