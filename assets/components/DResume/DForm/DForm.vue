<template>
  <form
      @keydown.esc="
      resume.apiCities = [];
      resume.apiUniversity = [];
      "
      @click="
      resume.apiCities = [];
      resume.apiUniversity = [];
      "
  >

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Статус</p>

      <!--Поле для выбора степени образования-->

      <select
          @change="broadcastResume"
          v-model="resume.status" class="form-input  fs-5">
        <option>Новый</option>
        <option>Назначено собеседование</option>
        <option>Принят</option>
        <option>Отказ</option>
      </select>


    </div>
    <div class="d-flex form-row justify-content-center align-items-center">
      <p class="fs-5 form-label">Профессия</p>
      <!--Поле для ввода профессии-->
      <input
          @input="broadcastResume"
          v-model="resume.profession" class="form-input  fs-5" type="text" maxlength="35">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">
      <p class="fs-5 form-label">Фалимия</p>
      <!--Поле для ввода фамилии-->
      <input
          @input="broadcastResume"
          v-model="resume.surname" class="form-input  fs-5" type="text" maxlength="35">
    </div>


    <div class="d-flex form-row justify-content-center align-items-center">

      <!--Поле для ввода имени-->
      <p class="fs-5 form-label">Имя</p>


      <input
          @input="broadcastResume"
          v-model="resume.name" class="form-input  fs-5" type="text" maxlength="35">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Отчество</p>


      <!--Поле для ввода Отчества-->
      <input
          @input="broadcastResume"
          v-model="resume.patronymic" class="form-input  fs-5" type="text" maxlength="35">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center"
         style="position: relative;">

      <p class="fs-5 form-label">Город</p>


      <!--Поле для ввода города-->
      <input
          v-model="resume.city"
          @input="getCity();broadcastResume();"
          list="cities"
          class="form-input  fs-5" type="text" maxlength="20">

      <template v-if="resume.apiCities.length && resume.city"

      >


        <div
            style="position: absolute; z-index: 1200; display: block;
          left: 50px;
          top: 0;"
            class="input-border-message   mt-5 p-3">

          <div
              v-for="city in resume.apiCities"
              :key="city.id"
              @click.stop="
            resume.city = city.title;
            resume.apiCities = [];
            broadcastResume();
            "
              style="cursor: pointer"
              class="w-100 mb-1">
            <p class="fs-5">
              {{ city.title }}
            </p>

          </div>

        </div>
      </template>

    </div>
    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Фото</p>


      <!--Поле для загрузки ссылки на фото-->
      <input
          @input="broadcastResume"
          v-model="resume.photo" class="form-input  fs-5" type="text">

    </div>

    <p class="fs-5 text-danger">{{ resume.erPhone }}</p>
    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Телефон(+7)</p>


      <!--Поле для ввода телефона-->
      <input v-model="resume.phone" @input="validatePhone();broadcastResume();" class="form-input  fs-5" type="text">


    </div>

    <p class="fs-5 text-danger">{{ resume.erMail }}</p>
    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Почта</p>


      <!--Поле для ввода почты-->
      <input v-model="resume.mail" @input="validateMail();broadcastResume();" class="form-input  fs-5" type="text" maxlength="35">

    </div>


    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Дата рождения</p>


      <!--Поле для указания даты рождения-->
      <input
          @change="broadcastResume"
          v-model="resume.bDate" class="form-input  fs-5" type="date">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">О себе</p>


      <!--Поле для ввода информации о личных качествах-->
      <textarea
          @input="broadcastResume"
          v-model="resume.about" class="form-input  fs-5" maxlength="350"
                rows="7"></textarea>

    </div>

    <template v-if="resume.education.length > 1">
      <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-interval="false"
           data-bs-touch="false"
           style="  margin: 10px 70px 10px 0;">


        <div class="carousel-indicators">
          <button
              v-for="(education, index) in resume.education"
              :class="{ 'active': index === 0}"
              :data-bs-slide-to="`${index}`"
              type="button" data-bs-target="#carouselExampleIndicators"   aria-current="true" ></button>
        </div>
        <div class="carousel-inner">


          <div
              v-for="(education, index) in resume.education"
              :class="{ 'active': index === 0 }"
              class="carousel-item">

            <div class="card-education">

              <div class="d-flex justify-content-between">
                <svg
                    @click="addEducation();broadcastResume();"
                    style="z-index: 9999;"
                    xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus m-1"
                    viewBox="0 0 16 16">
                  <path
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <svg
                    @click="deleteEducation(education);broadcastResume();"
                    style="z-index: 9999;"
                    xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x m-1"
                    viewBox="0 0 16 16">
                  <path
                      d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
              </div>

              <div class="d-flex form-row-card-education justify-content-center align-items-center">
                <p class="fs-5 form-label">Образование</p>
                <!--Поле для выбора степени образования-->
                <select
                    @change="broadcastResume"
                    v-model="education.type" class="form-input  fs-5">
                  <option>Среднее</option>
                  <option>Среднее специальное</option>
                  <option>Неоконченное высшее</option>
                  <option>Высшее</option>
                </select>
              </div>

              <template v-if="education.type !== 'Среднее'">


                <div class="d-flex form-row-card-education justify-content-center align-items-center"
                     style="position: relative;">

                  <p class="fs-5 form-label">Учеб. заведение</p>


                  <!--Поле для ввода названия учебного заведения-->
                  <input
                      v-model="education.institution"
                      @input="getUniversity(education.institution);broadcastResume();"
                      list="universities"

                      class="form-input  fs-5" type="text"
                      maxlength="35">
                  <template v-if="resume.apiUniversity.length && education.institution"

                  >


                    <div
                        style="position: absolute; z-index: 1200; display: block;
            left: 50px;
            top: 0;"
                        class="input-border-message   mt-5 p-3">

                      <div
                          v-for="university in resume.apiUniversity"
                          :key="university.id"
                          @click="
                            education.institution = university.title;
                            resume.apiUniversity = []
                          "
                          style="cursor: pointer"
                          class="w-100 mb-1">
                        <p class="fs-5">
                          {{ university.title }}
                        </p>

                      </div>

                    </div>
                  </template>


                </div>

                <div class="d-flex form-row-card-education justify-content-center align-items-center">

                  <p class="fs-5 form-label">Факультет</p>


                  <!--Поле для ввода названия факультета-->
                  <input
                      @input="broadcastResume"
                      v-model="education.faculty" class="form-input  fs-5" type="text" maxlength="35">


                </div>

                <div class="d-flex form-row-card-education justify-content-center align-items-center">

                  <p class="fs-5 form-label">Специализация</p>


                  <!--Поле для ввода названия специализации-->
                  <input
                      @input="broadcastResume"
                      v-model="education.specialization" class="form-input  fs-5" type="text"
                         maxlength="35">


                </div>

                <div class="d-flex form-row-card-education justify-content-center align-items-center">

                  <p class="fs-5 form-label">Год окончания</p>


                  <!--Поле для ввода года окончания-->
                  <input
                      @input="broadcastResume"
                      v-model="education.Year_ending" type="number" class="form-input  fs-5"
                         maxlength="4" min="1900" max="2023"
                         step="1"/>


                </div>
              </template>
            </div>

          </div>


        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>


      </div>
    </template>
    <template v-else-if="resume.education.length === 1">
      <div class="card-education" style="margin-right: 70px;">

        <div class="d-flex justify-content-between">
          <svg
              @click="addEducation();broadcastResume();"
              style="z-index: 9999;"
              xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus m-1"
              viewBox="0 0 16 16">
            <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>

        </div>

        <div class="d-flex form-row-card-education justify-content-center align-items-center">
          <p class="fs-5 form-label">Образование</p>
          <!--Поле для выбора степени образования-->
          <select
              @change="broadcastResume"
              v-model="resume.education[0].type" class="form-input  fs-5">
            <option>Среднее</option>
            <option>Среднее специальное</option>
            <option>Неоконченное высшее</option>
            <option>Высшее</option>
          </select>
        </div>

        <template v-if="resume.education[0].type !== 'Среднее'">


          <div class="d-flex form-row-card-education justify-content-center align-items-center"
               style="position: relative;">

            <p class="fs-5 form-label">Учеб. заведение</p>


            <!--Поле для ввода названия учебного заведения-->
            <input
                v-model="resume.education[0].institution"
                @input="getUniversity(resume.education[0].institution);broadcastResume();"
                list="universities"

                class="form-input  fs-5" type="text"
                maxlength="35">
            <template v-if="resume.apiUniversity.length && resume.education[0].institution"

            >


              <div
                  style="position: absolute; z-index: 1200; display: block;
            left: 50px;
            top: 0;"
                  class="input-border-message   mt-5 p-3">

                <div
                    v-for="university in resume.apiUniversity"
                    :key="university.id"
                    @click="
                            resume.education[0].institution = university.title;
                            resume.apiUniversity = []
                          "
                    style="cursor: pointer"
                    class="w-100 mb-1">
                  <p class="fs-5">
                    {{ university.title }}
                  </p>

                </div>

              </div>
            </template>


          </div>

          <div class="d-flex form-row-card-education justify-content-center align-items-center">

            <p class="fs-5 form-label">Факультет</p>


            <!--Поле для ввода названия факультета-->
            <input
                @input="broadcastResume"
                v-model="resume.education[0].faculty" class="form-input  fs-5" type="text" maxlength="35">


          </div>

          <div class="d-flex form-row-card-education justify-content-center align-items-center">

            <p class="fs-5 form-label">Специализация</p>


            <!--Поле для ввода названия специализации-->
            <input
                @input="broadcastResume"
                v-model="resume.education[0].specialization" class="form-input  fs-5" type="text"
                   maxlength="35">


          </div>

          <div class="d-flex form-row-card-education justify-content-center align-items-center">

            <p class="fs-5 form-label">Год окончания</p>


            <!--Поле для ввода года окончания-->
            <input
                @input="broadcastResume"
                v-model="resume.education[0].Year_ending" type="number" class="form-input  fs-5"
                   maxlength="4" min="1900" max="2023"
                   step="1"/>


          </div>
        </template>
      </div>
    </template>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Ключевые навыки</p>


      <!--Поле для ввода информации о ключевых навыков-->
      <textarea
          @input="broadcastResume"
          v-model="resume.skills" class="form-input  fs-5" maxlength="150"
                rows="7"></textarea>

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Желаемая ЗП (Рубли)</p>

      <!--Поле для ввода информации о желаемой зп-->
      <input
          @input="broadcastResume"
          v-model="resume.money" class="form-input  fs-5" type="text" maxlength="20">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">
      <button
          @click="broadcastResume"
          class="fs-5 w-100" style="border: none"
      >Загрузить резюме
      </button>
    </div>
  </form>
</template>

<script>
import {CityApi} from '@/api/cityApi/CityApi';
import {UniversityApi} from '@/api/universityApi/UniversityApi';
import {formToJSON} from "axios";

export default {
  name: "DForm",
  data() {
    return {
      resume: {

        erPhone: '',
        erMail: '',
        profession: '',
        city: '',
        photo: 'https://kartinkin.net/uploads/posts/2022-03/1646950917_64-kartinkin-net-p-derevnya-durakov-kartinki-68.png',
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
        apiCities: [],
        apiUniversity: [],
      }
    }
  },
  methods: {
    broadcastResume() {
      this.$emit('broadcast', this.resume);
    },

    // Ф. валидации телефона, в случае неправильного ввода, выведет подсказку для правильного написания
    validatePhone() {
      this.resume.erPhone = '';
      if (this.resume.phone.length < 6 || this.resume.phone.length > 10) {
        this.resume.erPhone = 'Длина номера должна быть от 6 до 10 символов.';
      }
      if (/\D/.test(this.resume.phone)) {
        this.resume.erPhone += ' Номер должен сожержать только цифры.';
      }
    },
    validateMail() {
      this.resume.erMail = '';
      if (!(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(this.resume.mail))) {
        this.resume.erMail += 'Введите почту корректно. example@mail.ru';
      }
    },

    async getCity() {
      this.resume.apiCities = await CityApi.getCities(this.resume.city);
    },
    async getUniversity(University) {
      this.resume.apiUniversity = await UniversityApi.getUniversities(University);
      console.log(this.resume.apiUniversity)
    },
    addEducation() {
      const newEducation = {
        id: new Date(),
        type: 'Среднее',
        institution: '',
        faculty: '',
        specialization: '',
        Year_ending: ''
      };
      this.resume.education.push(newEducation)
    },
    deleteEducation(educationToRemove) {
      this.resume.education = this.resume.education.filter(item => item !== educationToRemove);
    }
  }
}
</script>

<style lang="scss" scoped>
.form-row {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 70px 10px 0;
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

.card-education {
  border: 4px solid rgba(214, 214, 214, .6);
  border-radius: 10px;
  height: 400px;
}

.form-row-card-education {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 40px 10px 40px;
  border-radius: 6px;
  background: rgba(214, 214, 214, .6);
}

.input-border-message {
  background: #FFFFFF;
  position: relative;
  border-radius: 10px;
  box-shadow: 3px 1px 50px rgb(122 122 122 / 25%);
  max-height: 220px;
  overflow-y: auto;
}
</style>