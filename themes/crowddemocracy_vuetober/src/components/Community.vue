<template>
    <div class="wrap">
        <a href="/home">Späť do zoznamu komunít</a>
        <b-button to="/" variant="danger">Odhlásiť sa</b-button>
        <h1 v-bind="community">{{ community.name }}</h1>
        <b-button>Najnovšie</b-button>
        <b-button>Populárne</b-button>
        <b-button>Nehlasoval som</b-button>

        <div class="posts" v-for="post in community_posts" :key="post.id">
            <h2 class="question">{{ post.content }}</h2>

            <div
                class="vote_buttons"
                v-if="!voted.some(item => item.id === post.id)"
            >
                <button class="vote_yes" @click="addVote(post.id, 'yes')">
                    YES
                </button>
                <p class="yes_count">{{ post.vote_yes }}</p>

                <button class="vote_no" @click="addVote(post.id, 'no')">
                    NO
                </button>
                <p class="yes_count">{{ post.vote_no }}</p>
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
            community_posts: {},
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
        addVote(post_id, vote) {
            this.voted.push({ id: post_id, vote: vote });
            axios.get(
                `http://crowddemocracy.test/api/v1/posts/${post_id}/vote_${vote}`
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
                    this.community_posts = res.data;
                });
        },
        changeVote(post_id) {
            let vote = this.voted.filter(item => item.id === post_id)[0];
            axios.get(
                `http://crowddemocracy.test/api/v1/posts/${post_id}/unvote_${vote.vote}`
            );
            this.voted = this.voted.filter(item => item.id !== post_id);
        }
    }
};
</script>
<style lang="css" scoped>
.yes_count {
    display: inline;
    margin-right: 2em;
}
</style>
