<template>
  <div class="wrap">
    <!-- navbar -->
    <b-row class="nav">
      <b-col cols="8">
        <p class="title">Príspevky v {{ community.name }}</p>
      </b-col>
      <b-col cols="4">
        <b-button to="/manage" class="back-button">Späť</b-button>
      </b-col>
    </b-row>
    <!-- navbar koniec -->
    <b-row>
      <b-col class="posts">
        <b-button
          variant="outline-success"
          class="new-post"
          v-b-modal.modal-prevent-closing
        >Nový príspevok</b-button>
        <div class="post" v-for="post in communityPosts" :key="post.id">
          <h5 class="post-content">{{ post.content }}</h5>
          <p class="yes">Áno: {{ post.vote_yes }}</p>
          <p class="no">Nie: {{ post.vote_no }}</p>
          <b-button variant="danger" class="delete-button" @click="deletePost(post.id)">Vymazať</b-button>
          <div v-if="post.is_finished === '0'" class="mb-2 finish">
            <b-button variant="success" class="delete-button" @click="finishPost(post.id)">Ukončiť</b-button>
          </div>
          <div v-else>
            <p>Hlasovanie bolo ukončené.</p>
          </div>
        </div>
      </b-col>
      <b-col class="background">
        <img class="background" src="../assets/bg.png" />
      </b-col>
    </b-row>
    <div>
      <b-modal
        id="modal-prevent-closing"
        title="Nový príspevok"
        ok-only
        ok-title="Pridať"
        ref="modal"
        @show="resetModal"
        @hidden="resetModal"
        @ok="handleOk"
      >
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-group
            :state="nameState"
            label="Príspevok:"
            label-for="name-input"
            invalid-feedback="Pole nesmie byť prázdne"
          >
            <b-form-input
              id="name-input"
              v-model="content"
              required
              :state="nameState"
              autocomplete="off"
            ></b-form-input>
          </b-form-group>
        </form>
      </b-modal>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  props: {
    id: {
      type: String
    }
  },
  data() {
    return {
      community: {},
      communityPosts: [],
      content: "",
      nameState: null
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn && this.user.is_activated) {
      this.getCommunity();
      this.getPosts();
      this.refreshUser();
    } else {
      this.$router.push("/support");
    }
  },
  methods: {
    //Getters
    getCommunity() {
      axios.get(`/api/v1/communities/${this.$props.id}`).then(resp => {
        this.community = resp.data[0];
      });
    },
    getPosts() {
      axios
        .get(`/api/v1/posts/community_id/${this.$props.id}`)
        .then(resp => {
          this.communityPosts = resp.data.posts.reverse();
          console.log(this.communityPosts);
        })
        .catch(err => console.error(err));
    },

    //Post manipulation
    createPost() {
      let data = {
        content: this.content,
        communityId: this.$props.id
      };
      this.$store
        .dispatch("createPost", data)
        .then(() => {
          this.getPosts();
        })
        .catch(() => (this.error = "Nepodarilo sa vytvoriť príspevok"));
    },
    deletePost(postId) {
      this.$confirm(
        `Určite chceš vymazať hlasovanie? Keď ho raz vymažeš už ho nemôžeš obnoviť!`
      ).then(() => {
        this.$store
          .dispatch("deletePost", postId)
          .then(() => this.getPosts())
          .catch(err => console.error(err));
      });
    },
    finishPost(postId) {
      this.$confirm(
        `Určite chceš ukončiť hlasovanie? Keď ho raz ukončíš už ho nemôžeš obnoviť!`
      ).then(() => {
        console.log(postId);
        this.$store
          .dispatch("finishPost", postId)
          .then(() => this.getPosts())
          .catch(err => console.error(err));
      });
    },
    //Modal handeling
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.nameState = valid;
      return valid;
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      this.createPost();
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    },
    //User actions
    refreshUser() {
      this.$store
        .dispatch("refresh")
        .then(() => {})
        .catch(err => {
          console.error(err);
        });
    }
  },
  computed: {
    ...mapGetters({
      user: "getUserData"
    })
  }
};
</script>
<style lang="css" scoped>
/* navbar */
.nav {
  line-height: 5em;
}
.back-button {
  width: 50%;
  border-color: #48486e;
  color: #48486e;
  background-color: white;
}
.title {
  font-size: 4em;
  margin-left: 10%;
  font-weight: 50;
  color: #48486e;
}
/* post manager */
.delete-button {
  margin-left: 1em;
}
.finish {
  display: inline;
}
.new-post {
  width: 91.5%;
  margin-top: 30px;
  margin-left: 30px;
}
/* post */
.post {
  border: 1px solid black;
  border-radius: 8px;
  margin: 2em 2em;
  text-align: center;
  font-size: 1em;
  transition-duration: 250ms;
}
.post:hover {
  background-color: rgb(221, 221, 221);
}
.post p {
  display: inline-block;
  margin: 1em;
  font-weight: 500;
}
.yes {
  color: green;
}
.post-content {
  font-weight: 50;
}
@media only screen and (max-width: 990px) {
  .post {
    width: 95%;
    margin: auto;
    margin-top: 2em;
  }
  .new-post {
    width: 95%;
    margin-left: 3%;
  }
}
</style>
s