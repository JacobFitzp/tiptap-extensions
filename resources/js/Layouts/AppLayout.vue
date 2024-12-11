<template>
    <Head>
        <title>{{ title }}</title>
        <slot name="head" />
    </Head>
    <div class="pb-6">
        <div class="mx-auto my-6 max-w-5xl">
            <Menubar :model="items">
                <template #start>
                    <img alt="" width="35" height="35" src="/assets/logo.svg" />
                </template>
                <template #end>
                    <div class="flex items-center gap-2">
                        <InputText
                            placeholder="Search"
                            type="text"
                            class="w-32 sm:w-auto"
                        />

                        <template v-if="$page.props.auth.user">
                            <Avatar
                                :image="$page.props.auth.user.avatar"
                                shape="circle"
                                @click="toggleProfileMenu"
                                class="cursor-pointer"
                                aria-haspopup="true"
                                aria-controls="overlay_menu"
                            />
                            <Menu
                                ref="profileMenu"
                                :model="profileItems"
                                :popup="true"
                            />
                        </template>

                        <Button
                            v-else
                            as="a"
                            :href="route('auth.redirect')"
                            icon="pi pi-github"
                            label="Sign-in"
                        ></Button>
                    </div>
                </template>
            </Menubar>
        </div>

        <Container v-if="header" class="mb-6">
            <h1 class="text-2xl font-bold">{{ header }}</h1>
            <Breadcrumb
                v-if="breadcrumbs"
                :home="{ icon: 'pi pi-home' }"
                :model="breadcrumbs"
            />
        </Container>

        <slot />
    </div>
</template>

<script setup>
import Container from '@/Components/Container.vue';
import { Head } from '@inertiajs/vue3';
import { Avatar, Breadcrumb, Button, InputText, Menu, Menubar } from 'primevue';
import { ref } from 'vue';

defineProps({
    title: {
        type: String,
        required: true,
    },
    header: {
        type: [String, null],
        default: null,
    },
    breadcrumbs: {
        type: [Array, null],
        default: null,
    },
});

const items = ref([
    {
        label: 'Home',
        url: route('home'),
        active: route().current('home'),
        icon: 'pi pi-home',
    },
    {
        label: 'Trending',
        icon: 'pi pi-chart-line',
    },
]);

const profileMenu = ref();
const profileItems = ref([
    {
        label: 'Profile',
        url: route('profile.show'),
    },
    {
        label: 'Submit',
        url: route('extensions.submit'),
    },
    {
        label: 'Logout',
        url: route('auth.logout'),
    },
]);

const toggleProfileMenu = (event) => {
    profileMenu.value.toggle(event);
};
</script>
