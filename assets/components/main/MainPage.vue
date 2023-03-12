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

        <template
        v-for="resume in resumeMini.result"
        >

          <resume-mini
              v-if="resume.status === 'Новый'"
              :profession="resume.profession"
              :photo="resume.photo"
              :surname="resume.surname"
              :name="resume.name"
              :patronymic="resume.patronymic"
              :b-date="resume.bDate"
              :id="resume.id"
          >

          </resume-mini>
        </template>


      </div>
      <div class="col-3">
        <p class="fs-2 text-center">Назначен.собес.</p>

        <template
            v-for="resume in resumeMini.result"
        >

          <resume-mini
              v-if="resume.status === 'Назначено собеседование'"
              :profession="resume.profession"
              :photo="resume.photo"
              :surname="resume.surname"
              :name="resume.name"
              :patronymic="resume.patronymic"
              :b-date="resume.bDate"
              :id="resume.id"
          >

          </resume-mini>
        </template>

      </div>
      <div class="col-3">
        <p class="fs-2 text-center">принят</p>

        <template
            v-for="resume in resumeMini.result"
        >

          <resume-mini
              v-if="resume.status === 'Принят'"
              :profession="resume.profession"
              :photo="resume.photo"
              :surname="resume.surname"
              :name="resume.name"
              :patronymic="resume.patronymic"
              :b-date="resume.bDate"
              :id="resume.id"
          >

          </resume-mini>
        </template>


      </div>
      <div class="col-3">
        <p class="fs-2 text-center">отказ</p>

        <template
            v-for="resume in resumeMini.result"
        >

          <resume-mini
              v-if="resume.status === 'Отказ'"
              :profession="resume.profession"
              :photo="resume.photo"
              :surname="resume.surname"
              :name="resume.name"
              :patronymic="resume.patronymic"
              :b-date="resume.bDate"
              :id="resume.id"
          >

          </resume-mini>

        </template>
      </div>
    </div>
  </div>

</template>

<script>
import AppButton from "../../ui/appButton/AppButton.vue";
import ResumeMini from "../../ui/resumeMini/ResumeMini.vue";
import {ResumeApi} from "../../api/resumeApi/ResumeApi";

export default {
  name: "MainPage",
  components: {ResumeMini, AppButton},
  created() {
    this.loadResume()
  },
  data() {
    return {
      resumeMini: [
        // {id: 1, status: 'Новое', profession: '', photo: '', surname: '', name: '', patronymic: '', bDate: ''}
      ],
    }
  },
  methods:{
    async loadResume() {

      let result = await ResumeApi.getResumeList();
      if (!result)alert(`Произошла неизвестная ошибка`);



      this.resumeMini= result ;

    },

  }
}
</script>

<style scoped>

</style>