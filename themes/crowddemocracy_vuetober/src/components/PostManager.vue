<template>
  <div class="wrap">
    <b-row class="text-center">
      <b-col cols="1">
        <b-button to="/manage" variant="danger" class="back-button">Späť</b-button>
      </b-col>
      <b-col cols="11">
        <h1 class="title" v-bind="community">Príspevky v {{community.name}}</h1>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="posts">
        <b-button variant="success" class="new-post" v-b-modal.modal-prevent-closing>Nový prispevok</b-button>
        <div class="post" v-for="post in communityPosts" :key="post.id">
          <h5>{{post.content}}</h5>
          <p class="yes">ANO: {{post.vote_yes}}</p>
          <p class="no">NIE: {{post.vote_no}}</p>
          <b-button variant="danger" class="delete-button">Vymazať</b-button>
        </div>
      </b-col>
      <b-col>
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
            <b-form-input id="name-input" v-model="content" required :state="nameState"></b-form-input>
          </b-form-group>
        </form>
      </b-modal>
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
      communityPosts: [],
      content: "",
      nameState: null
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) {
      this.getCommunity();
      this.getPosts();
    } else {
      this.$router.push("/secure");
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
          this.communityPosts = resp.data.posts;
        })
        .catch(err => console.error(err));
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
      // Push the name to submitted names
      this.submittedNames.push(this.name);
      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    }
  }
};
</script>
<style lang="css" scoped>
.wrap {
  overflow-x: hidden;
}
.back-button {
  width: 100%;
  margin: 1em;
}
.delete-button {
  margin-left: 1em;
}
.new-post {
  width: 50%;
  margin-left: 25%;
}
.title {
  margin: 0.3em;
}
.background {
  max-width: 100%;
  height: auto;
  background-repeat: no-repeat;
  right: 0;
}
.community {
  border: 1px solid black;
  text-align: center;
  width: 50%;
  margin-top: 1em;
  margin-left: 30%;
  padding: 1em;
  transition-duration: 250ms;
}
.communities {
  margin-top: 10%;
}
.community:hover {
  background-color: rgb(189, 255, 199);
  border: 1.5px solid green;
  width: 55%;
  padding: 1.3em;
  cursor: pointer;
}
.post {
  border: 1px solid black;
  margin: 1em 2em;
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
.no,
.error {
  color: red;
}
</style>