<template>
    <AppLayout title="Submit an extension">
        <Container>
            <Panel header="Submit an extension">
                <form class="space-y-4">
                    <div>
                        <InputLabel>Title</InputLabel>
                        <InputText v-model="form.title" class="w-full" />
                    </div>
                    <div>
                        <InputLabel>Repository</InputLabel>
                        <Select
                            v-model="form.repository"
                            :options="repositoryOptions"
                            optionLabel="name"
                            placeholder="Select a repository"
                            class="w-full"
                        />
                        <Message icon="pi pi-info-circle" class="mt-4">
                            Can't see your repository? Make sure its public and
                            you have the correct permissions.
                        </Message>
                    </div>
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
import { InputText, Panel, Select, Message } from 'primevue';
import { computed } from 'vue';

const props = defineProps({
    repositories: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    title: '',
    repository: '',
});

const repositoryOptions = computed(() => {
    return props.repositories.map((repository) => {
        return {
            name: repository.full_name,
            code: repository.full_name,
        };
    });
});
</script>
