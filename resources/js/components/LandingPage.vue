<template>
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Login</h1>

        <form @submit.prevent="handleSubmit" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
                <input
                    v-model="formData.name"
                    type="text"
                    id="name"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter your name"
                />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Your Email</label>
                <input
                    v-model="formData.email"
                    type="email"
                    id="email"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter your email"
                />
            </div>

            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
            >
                Submit
            </button>
        </form>

        <div class="mt-8">
            <h2 class="text-xl font-semibold">Preview</h2>
            <p class="mt-2">Name: {{ formData.name }}</p>
            <p class="mt-2">Email: {{ formData.email }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                name: '',
                email: ''
            }
        };
    },
    methods: {
        handleSubmit() {
            alert(`Form submitted! Name: ${this.formData.name}, Email: ${this.formData.email}`);
        }
    }
}
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
