<template>
  <resume />
<!--  Использование названия роута. Получаем аналог тега a-->
<!--  <router-link :to="{name:'home'}" >-->
<!--    Просто текст-->
<!--  </router-link>-->
</template>

<script>
import Resume from "../components/resume/Resume.vue";

export default {
  name: "ResumeView",
  components: {Resume}
}
</script>

<style scoped>

</style>