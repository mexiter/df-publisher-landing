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
                <h1 class="text-4xl font-black tracking-[-0.04em] md:text-5xl">Privacy Policy</h1>
                <p class="mt-4 text-sm leading-6 text-[#6f787f]">Draft placeholder policy for the DataFlair Publisher Marketplace. Have counsel review before publishing.</p>
                <div class="mt-8 space-y-7 text-sm leading-7 text-[#3f484e]">

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">1. Information we collect</h2>
                    <p class="mt-2">We may collect business contact details, company information, role type, marketplace preferences, campaign interests, publisher inventory details, advertiser requirements, messages submitted through forms, and technical information such as device, browser, IP address, and usage analytics.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">2. How we use information</h2>
                    <p class="mt-2">We use this information to manage waitlist requests, contact interested advertisers and publishers, review marketplace fit, improve the website, prevent misuse, support onboarding, and communicate about relevant marketplace opportunities.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">3. Business marketplace data</h2>
                    <p class="mt-2">Publishers may share information about inventory, websites, apps, platforms, formats, forecasted impressions, markets, pricing, blocklists, and approval requirements. Advertisers may share campaign requirements, target markets, budgets, creative requirements, and tracking information.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">4. Sharing information</h2>
                    <p class="mt-2">We do not sell personal information. We may share information with service providers who help us host the website, manage email, process forms, analyze usage, support compliance, and operate the marketplace.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">5. Cookies and analytics</h2>
                    <p class="mt-2">The website may use cookies or similar technologies to understand visits, improve performance, and measure interest. Users can control cookies through browser settings.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">6. Data retention</h2>
                    <p class="mt-2">We keep information only as long as needed for waitlist, business, legal, compliance, security, and operational purposes.</p>
                </section>

                <section>
                    <h2 class="text-lg font-black text-[#1c1c19]">7. Your rights</h2>
                    <p class="mt-2">Depending on your location, you may have rights to access, correct, delete, restrict, or object to certain processing of your personal information.</p>
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
