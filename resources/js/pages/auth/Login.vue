<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <!-- <AuthBase
        class="bg-[#e8f8ff]"
        title="Log in to your account"
        description="Enter your email and password below to log in"
    > -->
    <GuestLayout>
        <Head title="Log in" />

        <!-- Header -->
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900">Welcome back</h2>
            <p class="mt-2 text-gray-600">
                Sign in to your account to continue
            </p>
        </div>

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm"
                            :tabindex="5"
                        >
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    :disabled="processing"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white shadow-lg shadow-indigo-500/30 transition-all duration-200 hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    <svg
                        v-if="processing"
                        class="h-5 w-5 animate-spin"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                        ></path>
                    </svg>
                    <span>{{ processing ? 'Signing in...' : 'Sign In' }}</span>
                </button>
            </div>

            
        </Form>
        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="bg-white px-4 text-gray-500"
                    >New to Inventory Manager?</span
                >
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center text-sm/6 text-gray-400" v-if="canRegister">
            <Link
                :href="register()"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-gray-100 px-4 py-3 font-semibold text-gray-700 transition-all duration-200 hover:bg-gray-200"
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
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                    />
                </svg>
                Create an Account
            </Link>
        </div>

        <!-- </AuthBase> -->
    </GuestLayout>
</template>
