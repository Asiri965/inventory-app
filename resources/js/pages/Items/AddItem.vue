<script setup>
import Button from '@/components/Button.vue';
import Card from '@/components/Card.vue';
import Input from '@/components/Input.vue';
import Select from '@/components/Select.vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps({
    units: Array,
});

const form = useForm({
    items: [
        {
            name: '',
            unit: '',
            quantity: '',
        },
    ],
});

const unitOptions = computed(() =>
    props.units.map((unit) => ({
        value: unit.name,
        label: unit.name,
    })),
);

const addItem = () => {
    form.items.push({
        name: '',
        unit: '',
        quantity: '',
    });
};

const removeItem = (index) => {
    if (form.items.length > 1) {
        form.items.splice(index, 1);
    }
};

const submit = () => {
    form.post(route('items.store'));
};
</script>

<template>
    <Head title="Add New Item" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link
                    :href="route('inventory.index')"
                    class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600"
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
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </Link>
                <h1 class="text-2xl font-bold text-gray-900">Add New Items</h1>
            </div>
        </template>

        <div class="mx-auto max-w-4xl">
            <Card>
                <form @submit.prevent="submit">
                    <!-- Items List -->
                    <div class="space-y-6">
                        <TransitionGroup
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="opacity-0 -translate-y-4"
                            enter-to-class="opacity-100 translate-y-0"
                            leave-active-class="transition ease-in duration-200"
                            leave-from-class="opacity-100 translate-y-0"
                            leave-to-class="opacity-0 -translate-y-4"
                        >
                            <div
                                v-for="(item, index) in form.items"
                                :key="index"
                                class="relative rounded-xl border-2 border-gray-100 bg-gray-50 p-6"
                            >
                                <!-- Item Header -->
                                <div
                                    class="mb-6 flex items-center justify-between"
                                >
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100"
                                        >
                                            <span
                                                class="font-bold text-indigo-600"
                                                >{{ index + 1 }}</span
                                            >
                                        </div>
                                        <h3 class="font-semibold text-gray-900">
                                            Item Details
                                        </h3>
                                    </div>
                                    <button
                                        v-if="form.items.length > 1"
                                        type="button"
                                        @click="removeItem(index)"
                                        class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600"
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Form Fields -->
                                <div class="grid gap-6 md:grid-cols-2">
                                    <Input
                                        v-model="item.name"
                                        label="Item Name"
                                        placeholder="Enter item name"
                                        :error="
                                            form.errors[`items.${index}.name`]
                                        "
                                        required
                                    />
                                    <Select
                                        v-model="item.unit"
                                        :options="unitOptions"
                                        :error="
                                            form.errors[`items.${index}.unit`]
                                        "
                                        required
                                    />
                                    <Input
                                        v-model="item.quantity"
                                        label="Initial Quantity"
                                        type="number"
                                        placeholder="0"
                                        :error="
                                            form.errors[
                                                `items.${index}.quantity`
                                            ]
                                        "
                                        required
                                    />
                                </div>
                            </div>
                        </TransitionGroup>
                    </div>

                    <!-- Add More Button -->
                    <div class="mt-6">
                        <button
                            type="button"
                            @click="addItem"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-300 p-4 text-gray-500 transition-all duration-200 hover:border-indigo-500 hover:bg-indigo-50 hover:text-indigo-600"
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
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                />
                            </svg>
                            Add Another Item
                        </button>
                    </div>

                    <!-- Actions -->
                    <div
                        class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6"
                    >
                        <Link :href="route('dashboard')">
                            <Button variant="ghost">Cancel</Button>
                        </Link>
                        <Button
                            type="submit"
                            variant="primary"
                            :loading="form.processing"
                            :disabled="form.processing"
                        >
                            <svg
                                class="mr-2 h-5 w-5"
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
                            Save
                            {{
                                form.items.length > 1
                                    ? `${form.items.length} Items`
                                    : 'Item'
                            }}
                        </Button>
                    </div>
                </form>
            </Card>
        </div>
    </AuthenticatedLayout>
</template>
