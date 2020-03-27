<template>
    <div class="wrap">
        <a href="/home">Späť do zoznamu komunít</a>
        <b-button to="/" variant="danger">Odhlásiť sa</b-button>
        <h1 v-bind="community">{{ community.name }}</h1>
        <b-button>Najnovšie</b-button>
        <b-button>Populárne</b-button>
        <b-button>Nehlasoval som</b-button>

        <div
            class="posts"
            v-for="(post, index) in community_posts"
            :key="index"
        >
            <h2 class="question">{{ post.content }}</h2>

            <button class="vote_yes" @click="addVote('yes', post.id)">
                YES
            </button>
            <p class="yes_count">{{ post.vote_yes }}</p>

            <button class="vote_no">NO</button>
            <p class="yes_count">{{ post.vote_no }}</p>

            <p>{{ totalVotes }}</p>
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
            community: null,
            community_posts: null,
            totalVotes: null
        };
    },
    mounted() {
        fetch(`http://crowddemocracy.test/api/v1/communities/${this.$props.id}`)
            .then(res => res.json())
            .then(json => {
                this.community = json[0];
            });
        this.getPosts();
    },
    methods: {
        addVote(vote, post_id) {
            var vm = this;
            axios.get(
                `http://crowddemocracy.test/api/v1/posts/${post_id}/vote_${vote}`
            );
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
