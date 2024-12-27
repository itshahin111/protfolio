<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    skills: Object,
});

const deleteSkill = (id) => {
    if (confirm("Are you sure you want to delete this skill?")) {
        // Perform delete action (use Inertia or other method)
    }
};
</script>

<template>
    <Head title="Skills Index" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Skills Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Add New Skill Button -->
                <div class="flex justify-between items-center mb-6 px-4">
                    <h3 class="text-xl font-medium text-gray-700">
                        Manage Your Skills
                    </h3>
                    <Link
                        :href="route('skills.create')"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow"
                    >
                        + Add New Skill
                    </Link>
                </div>

                <!-- Skills Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left uppercase tracking-wider"
                                >
                                    ID
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left uppercase tracking-wider"
                                >
                                    Name
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left uppercase tracking-wider"
                                >
                                    Image
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-right uppercase tracking-wider"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="skill in skills.data"
                                :key="skill.id"
                                class="hover:bg-gray-50"
                            >
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"
                                >
                                    {{ skill.id }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"
                                >
                                    {{ skill.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img
                                        :src="skill.image"
                                        alt="Skill Image"
                                        class="w-12 h-12 rounded-full border border-gray-200"
                                    />
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2"
                                >
                                    <Link
                                        :href="route('skills.edit', skill.id)"
                                        class="text-blue-600 hover:text-blue-900"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteSkill(skill.id)"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    class="flex justify-between items-center mt-4 px-4 text-sm text-gray-500"
                >
                    <span>
                        Showing {{ skills.from }} to {{ skills.to }} of
                        {{ skills.total }} results
                    </span>
                    <div class="space-x-2">
                        <Link
                            v-if="skills.prev_page_url"
                            :href="skills.prev_page_url"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded-lg"
                        >
                            Previous
                        </Link>
                        <Link
                            v-if="skills.next_page_url"
                            :href="skills.next_page_url"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg"
                        >
                            Next
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Add any additional styling if required */
table th,
table td {
    padding: 12px;
}
</style>
