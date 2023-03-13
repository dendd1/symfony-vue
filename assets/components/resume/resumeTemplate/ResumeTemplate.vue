<!--Пример внешнего вида резюме-->
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

    <div v-if=" (resume.mail == '' && resume.phone == '')">
      <p class="fs-5 form-input my-3">Ваши контакты</p>
    </div>


    <p class="fs-5 form-input my-3" >{{ resume.mail }} (тел.: +7{{ resume.phone }})</p>

    <p class="fs-5 form-input my-3">Родился {{ resume.bDate }}. Проживает в г. {{ resume.city }}</p>
    <p class="fs-5 ">О себе:</p>
    <p class="fs-5 form-input mt-2 mb-3" style="word-break: break-all;">{{ resume.about }}</p>

    <p class="fs-5 ">Навыки:</p>
    <p class="fs-5 form-input mt-2 mb-3" style="word-break: break-all;">{{ resume.skills }}</p>

    <div
        v-if="resume.education.length ===1"
        class="card-education"
    >
      <p class="fs-5 ">Образование:</p>
      <p class="fs-5 form-input mt-2 mb-3">{{ resume.education[0].type }}</p>
      <template
          v-if="resume.education[0].type !== 'Среднее'"
      >
        <p class="fs-5 ">Место получения:</p>
        <p class="fs-5 form-input mt-2 mb-3">
          Институт: {{ resume.education[0].institution }}
          <br>
          Факультет: {{ resume.education[0].faculty }}
          <br>
          Специализация: {{ resume.education[0].specialization }}
          <br>
          Год окончания: {{ resume.education[0].Year_ending }}
        </p>


        <!--        <p class="fs-5 ">Факультет:</p>-->
        <!--        <p class="fs-5 form-input mt-2 mb-3">{{ resume.education[0].faculty }}</p>-->

        <!--        <p class="fs-5 ">Специализация:</p>-->
        <!--        <p class="fs-5 form-input mt-2 mb-3">{{ resume.education[0].specialization }}</p>-->

        <!--        <p class="fs-5 ">Год окончания:</p>-->
        <!--        <p class="fs-5 form-input mt-2 mb-3">{{ resume.education[0].Year_ending }}</p>-->

      </template>
    </div>


    <template
        v-else-if="resume.education.length > 1"

    >
      <div id="carouselExampleDark" class="carousel carousel-dark slide"  data-interval="false">
        <div class="carousel-indicators">
          <button
              v-for="(education, index) in resume.education"
              :class="{ 'active': index === 0}"
              :data-bs-slide-to="`${index}`"
              type="button" data-bs-target="#carouselExampleDark"   aria-current="true" ></button>
        </div>
        <div class="carousel-inner">
          <div
              v-for="(education, index) in resume.education"
              :class="{ 'active': index === 0 }"
              class="carousel-item"  data-bs-interval="2000">
            <div class="card-education">

              <p class="fs-5 ">Образование:</p>
              <p class="fs-5 form-input mt-2 mb-3">{{ education.type }}</p>
              <template
                  v-if="education.type !== 'Среднее'"
              >
                <p class="fs-5 ">Место получения:</p>
                <p class="fs-5 form-input mt-2 mb-3">
                  Институт: {{ education.institution }}
                  <br>
                  Факультет: {{ education.faculty }}
                  <br>
                  Специализация: {{ education.specialization }}
                  <br>
                  Год окончания: {{ education.Year_ending }}
                </p>

              </template>
            </div>

          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </template>





    <p class="fs-5 text-center fw-bold text-danger">Желаемая ЗП: {{ resume.money }} (Р)</p>

  </div>

  <app-button
      v-if="!resume.isEdit"
      @click.stop="$emit('apply')"
      label="Отправить">

  </app-button>
  <app-button
      v-if="resume.isEdit"
      @click.stop="$emit('edit')"
      label="Обновить">

  </app-button>
</template>

<script>
import AppButton from "../../../ui/appButton/AppButton.vue";

export default {
  name: "ResumeTemplate",
  components: {AppButton},
  props: {
    resume: {
      required: true
    }

  }
}
</script>

<style lang="scss" scoped>
.form-row {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 0 10px 0;
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

.card-education {
  border: 1px solid rgba(0, 0, 0, .4);
  border-radius: 10px;
  height: 350px;
  padding: 10px 20px 10px 20px;
}
</style>