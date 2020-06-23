<template>
  <b-navbar class="navbar-phones" toggleable type variant>
    <b-navbar-brand href="#">
      <img class="logo-navbar" src="../assets/logo.png" />
    </b-navbar-brand>

    <b-navbar-toggle target="navbar-toggle-collapse">
      <template v-slot:default="{ expanded }">
        <span v-if="expanded">&#9650;</span>
        <span v-else>&#9660;</span>
      </template>
    </b-navbar-toggle>

    <b-collapse id="navbar-toggle-collapse" is-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown text="Komunity, kde si členom" right>
          <div v-for="community in communities" :key="community.id">
            <b-dropdown-item
              href="#"
              v-if="
                                    user.communities.some(
                                        comm => comm.id === community.id
                                    )
                                "
              @click="navigateToComm(community.id)"
            >{{ community.name }}</b-dropdown-item>
          </div>
        </b-nav-item-dropdown>
        <b-nav-item href="#" to="/create">Nová komunita</b-nav-item>
        <b-nav-item href="#" @click="logout">Odhásiť sa</b-nav-item>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>
<script>
export default {};
</script>
<style lang="scss">
@media only screen and (min-width: 1020px) {
  .navbar-phones {
    display: none;
  }
}
@media only screen and (max-width: 1020px) {
  .navbar-phones {
    margin-top: 0px;
    background-color: #b3b3e6;
  }
  .logo-navbar {
    height: 2em;
  }
  .navbar-toggler {
    background-color: #7a5cc7;
  }
  .navbar-toggler:focus {
    outline: none;
  }
  .nav-link {
    color: black;
  }
}
</style>