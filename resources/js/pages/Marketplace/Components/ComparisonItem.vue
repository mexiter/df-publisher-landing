<script setup lang="ts">
defineProps<{
    title: string;
    before: string;
    after: string;
}>();
</script>

<template>
    <div class="grid gap-3 border-t border-[#bec8cf] py-4 md:grid-cols-[0.75fr_1fr_1fr] md:gap-6">
        <div class="text-sm font-black text-[#1c1c19]">{{ title }}</div>
        <div class="text-sm font-semibold leading-6 text-[#6f787f]">{{ before }}</div>
        <div class="text-sm font-semibold leading-6 text-[#1f4f32]">{{ after }}</div>
    </div>
</template>
