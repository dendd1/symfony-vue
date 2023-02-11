<template>
  <d-resume />
<!--  Использование названия роута. Получаем аналог тега a-->
<!--  <router-link :to="{name:'home'}" >-->
<!--    Просто текст-->
<!--  </router-link>-->
</template>

<script>
import DResume from "../components/DResume/DResume.vue";

export default {
  name: "ResumeView",
  components: {DResume}
}
</script>

<style scoped>

</style>