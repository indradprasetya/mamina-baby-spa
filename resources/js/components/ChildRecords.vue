<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Child Records</h1>

        <!-- Button for adding new data -->
        <button
            @click="showModal = true"
            class="bg-blue-500 text-white px-4 py-2 rounded"
        >
            Add Child
        </button>

        <!-- Modal for input form -->
        <div
            v-if="showModal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-white p-6 rounded shadow-md w-96">
                <h2 class="text-xl font-bold mb-4">Add New Child</h2>

                <input
                    v-model="form.name"
                    type="text"
                    placeholder="Name"
                    class="border p-2 w-full mb-2"
                />
                <input
                    v-model="form.birth_date"
                    type="date"
                    class="border p-2 w-full mb-2"
                />
                <input
                    v-model="form.weight"
                    type="number"
                    placeholder="Weight (kg)"
                    class="border p-2 w-full mb-2"
                />
                <input
                    v-model="form.height"
                    type="number"
                    placeholder="Height (cm)"
                    class="border p-2 w-full mb-2"
                />
                <textarea
                    v-model="form.notes"
                    placeholder="Notes"
                    class="border p-2 w-full mb-2"
                ></textarea>

                <div class="flex justify-end">
                    <button
                        @click="showModal = false"
                        class="mr-2 px-4 py-2 bg-gray-400 text-white rounded"
                    >
                        Cancel
                    </button>
                    <button
                        @click="addChild"
                        class="px-4 py-2 bg-green-500 text-white rounded"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>

        <!-- Table for displaying data -->
        <table class="w-full mt-6 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Birth Date</th>
                    <th class="border p-2">Weight</th>
                    <th class="border p-2">Height</th>
                    <th class="border p-2">Notes</th>
                    <th class="border p-2"> </th>

                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="child in children"
                    :key="child.id"
                    class="text-center"
                >
                    <td class="border p-2">{{ child.name }}</td>
                    <td class="border p-2">{{ child.birth_date }}</td>
                    <td class="border p-2">{{ child.weight }} kg</td>
                    <td class="border p-2">{{ child.height }} cm</td>
                    <td class="border p-2">{{ child.notes || "-" }}</td>
                    <td class="border p-2">
                        <button
                            @click="deleteChild(child.id)"
                            class="bg-red-500 text-white px-4 py-1 rounded"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            showModal: false,
            children: [],
            form: {
                name: "",
                birth_date: "",
                weight: "",
                height: "",
                notes: "",
            },
        };
    },
    methods: {
        async fetchChildren() {
            const response = await axios.get("/api/children");
            this.children = response.data;
        },

        async addChild() {
            await axios.post("/api/children", this.form, {
                headers: {
                    "Content-Type": "application/json", // Untuk format JSON
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"), // Ambil CSRF token dari meta tag
                },
            });
            this.fetchChildren();
            this.showModal = false;
            this.form = {
                name: "",
                birth_date: "",
                weight: "",
                height: "",
                notes: "",
            };
        },

        async deleteChild(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                await axios.delete(`/api/children/${id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"), // CSRF token
                    },
                });

                this.fetchChildren(); // Update data setelah berhasil dihapus
            }
        },
    },
    mounted() {
        this.fetchChildren();
    },
};
</script>
