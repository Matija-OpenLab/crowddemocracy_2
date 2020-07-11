<template>
  <b-container fluid class="mx-0 px-0 d-block d-xl-none">
    <b-navbar class="a-navbar-phones m-0" toggleable="md" type="dark">
      <b-navbar-brand href="#">
        <img class="logo-navbar" src="../assets/images/logo.png" />
      </b-navbar-brand>

      <b-navbar-toggle target="toggle-collapse">
        <template v-slot:default="{ expanded }">
          <span v-if="expanded">&#9650;</span>
          <span v-else>&#9660;</span>
        </template>
      </b-navbar-toggle>

      <b-collapse id="toggle-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown text="Komunity, kde si členom" right>
            <div v-for="community in communities" :key="community.id">
              <b-dropdown-item
                href="#"
                v-if="user.communities.some(comm => comm.id === community.id)"
                @click="navigateToComm(community.id)"
              >{{ community.name }}</b-dropdown-item>
            </div>
          </b-nav-item-dropdown>
          <b-nav-item href="#" to="/create">Nová komunita</b-nav-item>
          <b-nav-item href="#" @click="logout">Odhásiť sa</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </b-container>
</template>
<script>
import { mapGetters, mapState } from "vuex";
export default {
  methods: {
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    }
  },
  computed: {
    ...mapState(["communities"]),
    ...mapGetters({
      user: "getUserData"
    })
  }
};
</script>
<style lang="scss">
.a-navbar-phones {
  background-color: #b3b3e6;

  .toggler {
    background-color: #7a5cc7;
    &:focus {
      outline: none;
    }
  }

  @media only screen and (max-width: 1230px) {
    .a-navbar-phones {
      background-color: #b3b3e6;

      .logo-navbar {
        height: 2em;
      }
      .toggler {
        background-color: #7a5cc7;
        &:focus {
          outline: none;
        }
      }
    }
  }
}
</style>