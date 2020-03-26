<template>
  <div class="wrap">
    <a href="/home">Späť do zoznamu komunít</a>
    <b-button to="/" variant="danger">Odhlásiť sa</b-button>
    <h1 v-bind="community">{{community.name}}</h1>
    <b-button>Najnovšie</b-button>
    <b-button>Populárne</b-button>
    <b-button>Nehlasoval som</b-button>
    <div class="posts" v-for="(post, index) in community_posts" :key="index">
      <h2 class="question">{{post.content}}</h2>
      <p class="vote_yes">{{post.vote_yes}}</p>
      <p class="vote_no">{{post.vote_no}}</p>
      <p>{{totalVotes}}</p>
    </div>
  </div>
</template>
<script>
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
    fetch(
      `http://crowddemocracy.test/api/v1/posts/community_id/${this.$props.id}`
    )
      .then(res => res.json())
      .then(json => {
        this.community_posts = json;
      });
  }
};
</script>