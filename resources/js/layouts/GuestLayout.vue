<script setup></script>

<template>
    <div class="flex min-h-screen">
        <!-- Left Side - Branding -->
        <div
            class="relative hidden overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800 lg:flex lg:w-1/2"
        >
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-70">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="100%"
                    height="100%"
                >
                    <defs>
                        <linearGradient id="a" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0" stop-color="#80F" />
                            <stop offset="1" stop-color="#f40" />
                        </linearGradient>
                    </defs>
                    <pattern
                        id="b"
                        width="24"
                        height="24"
                        patternUnits="userSpaceOnUse"
                    >
                        <circle fill="#ffffff" cx="12" cy="12" r="12" />
                    </pattern>
                    <rect width="100%" height="100%" fill="url(#a)" />
                    <rect
                        width="100%"
                        height="100%"
                        fill="url(#b)"
                        fill-opacity="0.1"
                    />
                </svg>
            </div>

            <!-- Floating Shapes -->
            <div
                class="absolute top-20 left-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"
            ></div>
            <div
                class="absolute right-20 bottom-20 h-96 w-96 rounded-full bg-purple-500/20 blur-3xl"
            ></div>

            <!-- Content -->
            <div
                class="relative z-10 flex w-full flex-col items-center justify-center p-12 text-white"
            >
                <!-- Logo -->
                <div class="mb-8">
                    <div
                        class="flex h-20 w-20 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-sm"
                    >
                        <svg
                            class="h-12 w-12 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                            />
                        </svg>
                    </div>
                </div>

                <h1 class="mb-4 text-center text-4xl font-bold">
                    Inventory Manager
                </h1>
                <p class="max-w-md text-center text-xl text-indigo-200">
                    Streamline your inventory management with our powerful and
                    intuitive platform
                </p>

                <!-- Features List -->
                <div class="mt-12 space-y-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                        <span class="text-indigo-100"
                            >Track inventory in real-time</span
                        >
                    </div>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                        <span class="text-indigo-100"
                            >Multiple measurement units</span
                        >
                    </div>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                        <span class="text-indigo-100"
                            >Complete transaction history</span
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div
            class="flex w-full flex-col items-center justify-center bg-gray-50 p-6 sm:p-12 lg:w-1/2"
        >
            <!-- Mobile Logo -->
            <div class="mb-8 lg:hidden">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600"
                >
                    <svg
                        class="h-10 w-10 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                        />
                    </svg>
                </div>
            </div>

            <!-- Form Card -->
            <div class="w-full max-w-md">
                <slot />
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-500">
                <p>
                    &copy; {{ new Date().getFullYear() }} Inventory App By
                    Mentra Labz. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</template>
