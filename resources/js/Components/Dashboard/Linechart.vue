<template>
    <Line :data="data" :options="{
    responsive: true,
    plugins: {
      legend: { display: false },
      title: {
        display: true,
        text: title
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: value => value.toLocaleString()
        }
      }
    }
  }" />
</template>

<script setup>

import {computed} from "vue";

const props = defineProps(['data', 'title']);

const data = computed(() => props.data);
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
} from 'chart.js'

import { Line } from "vue-chartjs";

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

const options = {
    responsive: true,
    maintainAspectRatio: false
}


</script>
