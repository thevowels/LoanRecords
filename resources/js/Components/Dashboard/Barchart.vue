<template>
    <Bar :data="data" :options="options" />
</template>

<script setup>
import {computed} from "vue";

const props = defineProps(['data', 'title']);

const data = computed(() => props.data);

import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js'

import { Bar } from 'vue-chartjs'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)

const options = {
    responsive: true,
    maintainAspectRatio: true
}

</script>
