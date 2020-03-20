<template>
  <div class="wrap" v-bind="community">
    <h1>{{community.name}}</h1>
    <b-button>Pridaj sa</b-button>
    <div class="community-info">
      <h2>Informácie o komunite</h2>

      <div class="desc">
        <p>Opis:</p>
        <p>{{community.description}}</p>
      </div>

      <div class="userCount">
        <p>Počet členov:</p>
        <p>{{community.user_count}}</p>
      </div>

      <div class="createDate">
        <p>Dátum vytvorenia:</p>
        <p>{{community.created_at}}</p>
      </div>

      <div class="moderators">
        <p>Moderátori:</p>
        <p>IN DEVELOPMENT</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    name: {
      type: String
    }
  },
  data() {
    return {
      community: null
    };
  },
  mounted() {
    fetch(
      `http://crowddemocracy.test/api/communities//${this.$props.name}/show`
    )
      .then(res => res.json())
      .then(json => {
        this.community = json.data;
      });
  }
};
</script>
<style scoped>
</style>