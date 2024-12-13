<template>
    <AppLayout :breadcumb="breadcrumbs" header="Profile" title="Profile">
        <Container>
            <div class="space-y-6">
                <Panel header="My extensions">
                    <DataView :value="extensions">
                        <template #list="slotProps">
                            <div class="flex flex-col">
                                <div
                                    v-for="(item, index) in slotProps.items"
                                    :key="index"
                                >
                                    <div
                                        class="gap-4 p-4"
                                        :class="{
                                            'border-t border-surface-200':
                                                index !== 0,
                                        }"
                                    >
                                        <h3 class="text-lg font-bold">
                                            {{ item.title }}
                                        </h3>
                                        <p
                                            class="flex items-center gap-1 text-sm text-gray-500"
                                        >
                                            <i class="pi pi-github"></i>
                                            {{ item.repository.owner }}/{{
                                                item.repository.name
                                            }}
                                        </p>
                                        <p class="mt-2">
                                            {{ item.description }}
                                        </p>
                                        <div class="mt-2 flex gap-1">
                                            <Tag
                                                v-if="item.published"
                                                severity="success"
                                                >Published</Tag
                                            >
                                            <Tag
                                                v-else
                                                severity="warn"
                                                icon="pi pi-eye-slash"
                                                value="Unpublished"
                                            />
                                            <Tag
                                                v-for="tagged in item.tagged"
                                                :key="tagged.id"
                                                :value="tagged.tag.label"
                                                severity="secondary"
                                            />
                                        </div>
                                        <div class="mt-4 flex gap-2">
                                            <Button
                                                :as="Link"
                                                :href="
                                                    route(
                                                        'extensions.manage',
                                                        getSlug(item),
                                                    )
                                                "
                                                severity="secondary"
                                                size="small"
                                                label="Manage"
                                                icon="pi pi-wrench"
                                                outlined
                                            />
                                            <Button
                                                severity="danger"
                                                size="small"
                                                icon="pi pi-trash"
                                                label="Delete"
                                                outlined
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </DataView>
                    <Button
                        class="mt-4"
                        :as="Link"
                        :href="route('extensions.submit')"
                        icon="pi pi-plus"
                        label="Submit new extension"
                    />
                </Panel>
                <Panel header="Github account" class="mt-2">
                    <div class="flex items-center gap-4">
                        <div>
                            <Avatar
                                :image="$page.props.auth.user.avatar"
                                size="xlarge"
                                shape="circle"
                            />
                        </div>
                        <div>
                            <h3 class="font-bold">
                                {{ $page.props.auth.user.name }}
                            </h3>
                            <p class="text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </p>
                        </div>
                    </div>
                    <Button
                        class="mt-4"
                        severity="danger"
                        size="small"
                        label="Unlink account"
                        icon="pi pi-trash"
                        outlined
                    />
                </Panel>
            </div>
        </Container>
    </AppLayout>
</template>

<script setup>
import Container from '@/Components/Container.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Avatar, Button, DataView, Panel, Tag } from 'primevue';
import { ref } from 'vue';

defineProps({
    extensions: {
        type: Array,
        required: true,
    },
});

const getSlug = (extension) => {
    return `${extension.repository.owner}-${extension.repository.name}`;
};

const breadcrumbs = ref([
    {
        label: 'Profile',
        url: route('profile.show'),
    },
]);
</script>
