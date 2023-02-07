<template>
  <div class="m-5">
    <div class="row">
      <div class="col-6">
        <h1 class="fs-3 m-3">Заполните форму:</h1>
        <!--Форма для ввода данных-->

        <d-form  @broadcast="broadcastResume"/>
      </div>
      <!--Структура генерации и вывода информации в резюме-->
      <div class="col-6">
        <h1>Ваше резюме</h1>


        <d-template :resume="resume"/>
      </div>

    </div>
  </div>
</template>

<script>

import DTemplate from "./DTemplate/DTemplate.vue";
import DForm from "./DForm/DForm.vue";

export default {
  name: "DResume",
  components: {DForm, DTemplate},
  data() {
    return {
      // Готовый присет заполнения формы
      resume: {
        institution: '',
        faculty: '',
        specialization: '',
        Year_ending: '',
        erPhone: '',
        erMail: '',
        profession: '',
        city: '',
        photo: '',
        surname: '',
        name: '',
        patronymic: '',
        phone: '',
        mail: '',
        bDate: '',
        education: 'Среднее',
        money: '',
        skills: '',
        about: '',
        status: 'Новый'
      }

    }
  },
  methods:{
    broadcastResume(resume) {
      this.resume.institution = resume.institution;
      this.resume.faculty = resume.faculty;
      this.resume.specialization = resume.specialization;
      this.resume.Year_ending = resume.Year_ending;
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
    // loadApi(){
    //   $.ajax({
    //     url: 'https://api.vk.com/method/database.getCities?q=санкт&need_all=1&access_token=vk1.a.s2tzzpX3uVR-ItDbrQG7ee0C9Xxo-vrmxIdHtQHdbmHS_jEHgmq9pZiL7W2Lzoo8GemRk6tuvO81GyOrzn-3ZvlReA-IfOTMXP7VWAZ2rllpCFEPhufpD0heoaZQk8cljg8fuQs0TtmPKTJexJWP7Kic-O3qOz9TN6XHhMNDsCR2PTsFKmRpIIFUSzGAq7-kGhZpyWR1WUclm1sjT3dWNg&expires_in=86400&v=5.131',
    //     method: 'GET',
    //     dataType: 'JSONP',
    //     success:{
    //       function(data){
    //         console.log(data);
    //       }
    //     }
    //   });
    // }
  }
}
</script>

<style scoped>

</style>