<template>
  <div class="wrap">
    <!-- navbar -->
    <b-row class="nav">
      <b-col cols="8">
        <p class="title">Tvoje komunity</p>
      </b-col>
      <b-col cols="4">
        <b-button to="/create" class="back-button">Späť</b-button>
      </b-col>
    </b-row>
    <!-- navbar koniec -->
    <b-row>
      <b-col class="communities" v-if="communities.length">
        <div v-for="community in communities" :key="community.id">
          <div class="community-wrap">
            <h4>{{ community.name }}</h4>

            <div class="buttons">
              <b-button
                variant="outline-danger"
                @click="
                                    deleteComm(community.id, community.name)
                                "
              >Vymazať</b-button>
              <b-button
                variant="outline-secondary"
                @click="setSelectedCommunity(community)"
                v-b-modal.modal-prevent-closing
              >Upraviť</b-button>
              <b-button variant="outline-success" @click="navigateToComm(community.id)">Príspevky</b-button>
            </div>
          </div>
        </div>
      </b-col>
      <b-col v-else>
        <h4 class="no-community">Ešte si si nevytvoril komunitu.</h4>
      </b-col>
      <b-col class="background">
        <img class="background" src="../assets/bg.png" />
      </b-col>
    </b-row>
    <div>
      <b-modal
        id="modal-prevent-closing"
        title="Upraviť komunitu"
        ok-only
        ok-title="Upraviť"
        ref="modal"
        @show="resetModal"
        @hidden="resetModal"
        @ok="handleOk"
      >
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-group
            :state="nameState"
            label="Meno:"
            label-for="name-input"
            invalid-feedback="Pole nesmie byť prázdne"
          >
            <b-form-input
              id="name-input"
              v-model="name"
              required
              :state="nameState"
              autocomplete="off"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            :state="nameState"
            label="Opis:"
            label-for="name-input"
            invalid-feedback="Pole nesmie byť prázdne a musí obsahovať najviac 60 znakov"
          >
            <b-form-textarea
              id="name-input"
              v-model="desc"
              required
              max="60"
              :state="nameState"
              autocomplete="off"
            ></b-form-textarea>
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
  data() {
    return {
      communities: [],
      selectedCommunity: {},
      name: "",
      desc: "",
      nameState: null
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn && this.user.is_activated) {
      this.getCommunity();
      this.refreshUser();
    } else {
      this.$router.push("/support");
    }
  },
  methods: {
    //Setters
    setSelectedCommunity(community) {
      this.selectedCommunity = community;
    },
    //Getters
    getCommunity() {
      axios
        .get("/api/v1/communities")
        .then(res => {
          this.communities = res.data;
          this.ownedCommunities();
        })
        .catch(err => console.error(err));
    },

    //User data and navigation
    navigateToComm(communityId) {
      this.$router.push({
        path: `/manage_posts/${communityId}`
      });
    },
    ownedCommunities() {
      const owned = this.communities.filter(community => {
        return community.owner === this.user.name;
      });
      this.communities = owned;
    },
    refreshUser() {
      this.$store
        .dispatch("refresh")
        .then(() => {})
        .catch(err => {
          console.error(err);
        });
    },

    //Community manipulation

    deleteComm(communityId, communityName) {
      this.$confirm(`Určite chceš vymazať ${communityName}?`)
        .then(() => {
          this.$store
            .dispatch("deleteCommunity", communityId)
            .then(() => this.getCommunity())
            .catch(err => console.error(err));
        })
        .catch(() => {
          return; //stops error from displaying
        });
    },
    editCommunity() {
      const communityData = {
        id: this.selectedCommunity.id,
        name: this.name,
        desc: this.desc
      };
      this.$store
        .dispatch("editCommunity", communityData)
        .then(() => this.getCommunity())
        .catch(err => console.error(err));
    },
    //Modal
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity() && this.desc.length < 60;
      this.nameState = valid;
      return valid;
    },
    resetModal() {
      this.name = "";
      this.desc = "";
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
      this.editCommunity();
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
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
textarea {
  resize: none;
  width: 100%;
}
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

.community-wrap {
  border: 1px solid #9a9eaa;
  border-radius: 8px;
  width: 50%;
  padding: 1em;
  text-align: center;
  margin-top: 2em;
  margin-left: 15%;
  transition-duration: 250ms;
}
.community-wrap:hover {
  border: 1.5px solid black;
  cursor: pointer;
}
.communities {
  margin-top: 8%;
}

.buttons {
  margin-bottom: auto;
  padding: 0.5em;
}
.no-community {
  font-size: 1em;
  color: #9a9eaa;
  font-weight: 50;
  margin-left: 3em;
}
@media only screen and (max-width: 990px) {
  .no-community {
    margin-left: 0.5em;
  }
  .community-wrap {
    width: 95%;
    margin: auto;
    margin-top: 2em;
  }
  .buttons button {
    margin-top: 1em;
  }
}
</style>
