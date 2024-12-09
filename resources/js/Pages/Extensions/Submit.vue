<template>
    <AppLayout title="Submit an extension">
        <Container>
            <Panel header="Submit an extension">
                <form class="space-y-4" @submit.prevent="submitForm">
                    <div>
                        <InputLabel field="title">Title</InputLabel>
                        <InputText
                            placeholder="Something awesome"
                            v-model="form.title"
                            class="w-full"
                        />
                    </div>
                    <div>
                        <InputLabel field="description">
                            Description
                        </InputLabel>
                        <Textarea
                            v-model="form.description"
                            rows="2"
                            class="w-full"
                        />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel field="repository">
                                Repository
                            </InputLabel>
                            <Select
                                v-model="form.repository"
                                :options="repositoryOptions"
                                optionLabel="name"
                                placeholder="Select a repository"
                                class="w-full"
                            />
                        </div>
                        <div>
                            <InputLabel field="type"> Type </InputLabel>
                            <Select
                                v-model="form.type"
                                :options="typeOptions"
                                optionLabel="name"
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
                        </div>
                    </div>

                    <Message icon="pi pi-info-circle" class="mt-4">
                        <strong>Can't see your repository?</strong>
                        Make sure its public and you have the correct
                        permissions.
                    </Message>

                    <div>
                        <InputLabel field="content"> Content </InputLabel>

                        <div class="flex items-center space-x-2">
                            <ToggleSwitch v-model="form.use_readme" />
                            <label>
                                Use repositories <strong>README.md</strong>
                            </label>
                        </div>

                        <Message
                            v-if="form.use_readme"
                            icon="pi pi-info-circle"
                            class="mt-4"
                        >
                            We will reuse the content from your repository's
                            README.md file.
                        </Message>

                        <Textarea
                            v-else
                            v-model="form.content"
                            placeholder="Add some markdown content here."
                            rows="4"
                            class="mt-4 w-full"
                        />
                    </div>

                    <div>
                        <InputLabel field="tags"> Tags </InputLabel>
                        <MultiSelect
                            v-model="form.tags"
                            display="chip"
                            :options="tagOptions"
                            optionLabel="name"
                            placeholder="Select up to 5 tags"
                            :maxSelectedLabels="5"
                            class="w-full"
                        />
                    </div>

                    <Button>Submit</Button>
                </form>
            </Panel>
        </Container>
    </AppLayout>
</template>

<script setup>
import Container from '@/Components/Container.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import {
    Button,
    InputText,
    Message,
    MultiSelect,
    Panel,
    Select,
    Textarea,
    ToggleSwitch,
} from 'primevue';
import { computed } from 'vue';

const props = defineProps({
    tags: {
        type: Array,
        required: true,
    },
    repositories: {
        type: Array,
        required: true,
    },
});

// Extension creation form.
const form = useForm({
    title: '',
    type: 'extension',
    repository: '',
    description: '',
    use_readme: true,
    content: '',
    tags: [],
});

// Repository options.
const repositoryOptions = computed(() => {
    return props.repositories.map((repository) => {
        return {
            name: repository.full_name,
            code: repository.full_name.toLowerCase(),
        };
    });
});

// Tag options.
const tagOptions = computed(() => {
    return props.tags.map((tag) => {
        return {
            name: tag.label,
            code: tag.slug,
        };
    });
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
        code: 'extension',
    },
    {
        name: 'Project',
        description:
            'Something build using TipTap, for example a blog or a website.',
        code: 'project',
    },
];

// Submit the creation form.
const submitForm = () => {
    form.post(route('extensions.submit.handle'));
};
</script>
