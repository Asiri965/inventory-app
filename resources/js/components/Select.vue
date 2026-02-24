<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    modelValue: [String, Number],
    label: String,
    options: {
        type: Array,
        default: () => [],
    },
    error: String,
    disabled: Boolean,
    required: Boolean,
    placeholder: {
        type: String,
        default: 'Select an option',
    },
});

const emit = defineEmits(['update:modelValue']);

const isFocused = ref(false);

const isFloating = computed(() => {
    return (
        isFocused.value ||
        (props.modelValue !== '' &&
            props.modelValue !== null &&
            props.modelValue !== undefined)
    );
});

const handleChange = (event) => {
    emit('update:modelValue', event.target.value);
};
</script>

<template>
    <div class="relative">
        <div
            class="relative rounded-lg border-2 transition-all duration-200"
            :class="[
                error
                    ? 'border-red-500'
                    : isFocused
                      ? 'border-indigo-600'
                      : 'border-gray-300',
                disabled ? 'bg-gray-100' : 'bg-white',
            ]"
        >
            <label
                v-if="label"
                class="pointer-events-none absolute left-3 z-10 transition-all duration-200"
                :class="[
                    isFloating
                        ? '-top-2.5 bg-white px-1 text-xs'
                        : 'top-3 text-base',
                    error
                        ? 'text-red-500'
                        : isFocused
                          ? 'text-indigo-600'
                          : 'text-gray-500',
                ]"
            >
                {{ label }}
                <span v-if="required" class="text-red-500">*</span>
            </label>
            <select
                :value="modelValue"
                :disabled="disabled"
                @change="handleChange"
                @focus="isFocused = true"
                @blur="isFocused = false"
                class="w-full cursor-pointer appearance-none bg-transparent px-3 py-3 text-gray-900 outline-none disabled:cursor-not-allowed"
            >
                <option value="" disabled>{{ placeholder }}</option>
                <option
                    v-for="option in options"
                    :key="option.value"
                    :value="option.value"
                >
                    {{ option.label }}
                </option>
            </select>
            <div
                class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2"
            >
                <svg
                    class="h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </div>
        </div>
        <p v-if="error" class="mt-1 text-sm text-red-500">{{ error }}</p>
    </div>
</template>
