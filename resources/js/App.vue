<template>
    <v-app>
        <Header />
        <main class="main-contents">
            <router-view />
        </main>
        <Footer />
    </v-app>
</template>
<script>
import Header from "./components/MeHeader";
import Footer from "./components/MeFooter";

export default {
    name: "App",
    components: {
        Header,
        Footer,
    },
};
</script>
