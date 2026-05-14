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
                <h1 class="text-4xl font-black tracking-[-0.04em] md:text-5xl">Terms and Conditions</h1>
                <p class="mt-4 text-sm leading-6 text-[#6f787f]">Draft placeholder terms for website and waitlist use. Have counsel review before publishing.</p>
                <div class="mt-8 space-y-7 text-sm leading-7 text-[#3f484e]">

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">1. Use of the website</h2>
                    <p class="mt-2">The website provides information about the DataFlair Publisher Marketplace and allows interested parties to request access. Submitting a form does not guarantee acceptance, onboarding, commercial terms, campaign availability, or publisher participation.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">2. Eligibility</h2>
                    <p class="mt-2">Users must provide accurate business information and must have authority to act on behalf of the company they represent.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">3. No guaranteed availability</h2>
                    <p class="mt-2">Inventory, forecasts, pricing, campaign timing, publisher approval, and advertiser approval are subject to change. Any examples on the website are illustrative.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">4. Acceptable use</h2>
                    <p class="mt-2">Users may not misuse the website, submit false information, attempt unauthorized access, scrape the service, interfere with website operation, or use the marketplace to promote unlawful, misleading, unsafe, or non-compliant campaigns.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">5. Marketplace transactions</h2>
                    <p class="mt-2">Campaign booking, payment, approval, reporting, publisher payout, and cancellation rules will be governed by separate marketplace terms, insertion orders, or commercial agreements.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">6. Intellectual property</h2>
                    <p class="mt-2">All website content, branding, copy, design, and product concepts are owned by DataFlair or its licensors and may not be copied or reused without permission.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">7. Disclaimers</h2>
                    <p class="mt-2">The website is provided for informational purposes. We do not guarantee uninterrupted availability, error-free content, or that any campaign, publisher, or advertiser opportunity will be available.</p>
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
