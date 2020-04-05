<template>
    <div class="wrap">
        <a href="/home">Späť do zoznamu komunít</a>
        <b-button to="/" variant="danger">Odhlásiť sa</b-button>
        <h1 v-bind="community">{{ community.name }}</h1>
        <b-button>Najnovšie</b-button>
        <b-button>Populárne</b-button>
        <b-button>Nehlasoval som</b-button>

        <div class="posts" v-for="post in communityPosts" :key="post.id">
            <h2 class="question">{{ post.content }}</h2>

            <div
                class="vote_buttons"
                v-if="!voted.some(item => item.id === post.id)"
            >
                <button class="vote-yes" @click="addVote(post.id, 'yes')">
                    YES
                </button>
                <p class="yes-count">{{ post.vote_yes }}</p>

                <button class="vote_no" @click="addVote(post.id, 'no')">
                    NO
                </button>
                <p class="yes-count">{{ post.vote_no }}</p>
            </div>
            <div v-else>
                <button @click="changeVote(post.id)">Change Vote</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    props: {
        id: {
            type: String
        }
    },
    data() {
        return {
            community: {},
            communityPosts: {},
            voted: []
        };
    },
    created() {
        fetch(`http://crowddemocracy.test/api/v1/communities/${this.$props.id}`)
            .then(res => res.json())
            .then(json => {
                this.community = json[0];
            });
        this.getPosts();
    },
    methods: {
        addVote(postId, vote) {
            this.voted.push({ id: postId, vote: vote });
            axios.get(
                `http://crowddemocracy.test/api/v1/posts/${postId}/vote_${vote}`
            );
            var vm = this;
            vm.getPosts();
        },
        getPosts() {
            axios
                .get(
                    `http://crowddemocracy.test/api/v1/posts/community_id/${this.$props.id}`
                )
                .then(res => {
                    this.communityPosts = res.data;
                });
        },
        changeVote(postId) {
            const vote = this.voted.filter(item => item.id === postId)[0];
            axios.get(
                `http://crowddemocracy.test/api/v1/posts/${postId}/unvote_${vote.vote}`
            );
            this.voted = this.voted.filter(item => item.id !== postId);
        }
    }
};
</script>
<style lang="css" scoped>
.yes-count {
    display: inline;
    margin-right: 2em;
}
</style>
