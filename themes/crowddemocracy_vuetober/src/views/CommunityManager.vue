<template>
    <div class="a-community-manager">
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
                    <div class="a-community-wrap">
                        <h4>{{ community.name }}</h4>

                        <div class="buttons">
                            <b-button
                                variant="outline-danger"
                                @click="
                                    deleteComm(community.id, community.name)
                                "
                                >Vymazať</b-button
                            >
                            <b-button
                                variant="outline-secondary"
                                @click="
                                    $store.dispatch(
                                        'selectCommunity',
                                        community.id
                                    )
                                "
                                v-b-modal.modal-prevent-closing
                                >Upraviť</b-button
                            >
                            <b-button
                                variant="outline-success"
                                @click="navigateToComm(community.id)"
                                >Príspevky</b-button
                            >
                        </div>
                    </div>
                </div>
            </b-col>
            <b-col v-else>
                <h4 class="no-community">Ešte si si nevytvoril komunitu.</h4>
            </b-col>
            <b-col class="background">
                <img class="z-background" src="../assets/bg.png" />
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
import { mapState } from "vuex";
export default {
    data() {
        return {
            name: "",
            desc: "",
            nameState: null
        };
    },
    computed: {
        ...mapState(["communities", "user"])
    },
    async mounted() {
        await this.$store.dispatch("fetchCommunities");
    },
    methods: {
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
            const valid =
                this.$refs.form.checkValidity() && this.desc.length < 60;
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
    }
};
</script>
<style lang="scss" scoped>
.a-community-manager {
    overflow-x: hidden;

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
}
textarea {
    resize: none;
    width: 100%;
}

.a-community-wrap {
    border: 1px solid #9a9eaa;
    border-radius: 8px;
    width: 50%;
    padding: 1em;
    text-align: center;
    margin-top: 2em;
    margin-left: 15%;
    transition-duration: 250ms;
    &:hover {
        border: 1.5px solid black;
        cursor: pointer;
    }
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
