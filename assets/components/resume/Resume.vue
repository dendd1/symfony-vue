<template>
  <div class="m-5">
    <div class="row">
      <div class="col-6">
        <h1 class="fs-3 m-3">Заполните форму:</h1>
        <!--Форма для ввода данных-->

        <resume-form @broadcast="broadcastResume"/>
      </div>
      <!--Структура генерации и вывода информации в резюме-->
      <div class="col-6">
        <h1>Ваше резюме</h1>


        <resume-template :resume="resume"/>
      </div>

    </div>
  </div>
</template>

<script>

import ResumeForm from "./resumeForm/ResumeForm.vue";
import ResumeTemplate from "./resumeTemplate/ResumeTemplate.vue";

export default {
  name: "Resume",
  components: {ResumeForm, ResumeTemplate},
  data() {
    return {
      // Готовый присет заполнения формы
      resume: {
        institution: '',
        faculty: '',
        specialization: '',
        Year_ending: '',
        profession: '',
        city: '',
        photo: '',
        surname: '',
        name: '',
        patronymic: '',
        phone: '',
        mail: '',
        bDate: '',
        education: [],
        money: '',
        skills: '',
        about: '',
        status: 'Новый'
      }

    }
  },
  methods:{
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
  }
}
</script>

<style scoped>

</style>