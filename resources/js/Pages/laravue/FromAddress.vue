<template>
  <form class="bg-white items-center justify-center">
    <div class="w-full px-3 max-w-md">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <input v-model="form.fullname" type="text" placeholder="نام و نام خوانوادگی" class="focus:border-indigo-700 focus:outline-none
              focus:shadow-outline flex-grow transition duration-200 appearance-none p-2 border-2 border-gray-300
              text-black bg-gray-100 font-normal w-full h-12 text-xs rounded-md shadow-sm"/>
        </div>
          <div class="mb-4">
              <input v-model="form.email" type="text" placeholder="ایمیل" class="focus:border-indigo-700 focus:outline-none
              focus:shadow-outline flex-grow transition duration-200 appearance-none p-2 border-2 border-gray-300
              text-black bg-gray-100 font-normal w-full h-12 text-xs rounded-md shadow-sm"/>
          </div>
        <div class="mb-4">
          <input v-model="form.phone" type="number" placeholder="شماره تلفن" class="focus:border-indigo-700 focus:outline-none
              focus:shadow-outline flex-grow transition duration-200 appearance-none p-2 border-2 border-gray-300
              text-black bg-gray-100 font-normal w-full h-12 text-xs rounded-md shadow-sm"/>
        </div>
        <div class="mb-6">
          <textarea v-model="form.address" type="textarea" placeholder="آدرس" class="text-black bg-gray-100 font-normal w-full
              h-22 text-xs rounded-md shadow-sm focus:border-indigo-700 focus:outline-none focus:shadow-outline
              flex-grow transition duration-200 appearance-none p-2 border-2 border-gray-300"></textarea>
        </div>
        <div>
          <button type="submit" class="inline-flex border border-indigo-500 focus:outline-none
              focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out delay-150 bg-blue-500
              hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 justify-end rounded-md py-2 px-4
              bg-indigo-600 text-sm font-medium text-white shadow-sm">Submit</button>
        </div>
      </form>
    </div>
  </form>
</template>

<script>
export default {
  name: "form",
    data() {
        return {
            form : {
                fullname: '',
                phone: '',
                email: '',
                address: '',
            }
        }
    },
    methods: {
        submit() {
            this.$inertia.post(`/contact`, this.form);
            console.log(this.form);
        }
    },
}

</script>

<style scoped>
*{
  direction: rtl;
}
</style>
