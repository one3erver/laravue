<template>
  <header class="relative overflow-hidden bg-cover bg-center bg-black opacity-76 mb-8">
    <div class="absolute inset-0 bg-black opacity-75 bg-center blur-sm " :style="{ 'background-image': 'url(' + $page.props.data.image + ')' } "></div>
    <div class="absolute inset-0 flex items-center justify-center">
      <div class="text-center">
        <h1 class="text-6xl transition ease-in-out delay-150 hover:scale-110 text-white pb-9 text-stone-100	">{{ $page.props.data.name }}</h1>
        <p class="text-lg transition ease-in-out delay-150 hover:scale-110 text-white text-stone-100">{{ $page.props.data.body }}</p>
      </div>
    </div>
  </header>

</template>

<script>
export default {
  data() {
    return {
      imageUrl: 'https://academy.one3erver.com/wp-content/uploads/2023/09/50-Off.jpg', // Replace with your image URL
      title: 'تایتل',
      description: 'شهاب‌الدین ابو عبدالله یاقوت بن عبدالله الحموی که به نام یاقوت حَمَوی شهرت دارد، جغرافی‌دان و تاریخ‌نویس عرب‌زبانِ یونانی‌تبار قرن ششم و هفتم قمری است.',
    };
  },
};
</script>

<style scoped>
header {
  height: 250px; /* Adjust the height as needed */
  transition: transform 0.3s ease;
}

</style>
