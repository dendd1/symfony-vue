<template>
  <div class="form-row p-3">

    <p class="fs-5 mb-2 fw-bold text-danger text-center">{{ resume.status }}</p>
    <div v-if="resume.profession == ''">
      <p class="fs-5 mb-2 fw-bold text-danger">Ваша профессия</p>
    </div>
    <p class="fs-5 mb-2 fw-bold text-danger">{{ resume.profession }}</p>


    <img :src="resume.photo" class="form-out-img">

    <div v-if="resume.surname == '' &&  resume.name == '' && resume.patronymic == ''">
      <p class="fs-5 form-input my-3">Ваше ФИО</p>
    </div>

    <p class="fs-5 form-input my-3">{{ resume.surname }} {{ resume.name }} {{ resume.patronymic }}</p>

    <div v-if=" (resume.mail == ''|| resume.erMail.length > 0) && (resume.erPhone.length > 0 || resume.phone == '')">
      <p class="fs-5 form-input my-3">Ваши контакты</p>
    </div>
    <p class="fs-5 form-input my-3" v-else-if="resume.erPhone.length > 0 && resume.erMail.length == 0">{{ resume.mail }}</p>
    <p class="fs-5 form-input my-3" v-else-if="resume.erPhone.length == 0 && resume.erMail.length > 0">тел.: +7{{ resume.phone }}</p>
    <p class="fs-5 form-input my-3" v-else>{{ resume.mail }} (тел.: +7{{ resume.phone }})</p>

    <p class="fs-5 form-input my-3">Родился {{ resume.bDate }}. Проживает в г. {{ resume.city }}</p>
    <p class="fs-5 ">О себе:</p>
    <p class="fs-5 form-input mt-2 mb-3" style="word-break: break-all;">{{ resume.about }}</p>

    <p class="fs-5 ">Навыки:</p>
    <p class="fs-5 form-input mt-2 mb-3" style="word-break: break-all;">{{ resume.skills }}</p>

    <p class="fs-5 ">Образование:</p>
    <p class="fs-5 form-input mt-2 mb-3">{{ resume.education }}</p>

    <div v-if="resume.education != 'Среднее'">

      <p class="fs-5 ">Место получения образования:</p>
      <p class="fs-5 form-input mt-2 mb-3">Учебное заведение: {{ resume.institution }}</p>
      <p class="fs-5 form-input my-3">Факультет: {{ resume.faculty }}</p>
      <p class="fs-5 form-input my-3">Специализация: {{ resume.specialization }}</p>
      <p class="fs-5 form-input my-3">Год окончания: {{ resume.Year_ending }}</p>
    </div>
    <p class="fs-5 text-center fw-bold text-danger">Желаемая ЗП: {{ resume.money }} (Р)</p>

  </div>
</template>

<script>
export default {
  props: {
    resume: {
      type: Array,
      required: true
    }

  }
}
</script>

<style lang="scss" scoped>
.form-row {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 70px 10px 0px;
  border-radius: 6px;
  background: rgba(214, 214, 214, .6);
}

.form-label {
  height: 100%;
  padding: 0 8px 0 8px;
  white-space: nowrap;
}

.form-input {
  background: white;
  border-width: 0 !important;
  width: 100%;
  padding: 0 0 0 10px;
  outline: 0 none;
}
.form-out-img {
  width: 100%;
  max-height: 400px;
  object-fit: cover;
}
</style>