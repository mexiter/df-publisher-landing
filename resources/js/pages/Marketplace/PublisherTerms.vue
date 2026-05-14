<script setup lang="ts">
import PublicLayout from './Components/PublicLayout.vue';

defineProps<{
    contactEmail: string;
}>();
</script>

<template>
    <PublicLayout>
        <section class="mx-auto max-w-4xl px-5 py-12 md:px-8">
            <div class="border border-[#bec8cf] bg-white p-6 shadow-sm md:p-10">
                <h1 class="text-4xl font-black tracking-[-0.04em] md:text-5xl">Publisher Terms</h1>
                <p class="mt-4 text-sm leading-6 text-[#6f787f]">Draft placeholder terms for publisher participation. Have counsel review before publishing.</p>
                <div class="mt-8 space-y-7 text-sm leading-7 text-[#3f484e]">

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">1. Publisher participation</h2>
                    <p class="mt-2">Publishers may apply to list inventory such as websites, apps, platforms, placements, formats, devices, markets, forecasted impressions, pricing, and available campaign dates. Acceptance is not guaranteed.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">2. Inventory accuracy</h2>
                    <p class="mt-2">Publishers are responsible for keeping inventory details, forecasted impressions, pricing, availability, technical requirements, and restrictions accurate and reasonably up to date.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">3. Approval rights</h2>
                    <p class="mt-2">Publishers may approve or reject advertisers, brands, verticals, creatives, tracking links, or campaigns based on their own commercial, compliance, technical, or brand-safety rules.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">4. Creative and implementation</h2>
                    <p class="mt-2">Publishers may require specific creative sizes, file formats, file sizes, animation rules, tracking links, ad tags, or technical integration methods.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">5. Delivery and reporting</h2>
                    <p class="mt-2">Publishers may be required to provide or enable reporting for delivered impressions, clicks, CTR, campaign pacing, and other agreed metrics.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">6. Payment</h2>
                    <p class="mt-2">Publisher payouts may be calculated based on agreed floor pricing, delivered impressions, billing cycle, deductions, adjustments, refunds, and any applicable platform fees or commercial terms.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">7. Restrictions</h2>
                    <p class="mt-2">Publishers must not misrepresent inventory, inflate traffic, manipulate reporting, bypass the marketplace where prohibited, or run campaigns that violate applicable laws, policies, or agreed restrictions.</p>
                </section>
                    <section>
                        <h2 class="text-lg font-black text-[#1c1c19]">Contact</h2>
                        <p class="mt-2">
                            For questions, contact
                            <a class="font-bold text-[#006386]" :href="`mailto:${contactEmail}`">{{ contactEmail }}</a>.
                        </p>
                    </section>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
