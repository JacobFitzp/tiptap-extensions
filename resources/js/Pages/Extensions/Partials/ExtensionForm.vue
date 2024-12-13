<template>
    <form class="space-y-4" @submit.prevent="$emit('submit', form)">
        <div>
            <InputLabel field="title">Title</InputLabel>
            <InputText
                placeholder="Something awesome"
                v-model="form.title"
                :invalid="form.errors.title"
                class="w-full"
            />
            <InputError :error="form.errors.title" />
        </div>
        <div>
            <InputLabel field="description"> Description </InputLabel>
            <Textarea
                v-model="form.description"
                :invalid="form.errors.description"
                rows="2"
                class="w-full"
            />
            <InputError :error="form.errors.description" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <InputLabel field="repository"> Repository </InputLabel>
                <Select
                    v-model="form.repository"
                    :invalid="form.errors.repository"
                    :disabled="!creating"
                    :options="repositoryOptions"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Select a repository"
                    class="w-full"
                />
                <InputError :error="form.errors.repository" />
            </div>
            <div>
                <InputLabel field="type"> Type </InputLabel>
                <Select
                    v-model="form.type"
                    :invalid="form.errors.type"
                    :options="typeOptions"
                    optionLabel="name"
                    optionValue="code"
                    placeholder="Select a type"
                    class="w-full"
                >
                    <template #option="slotProps">
                        <div>
                            <div>
                                {{ slotProps.option.name }}
                            </div>
                            <div class="mt-1 text-sm text-gray-600">
                                {{ slotProps.option.description }}
                            </div>
                        </div>
                    </template>
                </Select>
                <InputError :error="form.errors.type" />
            </div>
        </div>

        <Message v-if="creating" icon="pi pi-info-circle" class="mt-4">
            <strong>Can't see your repository?</strong>
            Make sure its public and you have the correct permissions.
        </Message>

        <div>
            <InputLabel field="content"> Content </InputLabel>

            <div class="mb-4 flex items-center space-x-2">
                <ToggleSwitch
                    v-model="form.use_readme"
                    :invalid="form.errors.use_readme"
                />
                <label> Use repositories <strong>README.md</strong> </label>
            </div>

            <InputError :error="form.errors.use_readme" />

            <Message
                v-if="form.use_readme"
                icon="pi pi-info-circle"
                class="mb-4"
            >
                We will reuse the content from your repository's README.md file.
            </Message>

            <Textarea
                v-else
                v-model="form.content"
                :invalid="form.errors.content"
                placeholder="Add some markdown content here."
                rows="8"
                class="w-full"
            />

            <InputError :error="form.errors.content" />
        </div>

        <div>
            <InputLabel field="tags"> Tags </InputLabel>
            <MultiSelect
                v-model="form.tags"
                filter
                :invalid="form.errors.tags"
                display="chip"
                :options="tags"
                optionLabel="label"
                optionValue="slug"
                placeholder="Select up to 5 tags"
                :maxSelectedLabels="5"
                class="w-full"
            />
            <InputError :error="form.errors.tags" />
        </div>

        <Button @click="$emit('submit', form)">{{ buttonLabel }}</Button>
    </form>
</template>

<script setup>
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import { useForm } from '@inertiajs/vue3';
import {
    Button,
    InputText,
    Message,
    MultiSelect,
    Select,
    Textarea,
    ToggleSwitch,
} from 'primevue';
import { computed } from 'vue';

const props = defineProps({
    repositories: {
        type: Array,
        required: true,
    },
    tags: {
        type: Array,
        required: true,
    },
    extension: {
        type: Object,
        default: () => ({}),
    },
    buttonLabel: {
        type: String,
        default: 'Submit',
    },
});

defineEmits(['submit']);

// Define extension form.
const form = useForm({
    title: props.extension.title || '',
    type: props.extension.type || '',
    repository: props.extension.repository?.full || '',
    description: props.extension.description || '',
    use_readme: props.extension.use_readme || true,
    content: props.extension.content || '',
    tags: props.extension.tags || [],
});

// Map repository options.
const repositoryOptions = computed(() => {
    return props.repositories.map((repository) => {
        return {
            name: repository.full_name,
            code: repository.full_name.toLowerCase(),
        };
    });
});

// Is creating new
const creating = computed(() => {
    return !props.extension?.title;
});

// Type options.
const typeOptions = [
    {
        name: 'Extension',
        description:
            'Something that extends the functionality of TipTap, for example an image extension.',
        code: 'extension',
    },
    {
        name: 'Package',
        description:
            'Something that works with TipTap, for example a PHP package.',
        code: 'package',
    },
    {
        name: 'Project',
        description:
            'Something build using TipTap, for example a blog or a website.',
        code: 'project',
    },
];
</script>
