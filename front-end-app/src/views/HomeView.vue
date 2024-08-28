<script setup>
import { useCounterStore } from "@/stores/counter";

const counter = useCounterStore();
</script>

<template>
    <main>
        <h1>Home Page</h1>
        <button @click="counter.increment()">Click Counter Add</button>
        <div>Current Count: {{ counter.count }}</div>
        <div>Current Double Count: {{ counter.doubleCount }}</div>
    </main>
</template>
