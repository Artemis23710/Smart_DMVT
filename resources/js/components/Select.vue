<template>
  <div class="relative">
    <button
      type="button"
      class="form-select w-full"
      @click="open = !open"
      :aria-expanded="open"
    >
      {{ selectedOption || placeholder }}
    </button>

    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <ul
        v-show="open"
        class="absolute mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg z-10"
        @click.stop
      >
        <li
          v-for="option in options"
          :key="option.value"
          class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
          @click="selectOption(option)"
        >
          {{ option.label }}
        </li>
      </ul>
    </Transition>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  options: {
    type: Array,
    required: true,
  },
  modelValue: {
    type: [String, Number],
    default: '',
  },
  placeholder: {
    type: String,
    default: 'Select an option',
  },
});

const emit = defineEmits(['update:modelValue']);

const open = ref(false);
const selectedOption = ref('');

watch(() => props.modelValue, (newValue) => {
  const option = props.options.find(opt => opt.value === newValue);
  selectedOption.value = option ? option.label : '';
});

function selectOption(option) {
  selectedOption.value = option.label;
  emit('update:modelValue', option.value);
  open.value = false;
}
</script>

<style scoped>
.form-select {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 1rem;
  border: 1px solid #ced4da;
  border-radius: 0.375rem;
  background-color: #ffffff;
}
</style>
