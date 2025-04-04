<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 bg-gray-50 ">
                        <h1 class="text-2xl font-semibold mb-6">Summaries</h1>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                            <div
                                v-for="(item, index) in kpiCards"
                                :key="index"
                                class="bg-white p-4 rounded-2xl shadow-md flex flex-col gap-2 hover:shadow-lg transition"
                            >
                                <h2 class="text-xl text-gray-900 font-bold">{{ item.label }}</h2>
                                <p class="text-2xl font-extrabold text-green-500 text-right">{{ item.value }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 mt-8 ">
                            <DashboardCharts :series="series"></DashboardCharts>
                    </div>
            </div>
        </div>



    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardCharts from "@/Components/Dashboard/DashboardCharts.vue";

const props = defineProps(['people', 'bahts', 'summaries', 'series'])



const kpiCards =  [
    { label: "Active Loan", value: props.summaries.active_loan },
    // { label: "Monthly Loan", value: props.summaries.monthly_loan },
    // { label: "Monthly Return", value: props.summaries.monthly_return },
    { label: "User Count", value: props.summaries.total_users },
    { label: "Consumer Count" , value: props.summaries.total_people}
]
</script>
