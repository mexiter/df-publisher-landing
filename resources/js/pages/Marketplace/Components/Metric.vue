<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    label: string;
    value: string;
    note: string;
    accent?: string;
}>();

const accentVar = computed(() => ({ '--metric-accent': props.accent || '#006386' }));
</script>

<template>
    <div
        class="metric-motion-sheen group relative overflow-hidden border border-[#bec8cf] bg-white p-5 shadow-sm transition-shadow duration-300 hover:shadow-md"
        :style="accentVar"
    >
        <div class="absolute left-0 top-0 h-1 w-full" :style="{ background: accent || '#006386' }" />
        <div class="flex items-center gap-2">
            <span class="metric-live-dot shrink-0 rounded-full" aria-hidden="true" />
            <div class="text-[10px] font-black uppercase tracking-[0.16em] text-[#6f787f]">{{ label }}</div>
        </div>
        <div class="metric-motion-value mt-2 text-3xl font-black tracking-[-0.04em] text-[#1c1c19]">{{ value }}</div>
        <div class="mt-1 text-xs font-semibold leading-5 text-[#6f787f]">{{ note }}</div>
    </div>
</template>

<style scoped>
.metric-motion-sheen::after {
    content: '';
    pointer-events: none;
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        transparent 0%,
        color-mix(in srgb, var(--metric-accent, #006386) 12%, transparent) 45%,
        color-mix(in srgb, var(--metric-accent, #006386) 18%, transparent) 50%,
        color-mix(in srgb, var(--metric-accent, #006386) 12%, transparent) 55%,
        transparent 100%
    );
    background-size: 200% 100%;
    opacity: 0;
    mix-blend-mode: multiply;
    animation: basket-shine 7s ease-in-out infinite;
}

.metric-motion-value {
    animation: metric-value-breathe 5.5s ease-in-out infinite;
}

.metric-live-dot {
    width: 0.4rem;
    height: 0.4rem;
    background: var(--metric-accent, #006386);
    animation: metric-dot-pulse 2.2s ease-in-out infinite;
}

@media (prefers-reduced-motion: reduce) {
    .metric-motion-sheen::after,
    .metric-motion-value,
    .metric-live-dot {
        animation: none !important;
    }
}
</style>
