<template>
  <router-link :to="{ name: 'main' }" class="nav-link text-secondary fw-bolder pt-5 px-5">
    <app-button
        label="На главную"
    >
    </app-button>
  </router-link>

  <template v-if="!loading">
    <div class="m-5">
      <div class="row">
        <div class="col-6">
          <h1 class="fs-3 m-3">Заполните форму:</h1>


          <resume-form
              @broadcast="broadcastResume"

              :resume-from-d-b="resume"
          />
        </div>

        <div class="col-6">
          <h1 class="fs-3 m-3">Ваше резюме</h1>


          <resume-template
              :resume="resume"
              @apply="apply"
              @edit="edit"
          />
        </div>

      </div>
    </div>
  </template>

  <app-spinner v-else/>

</template>

<script>

import ResumeForm from "./resumeForm/ResumeForm.vue";
import ResumeTemplate from "./resumeTemplate/ResumeTemplate.vue";
import AppButton from "../../ui/appButton/AppButton.vue";
import {ResumeApi} from "../../api/resumeApi/ResumeApi";
import AppSpinner from "../../ui/appSpinner/AppSpinner.vue";

export default {
  name: "Resume",
  components: {AppSpinner, AppButton, ResumeForm, ResumeTemplate},
  props: {
    id: {
      type: String,
      required: false,
      default: null,
    },
  },
  created() {
    if (this.id) {
      this.loadResume(this.id)
    }
  },
  data() {
    return {
      resume: {
        profession: '',
        city: '',
        photo: '',
        surname: '',
        name: '',
        patronymic: '',
        phone: '',
        mail: '',
        bDate: '',
        education: [
          {id: new Date(), type: 'Среднее', institution: '', faculty: '', specialization: '', Year_ending: '',}
        ],
        money: '',
        skills: '',
        about: '',
        status: 'Новый',
        isEdit: false,
      },
      loading: false,

    }
  },
  methods: {
    broadcastResume(resume) {
      this.resume.erPhone = resume.erPhone;
      this.resume.erMail = resume.erMail;
      this.resume.profession = resume.profession;
      this.resume.city = resume.city;
      this.resume.photo = resume.photo;
      this.resume.surname = resume.surname;
      this.resume.name = resume.name;
      this.resume.patronymic = resume.patronymic;
      this.resume.phone = resume.phone;
      this.resume.mail = resume.mail;
      this.resume.bDate = resume.bDate;
      this.resume.education = resume.education;
      this.resume.bDate = resume.bDate;
      this.resume.money = resume.money;
      this.resume.skills = resume.skills;
      this.resume.about = resume.about;
      this.resume.status = resume.status;

    },
    async apply() {
      this.loading = true;
      let result = await ResumeApi.postResume(this.resume);
      if (result) alert(`Резюме успешно добавлено!`);
      else alert(`Произошла неизвестная ошибка!`);
      this.loading = false;
      this.$router.push({name: 'main'});
    },
    async edit() {
      this.loading = true;
      if (this.id !== null) {
        let result = await ResumeApi.editResume(this.id, this.resume);
        if (result) alert(`Резюме отредактировано!`);
        else alert(`Произошла неизвестная ошибка!`);
      } else {
        alert('id is null');
      }
      this.loading = false;
      this.$router.push({name: 'main'});
    },
    async loadResume(id) {
      this.loading = true;
      let result = await ResumeApi.getResume(id);
      if (result.result) {
        this.resume.profession = result.result.profession;
        this.resume.city = result.result.city;
        this.resume.photo = result.result.photo;
        this.resume.surname = result.result.surname;
        this.resume.name = result.result.name;
        this.resume.patronymic = result.result.patronymic;
        this.resume.phone = result.result.phone;
        this.resume.mail = result.result.mail;
        this.resume.bDate = result.result.bDate;
        this.resume.education = result.result.education;
        this.resume.bDate = result.result.bDate;
        this.resume.money = result.result.money;
        this.resume.skills = result.result.skills;
        this.resume.about = result.result.about;
        this.resume.status = result.result.status;
        this.resume.isEdit = true;
      } else {
        alert(`Произошла неизвестная ошибка`);
        this.$router.push({name: 'main'});
      }

      this.loading = false;

    },
  },
  watch: {
    id(newValue) {
      this.$router.push({name: 'edit', params: {id: this.id}});
    },
  },
}
</script>

<style scoped>

</style>