<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

import { dashboard, login, register } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col bg-[#e8f8ff] p-6 pb-24 text-[#1b1b18] lg:p-8"
    >
        <header class="mb-6 w-full text-sm not-has-[nav]:hidden lg:mb-14">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035]"
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="flex w-full flex-col-reverse overflow-hidden rounded-lg lg:max-w-7xl lg:flex-row"
            >
                <div
                    class=" justify-center items-center rounded-br-lg rounded-bl-lg p-6 pb-12 text-[13px] leading-[20px] lg:p-10 lg:pt-20"
                >
                    <span
                        data-aos="fade-right"
                        data-aos-once="true"
                        class="text-gradient text-base font-semibold uppercase"
                        >Sign Up Today</span
                    >
                    <h1
                        class="text-[2.5rem] leading-tight font-bold capitalize sm:pr-8 sm:text-5xl xl:pr-10 xl:text-6xl"
                    >
                        Full
                        <span class="text-header-gradient">Featured</span>
                        Inventory Web App
                    </h1>
                    <p
                        data-aos="fade-down"
                        data-aos-once="true"
                        data-aos-delay="300"
                        class="paragraph hidden text-base leading-relaxed text-[#444444] sm:block sm:pr-8 xl:pr-10"
                    >
                        Buy and sell 200+ cryptocurrencies with 20+ flat
                        currencies using bank transfers or your credit/debit
                        card.
                    </p>
                    <div
                        data-aos="fade-up"
                        data-aos-once="true"
                        data-aos-delay="700"
                        class="mt-3 flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4"
                    >
                        <button
                            class="mt-2 max-w-full rounded-full border border-[#0c66ee] bg-gradient-to-r from-[#468ef9] to-[#0c66ee] px-8 py-4 text-center text-sm text-white transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Contact
                        </button>
                    </div>
                </div>
            </main>
        </div>
        <!-- Partner Section -->
        <section
            class="bg-partner relative max-w-full overflow-hidden shadow sm:mx-6 sm:rounded-2xl"
        >
            <div
                class="flex w-full flex-col items-center justify-center space-y-4 px-6 py-16 text-center sm:px-0"
            >
                <h3
                    data-aos="flip-down"
                    class="text-2xl font-semibold text-neutral-800"
                >
                    Trusted Partners Worldwide
                </h3>
                <p data-aos="flip-down" class="paragraph">
                    We're partners with countless major organisations around the
                    globe
                </p>
                <div
                    data-aos="fade-up"
                    class="flex flex-wrap items-center justify-center"
                >
                    <div>
                        <img
                            src="img/partner/clever.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Clever Partner Logo"
                        />
                    </div>
                    <div>
                        <img
                            src="img/partner/diamond-cutts.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Diamond Cutts Partner Logo"
                        />
                    </div>
                    <div>
                        <img
                            src="img/partner/gambio.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Gambio Partner Logo"
                        />
                    </div>
                    <div>
                        <img
                            src="img/partner/swiss-finance.png"
                            class="mx-auto sm:w-1/2 lg:w-72"
                            alt="Swiss Finance Partner Logo"
                        />
                    </div>
                </div>
            </div>
        </section>
        <!-- Advanced trading tools section -->
        <section
            class="bg-trading-tools relative my-10 max-w-full overflow-hidden rounded-2xl py-16 shadow sm:mx-4"
        >
            <div
                class="relative mx-auto grid max-w-screen-xl grid-cols-12 gap-x-6 px-4 sm:px-2"
            >
                <div
                    data-aos="fade-right"
                    class="col-span-12 mt-8 space-y-8 px-4 sm:space-y-6 sm:px-6 lg:col-span-6"
                >
                    <h2 class="text-4xl font-semibold">
                        Advanced Trading
                        <span class="text-header-gradient">Tools</span>
                    </h2>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">
                            Professional Access, Non-stop Availability
                        </h4>
                        <p class="paragraph text-sm xl:text-base">
                            We provide premium access to crypto trading for both
                            individuals and institutions through high liquidity,
                            reliable order execution and constant uptime.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">
                            A Range of Powerful Apis
                        </h4>
                        <p class="paragraph text-sm xl:text-base">
                            Set up your own trading interface or deploy your
                            algorithmic strategy with our high-performance FIX
                            and HTTP APIs. Connect to our WebSocket for
                            real-time data streaming.
                        </p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-medium">Customer Support</h4>
                        <p class="paragraph text-sm xl:text-base">
                            Premium 24/7 support available to all customers
                            worldwide by phone or email. Dedicated account
                            managers for partners.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row">
                        <button
                            class="text-gradient rounded-full border border-[#4A8FF6] bg-inherit px-10 py-4 text-center text-base text-sm transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Contact
                        </button>
                        <button
                            class="rounded-full bg-inherit px-10 py-4 text-center text-sm text-[#4A8FF6] underline transition duration-300 hover:shadow-md hover:shadow-[#0c66ee]/50"
                        >
                            Contact
                        </button>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="w-full sm:mt-20 xl:mt-0">
                        <img
                            src="img/advanced-trading-tools.webp"
                            class="w-full"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </section>
        <!-- Industry-leading security section -->
        <section class="my-5 w-full">
            <div
                class="relative mx-auto grid max-w-screen-xl grid-cols-12 gap-x-6 px-8"
            >
                <div data-aos="fade-right" class="col-span-12 lg:col-span-6">
                    <div class="w-full">
                        <img
                            src="/img/industry-leading-security.webp"
                            class="w-full"
                            alt=""
                        />
                    </div>
                </div>
                <div
                    data-aos="fade-left"
                    class="col-span-12 mt-8 space-y-8 sm:space-y-6 lg:col-span-5 xl:px-8"
                >
                    <h2 class="text-4xl font-semibold">
                        Industry-leading security from day one
                    </h2>
                    <ul class="space-y-8 sm:space-y-4">
                        <li class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <span>Safety, security and compliance</span>
                            </div>
                            <p class="text-sm leading-relaxed text-gray-700">
                                NEFA is a licensed New York trust company that
                                undergoes regular bank exams and is subject to
                                the cybersecurity audits conducted by the New
                                York Department of Financial Services.
                                <span class="underline">Learn more</span> about
                                our commitment to security.
                            </p>
                        </li>
                        <li class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <span>Hardware security keys</span>
                            </div>
                            <p class="text-sm leading-relaxed text-gray-700">
                                With NEFA you can secure your account with a
                                hardware security key via WebAuthn.
                            </p>
                        </li>
                        <li class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <span>SOC Certifications</span>
                            </div>
                            <p class="text-sm leading-relaxed text-gray-700">
                                NEFA is
                                <span class="underline">SOC 1 Type 2</span> and
                                <span class="underline">SOC 2 Type 2</span>
                                compliant. We are the world’s first
                                cryptocurrency exchange and custodian to
                                complete these exams.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <footer class="mx-auto mt-auto w-full max-w-screen-xl px-8">
            <div class="w-full border-y border-[#DDDDDD]"></div>
            <div
                class="py-8 text-center text-sm text-[#666666] hover:text-gray-900 sm:py-4"
            >
                &copy; Copyright 2025 Mentra Labs. All rights reserved
            </div>
        </footer>
    </div>
</template>
<style scoped>
.text-header-gradient {
    background: rgb(57, 132, 244);
    background: linear-gradient(
        169.4deg,
        #3984f4 -6.01%,
        #0cd3ff 36.87%,
        #2f7cf0 78.04%,
        #0e65e8 103.77%
    );
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
.bg-partner {
    background: url('/img/partner/background.png');
    background-size: cover;
    background-position: center;
}
.bg-trading-tools {
    background: url('./img/bg-trading-tools.webp');
    background-size: cover;
    background-position: center;
}
.max-h-0 {
    max-height: 0;
}
</style>
