<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import Form from "@/Components/Form.vue";
import Content from "@/Components/Content.vue";
import Table from "@/Components/Table.vue";
import CustomModal from "@/Components/CustomModal.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="grid grid-cols-6 gap-4">
            <div
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center col-start-1 col-span-4"
            >
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-3"
                >
                    <Content />
                </div>
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-3 col-start-1 col-span-4"
                >
                    <Table />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
