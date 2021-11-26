<template>
    <div class="share-url-contents">
        <h3>回答を共有</h3>
        <p v-show="!getShareInfo['show_url']">読み込み中です。</p>
        <div v-show="getShareInfo['show_url']" class="share-info-area">
            <div class="share_url_area">
                <p>下記のURLで今の回答をシェアできます！</p>
                <div class="display-url-area">
                    <p class="head-txt">
                        共有用URL： {{ getShareInfo["show_url"] }}
                    </p>
                    <button class="copy-button" @click="copyUrl">
                        URLをコピーする
                    </button>
                </div>
                <p class="head-txt">
                    閲覧期限：{{ getShareInfo["show_limit"] }}まで
                </p>
                <p class="head-txt">
                    パスワード：{{ getShareInfo["pass_mosaic"] }}
                </p>
                <p>※ブラウザを閉じると終了します。</p>
            </div>
            <div class="top-link-area">
                <router-link to="/" class="top-back-link">
                    <middle-button :text="top_link_txt"></middle-button>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import MiddleButton from "../components/module/MiddleButton";

export default {
    name: "ShareUrl",
    components: { MiddleButton },
    data() {
        return {
            top_link_txt: "TOPへ戻る",
            user_share_info: null,
        };
    },
    methods: {
        copyUrl() {
            this.$copyText(this.getShareInfo["show_url"]).then(
                function () {
                    alert("共有用のURLをコピーしました！");
                },
                function () {
                    alert("共有用のURLコピーに失敗しました");
                }
            );
        },
    },
    computed: {
        getShareInfo() {
            return this.$store.state.shareInfo.share_info;
        },
    },
};
</script>

<style scoped>
.share-url-contents {
    width: 900px;
}
.top-back-link {
    text-decoration: unset;
}
.head-txt {
    padding: 1em;
    color: #0e0e0e;
    background-color: #e7e5e5;
    border-radius: 5px;
    font-size: 15px;
}
</style>
