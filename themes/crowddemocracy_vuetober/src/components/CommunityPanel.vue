<template>
  <div>
    <div class="community" v-for="community in communities" :key="community.id">
      <div @click="navigateToComm(community.id)">
        <!-- napicu ale cenim ze to musim robit ja -Matija <3 -->
        <img v-if="community.icon_id === '0'" class="com-logo" src="../assets/com-log1.png" />
        <img v-if="community.icon_id === '1'" class="com-logo" src="../assets/com-log2.png" />
        <img v-if="community.icon_id === '2'" class="com-logo" src="../assets/com-log3.png" />
        <p class="com-count">{{ community.user_count }} užívateľov</p>
        <p class="com-name">{{ community.name }}</p>
        <div v-if="community.icon_id === '0'" class="com-desc color1">
          <p class="small-desc">Popis komunity</p>
          <p>{{ community.description }}</p>
        </div>
        <div v-if="community.icon_id === '1'" class="com-desc color2">
          <p class="small-desc">Popis komunity</p>
          <p>{{ community.description }}</p>
        </div>
        <div v-if="community.icon_id === '2'" class="com-desc color3">
          <p class="small-desc">Popis komunity</p>
          <p>{{ community.description }}</p>
        </div>
        <!-- <p class="com-create">{{ community.created_at.split(" ")[0] }}</p> -->

        <b-row class="com-footer">
          <b-col cols="8">
            <p
              class="add-to-com"
              v-if="
                                            !user.communities.some(
                                                comm => comm.id === community.id
                                            )
                                        "
              @click="joinCommunity(community.id)"
            >+ pridaj sa do tejto komunity</p>
          </b-col>
          <b-col>
            <p class="com-owner">{{ community.owner }}</p>
          </b-col>
        </b-row>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style lang="scss">
</style>