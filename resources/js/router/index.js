import { createRouter, createWebHistory } from "vue-router";
import MeTop from "../pages/MeTop";
import Question from "../pages/SendQuestion";
import ConfirmAndPassword from "../pages/ConfirmAndPassword";
import ShareUrl from "../pages/ShareUrl";
import ConfirmBrowsingAuthority from "../pages/ConfirmBrowsingAuthority";
import ShowAnswer from "../pages/ShowAnswer";

const routes = [
    {
        path: "/",
        component: MeTop,
        name: "top",
    },
    {
        path: "/question",
        component: Question,
        name: "question",
    },
    {
        path: "/confirm",
        component: ConfirmAndPassword,
        name: "confirm-url",
    },
    {
        path: "/share_url",
        component: ShareUrl,
        name: "share-url",
    },
    {
        path: "/answer_show/:share_id",
        component: ConfirmBrowsingAuthority,
    },
    {
        path: "/show/certified",
        component: ShowAnswer,
        name: "show-certified",
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
