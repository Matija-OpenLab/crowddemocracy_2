<template>
  <div class="wrap" v-bind="community">
    <a href="/home">Späť do zoznamu komunít</a>
    <b-button to="/" variant="danger">Odhlásiť sa</b-button>
    <h1>{{community.name}}</h1>
    <b-button>Najnovšie</b-button>
    <b-button>Populárne</b-button>
    <b-button>Nehlasoval som</b-button>
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
      community: null
    };
  },
  mounted() {
    fetch(`http://crowddemocracy.test/api/communities//${this.$props.id}/show`)
      .then(res => res.json())
      .then(json => {
        this.community = json.data;
      });
  }
};
</script>