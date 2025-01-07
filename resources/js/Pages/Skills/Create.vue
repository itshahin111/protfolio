<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// store new skill;
const form = useForm({
  name: "",
  image: null,
});

const submit = () => {
  form.post(route("skills.store"), {});
};
</script>

<template>
  <Head title="New Skill"></Head>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Add a New Skill</h2>
    </template>

    <div class="py-12 flex justify-center items-center">
      <div class="bg-white shadow-md rounded-lg p-8 max-w-lg w-full sm:px-6 lg:px-8">
        <form @submit.prevent="submit">
          <!-- Title -->
          <div class="mb-6">
            <InputLabel for="name" value="Skill Name" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
              v-model="form.name"
              required
              autofocus
            />
            <InputError class="mt-2" :message="form.errors.name" />
          </div>

          <!-- Image Upload -->
          <div class="mb-6">
            <InputLabel for="image" value="Skill Image" />
            <input
              id="image"
              type="file"
              class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm file:bg-blue-500 file:text-white file:font-semibold file:mr-3 file:px-4 file:py-2 focus:ring-blue-500 focus:border-blue-500"
              @change="(e) => (form.image = e.target.files[0])"
            />
            <InputError class="mt-2" :message="form.errors.image" />
          </div>

          <!-- Actions -->
          <div class="flex items-center justify-end">
            <PrimaryButton
              type="submit"
              class="bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300"
            >
              Submit
            </PrimaryButton>
            <Link
              href="/skills"
              class="text-sm text-black-600 underline ml-4 hover:text-orange-500"
            >
              Cancel
            </Link>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
/* Additional styling for hover effects */
input[type="file"]::-webkit-file-upload-button {
  visibility: hidden;
}
input[type="file"]::before {
  content: "Choose File";
  display: inline-block;
  background: #ff6700;
  color: white;
  font-weight: 500;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  cursor: pointer;
  margin-inline-end: 10px;
}
input[type="file"]:hover::before {
  background: #e55c00;
}
</style>
