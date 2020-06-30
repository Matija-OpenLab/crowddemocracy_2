/
<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  methods: {}
};
</script>

<style>
.error {
  display: block;
  width: 100%;
  color: #ff3333;
  font-size: 14px;
  margin-top: 1em;
  overflow-wrap: break-word;
}
.background {
  max-width: 100%;
  min-height: 100%;
  background-repeat: no-repeat;
}
.header {
  margin-top: 3em;
  font-size: 50px;
  font-weight: 50;
  color: #48486e;
  margin-left: 130px;
}
/* .left-navbar {
  border-right: 1px solid #d7d7c1;
} */
@media only screen and (max-width: 990px) {
  body {
    margin: 0;
    padding: 0;
  }
  .header {
    margin-top: 2em;
    font-size: 2em;
    margin-left: 0px;
    text-align: center;
  }
  .footer {
    font-size: 0.9em;
  }
  .background {
    display: none;
  }
  .logo-navbar {
    height: 2em;
  }
  .back-button {
    width: 5em;
  }
  .title {
    font-size: 3em;
    margin-left: 3%;
  }
}
@media only screen and (max-width: 591px) {
  .back-button {
    margin-top: 4em;
  }
}
@media only screen and (max-width: 310px) {
  .title {
    font-size: 2em;
  }
}
</style>
