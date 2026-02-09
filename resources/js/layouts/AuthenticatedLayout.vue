<script setup>
import Toast from '@/components/Toast.vue';
import { logout } from '@/routes';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const sidebarOpen = ref(false);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');

// Watch for flash messages
const flash = computed(() => page.props.flash);

if (flash.value?.success) {
    toastMessage.value = flash.value.success;
    toastType.value = 'success';
    showToast.value = true;
}

if (flash.value?.error) {
    toastMessage.value = flash.value.error;
    toastType.value = 'error';
    showToast.value = true;
}

const navigation = [
    {
        name: 'Dashboard',
        href: 'dashboard',
        icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
        current: 'dashboard',
    },
    {
        name: 'Inventory',
        href: 'items.index',
        icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        current: 'items.*',
    },
];

const quickActions = [
    {
        name: 'Add Items',
        href: 'inventory.add',
        icon: 'M12 6v6m0 0v6m0-6h6m-6 0H6',
        color: 'bg-orange-500 hover:bg-orange-600',
    },
    {
        name: 'Add Stock',
        href: 'inventory.add',
        icon: 'M7 11l5-5m0 0l5 5m-5-5v12',
        color: 'bg-green-600 hover:bg-green-700',
    },
    {
        name: 'Deduct Stock',
        href: 'inventory.deduct',
        icon: 'M17 13l-5 5m0 0l-5-5m5 5V6',
        color: 'bg-red-500 hover:bg-red-600',
    },
];

const isActive = (pattern) => {
    return route().current(pattern);
};
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Toast Notification -->
        <Toast
            :show="showToast"
            :message="toastMessage"
            :type="toastType"
            @close="showToast = false"
        />

        <!-- Mobile sidebar backdrop -->
        <Transition
            enter-active-class="transition-opacity ease-linear duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity ease-linear duration-300"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="sidebarOpen"
                class="fixed inset-0 z-40 bg-gray-900/80 lg:hidden"
                @click="sidebarOpen = false"
            />
        </Transition>

        <!-- Mobile sidebar -->
        <Transition
            enter-active-class="transition ease-in-out duration-300 transform"
            enter-from-class="-translate-x-full"
            enter-to-class="translate-x-0"
            leave-active-class="transition ease-in-out duration-300 transform"
            leave-from-class="translate-x-0"
            leave-to-class="-translate-x-full"
        >
            <div
                v-if="sidebarOpen"
                class="fixed inset-y-0 left-0 z-50 w-72 bg-purple-700 lg:hidden"
            >
                <div class="flex h-16 items-center justify-between px-6">
                    <span class="text-xl font-bold text-white">Inventory</span>
                    <button
                        @click="sidebarOpen = false"
                        class="text-purple-200 hover:text-white"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <nav class="mt-6 px-4">
                    <Link
                        v-for="item in navigation"
                        :key="item"
                        :href="route(item.href)"
                        class="mb-2 flex items-center gap-3 rounded-lg px-4 py-3 transition-all duration-200"
                        :class="
                            isActive(item.current)
                                ? 'bg-purple-800 text-white'
                                : 'text-purple-100 hover:bg-purple-600'
                        "
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
                                :d="item.icon"
                            />
                        </svg>
                        {{ item.name }}
                    </Link>
                </nav>
            </div>
        </Transition>

        <!-- Desktop sidebar -->
        <div
            class="hidden lg:fixed lg:inset-y-0 lg:z-40 lg:flex lg:w-72 lg:flex-col"
        >
            <div
                class="flex grow flex-col gap-y-5 overflow-y-auto bg-purple-500 px-6 pb-4"
            >
                <!-- Logo -->
                <div class="flex h-16 items-center">
                    <Link
                        :href="route('dashboard')"
                        class="flex items-center gap-3"
                    >
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-600"
                        >
                            <svg
                                class="h-6 w-6 text-white"
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
                        <span class="text-xl font-bold text-white"
                            >Inventory App</span
                        >
                    </Link>
                </div>

                <!-- Navigation -->
                <nav class="flex flex-1 flex-col">
                    <ul class="flex flex-1 flex-col gap-y-2">
                        <li v-for="item in navigation" :key="item.name">
                            <Link
                                :href="route(item.href)"
                                class="flex items-center gap-3 rounded-lg px-4 py-3 transition-all duration-200"
                                :class="
                                    isActive(item.current)
                                        ? 'bg-purple-600 text-white shadow-lg'
                                        : 'text-purple-100 hover:bg-purple-600'
                                "
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
                                        :d="item.icon"
                                    />
                                </svg>
                                {{ item.name }}
                            </Link>
                        </li>

                        <!-- Quick Actions -->
                        <li class="mt-6">
                            <div
                                class="mb-3 px-4 text-xs font-semibold tracking-wider text-purple-200 uppercase"
                            >
                                Quick Actions
                            </div>
                            <div class="space-y-2">
                                <Link
                                    v-for="action in quickActions"
                                    :key="action.name"
                                    :href="route(action.href)"
                                    class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm text-white transition-all duration-200"
                                    :class="action.color"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            :d="action.icon"
                                        />
                                    </svg>
                                    {{ action.name }}
                                </Link>
                            </div>
                        </li>

                        <!-- User Profile at bottom -->
                        <li class="mt-auto">
                            <div class="border-t border-purple-400 pt-4">
                                <div
                                    class="flex items-center gap-3 rounded-lg px-4 py-3 transition-colors hover:bg-purple-600"
                                >
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-500"
                                    >
                                        <span
                                            class="text-sm font-semibold text-white"
                                        >
                                            {{
                                                $page.props.auth.user.name
                                                    .charAt(0)
                                                    .toUpperCase()
                                            }}
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p
                                            class="truncate text-sm font-medium text-white"
                                        >
                                            {{ $page.props.auth.user.name }}
                                        </p>
                                        <p
                                            class="truncate text-xs text-indigo-200"
                                        >
                                            {{ $page.props.auth.user.email }}
                                        </p>
                                    </div>
                                    <Link
                                        :href="logout()"
                                        method="post"
                                        as="button"
                                        class="rounded-lg p-2 text-white transition-colors hover:bg-indigo-500 hover:text-white"
                                        title="Logout"
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
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="lg:pl-72">
            <!-- Top bar -->
            <div
                class="sticky top-0 z-30 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8"
            >
                <!-- Mobile menu button -->
                <button
                    @click="sidebarOpen = true"
                    class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-gray-200 lg:hidden" />

                <!-- Page header -->
                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="flex flex-1 items-center">
                        <slot name="header" />
                    </div>

                    <!-- Right side actions -->
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <!-- Profile dropdown (mobile) -->
                        <Link
                            :href="logout()"
                            class="p-2 text-gray-400 hover:text-gray-500 lg:hidden"
                            as="button"
                            data-test="logout-button"
                        >
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Page content -->
            <main class="py-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
