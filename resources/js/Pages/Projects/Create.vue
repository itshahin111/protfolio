<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    skills: Array,
});

// Store new project
const form = useForm({
    name: "",
    image: null,
    skill_id: "", // Single skill ID
    project_url: "",
});

const submit = () => {
    form.post(route("projects.store"));
};
</script>

<template>
    <Head title="New Project" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Add a New Project
            </h2>
        </template>

        <div class="py-12 flex justify-center items-center">
            <div class="bg-white shadow-md rounded-lg p-8 max-w-lg w-full">
                <form @submit.prevent="submit">
                    <!-- Skill -->
                    <div class="mb-6">
                        <InputLabel for="skill_id" value="Skill" />
                        <select
                            v-model="form.skill_id"
                            id="skill_id"
                            name="skill_id"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option
                                v-for="skill in skills"
                                :key="skill.id"
                                :value="skill.id"
                            >
                                {{ skill.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.skill_id" />
                    </div>

                    <!-- Project Name -->
                    <div class="mb-6">
                        <InputLabel for="name" value="Project Name" />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            v-model="form.name"
                            autocomplete="name"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <!-- Project URL -->
                    <div class="mb-6">
                        <InputLabel for="project_url" value="URL" />
                        <TextInput
                            id="project_url"
                            type="text"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            v-model="form.project_url"
                            autocomplete="project_url"
                            
                        />
                        <InputError class="mt-2" :message="form.errors.project_url" />
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-6">
                        <InputLabel for="image" value="Project Image" />
                        <input
                            id="image"
                            type="file"
                            class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm"
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
                            href="/projects"
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
