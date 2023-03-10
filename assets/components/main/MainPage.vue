<template>

  <div class="p-5">
    <router-link :to="{ name: 'resume' }" class="nav-link text-secondary fw-bolder">
      <app-button
          label="Добавить резюме"
      >
      </app-button>
    </router-link>
    <div class="row mt-5">
      <div class="col-3">
        <p class="fs-2 text-center">Новый</p>


        <resume-mini
            profession="профессия"
            photo="https://sun9-34.userapi.com/impg/Frc_g6zg0wNF4rkc1uG9QQDYBVFhlCIuM6bObg/ViqFAEmwklI.jpg?size=828x777&quality=96&sign=0e483344197acae3810b668e852ff5cb&type=album"
            surname="Ф"
            name="И"
            patronymic="О"
            b-date="2023-03-22"
        >

        </resume-mini>



      </div>
      <div class="col-3">
        <p class="fs-2 text-center">Назначен.собес.</p>


      </div>
      <div class="col-3">
        <p class="fs-2 text-center">принят</p>


      </div>
      <div class="col-3">
        <p class="fs-2 text-center">отказ</p>


      </div>
    </div>
  </div>

</template>

<script>
import AppButton from "../../ui/appButton/AppButton.vue";
import ResumeMini from "../../ui/resumeMini/ResumeMini.vue";

export default {
  name: "MainPage",
  components: {ResumeMini, AppButton}
}
</script>

<style scoped>

</style>