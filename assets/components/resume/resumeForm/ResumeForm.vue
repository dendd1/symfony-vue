<!--Форма для заполнения резюме-->
<template>
  <form>

    <app-select
        itemKey="status"
        label="Статус"
        :options="statusOptions"
        :value="resume.status"
        @change-select="changeOptionValue(0,$event)">
    </app-select>

    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.profession"
        type="text" item-key="profession" label="Профессия">
    </app-input>

    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.surname"
        type="text" item-key="surname" label="Фалимия">
    </app-input>

    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.name"
        type="text" item-key="name" label="Имя">
    </app-input>

    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.patronymic"
        type="text" item-key="patronymic" label="Отчество">
    </app-input>


    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.city"
        type="text" item-key="city" label="Город"
    >


    </app-input>

    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.photo"
        type="text" item-key="photo" label="Фото">
    </app-input>



    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.phone"
        type="text" item-key="phone" label="Телефон(+7)">
    </app-input>
    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.mail"
        type="text" item-key="mail" label="Почта">
    </app-input>




    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.bDate"
        type="date" item-key="bDate" label="Дата рождения">
    </app-input>

    <app-textarea
        :valueFrom="resume.about"
        @change-input="changeValue(0,$event)"
        item-key="about" label="О себе">

    </app-textarea>

    <template v-if="resume.education.length > 1">
      <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-interval="false"
           data-bs-touch="false">


        <div class="carousel-indicators">
          <button
              v-for="(education, index) in resume.education"
              :class="{ 'active': index === 0}"
              :data-bs-slide-to="`${index}`"
              type="button" data-bs-target="#carouselExampleIndicators" aria-current="true"></button>
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

              <div class="px-3">
              <app-select
                  itemKey="type"
                  label="Образование"
                  :options="educationOptions"
                  :value="resume.education[index].type"
                  @change-select="changeOptionValue(index,$event)"
              >

              </app-select>

              <template v-if="education.type !== 'Среднее'">

                <app-input
                    @change-input="changeValue(index,$event)"
                    :valueFrom="education.institution"
                    type="text" item-key="institution" label="Учеб. заведение">
                </app-input>

                <app-input
                    @change-input="changeValue(index,$event)"
                    :valueFrom="education.faculty"
                    type="text" item-key="faculty" label="Факультет">
                </app-input>

                <app-input
                    @change-input="changeValue(index,$event)"
                    :valueFrom="education.specialization"
                    type="text" item-key="specialization" label="Специализация">
                </app-input>

                <app-input
                    @change-input="changeValue(index,$event)"
                    :valueFrom="education.Year_ending"
                    type="number"  item-key="Year_ending" label="Год окончания">
                </app-input>

              </template>
              </div>
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
      <div class="card-education" style="">

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
        <div class="px-3">
        <app-select
            itemKey="type"
            label="Образование"
            :options="educationOptions"
            :value="resume.education[0].type"
            @change-select="changeOptionValue(0,$event)"
        >

        </app-select>


        <template v-if="resume.education[0].type !== 'Среднее'">

          <app-input
              @change-input="changeValue(0,$event)"
              :valueFrom="resume.education[0].institution"
              type="text" item-key="institution" label="Учеб. заведение">
          </app-input>

          <app-input
              @change-input="changeValue(0,$event)"
              :valueFrom="resume.education[0].faculty"
              type="text" item-key="faculty" label="Факультет">
          </app-input>

          <app-input
              @change-input="changeValue(0,$event)"
              :valueFrom="resume.education[0].specialization"
              type="text" item-key="specialization" label="Специализация">
          </app-input>

          <app-input
              @change-input="changeValue(0,$event)"
              :valueFrom="resume.education[0].Year_ending"
              type="number" min="1900" max="2023" step="1" item-key="Year_ending" label="Год окончания">
          </app-input>

        </template>
        </div>
      </div>
    </template>


    <app-textarea
        :valueFrom="resume.skills"
        @change-input="changeValue(0,$event)"
        item-key="skills" label="Ключевые навыки">

    </app-textarea>

    <app-input
        @change-input="changeValue(0,$event)"
        :valueFrom="resume.money"
        type="text" item-key="money" label="Желаемая ЗП (Рубли)">
    </app-input>









  </form>
</template>

<script>

import AppInput from "@/ui/appInput/AppInput.vue";
import AppSelect from "@/ui/appSelect/AppSelect.vue";
import AppTextarea from "@/ui/appTextarea/AppTextarea.vue";
import AppButton from "@/ui/appButton/AppButton.vue";


export default {
  name: "ResumeForm",
  components: {AppButton, AppTextarea, AppSelect, AppInput},
  props: {
    resumeFromDB: {
      required: true,
      // default: null,
    },
  },
  created() {
    this.resume = this.resumeFromDB;
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
      },
      educationOptions: [
        {
          value: 'Среднее',
          caption: 'Среднее',
        },
        {
          value: 'Среднее специальное',
          caption: 'Среднее специальное',
        },
        {
          value: 'Неоконченное высшее',
          caption: 'Неоконченное высшее',
        },
        {
          value: 'Высшее',
          caption: 'Высшее',
        },
      ],
      statusOptions: [
        {
          value: 'Новый',
          caption: 'Новый',
        },
        {
          value: 'Назначено собеседование',
          caption: 'Назначено собеседование',
        },
        {
          value: 'Принят',
          caption: 'Принят',
        },
        {
          value: 'Отказ',
          caption: 'Отказ',
        },
      ]
    }
  },
  methods: {
    changeValue(index, item) {
      if(item.key === 'institution' || item.key === 'faculty' || item.key === 'specialization' || item.key === 'Year_ending'){
        this.resume.education[index][item.key] = item.value;
      }
      else{
        this.resume[item.key] = item.value;
      }
      if (item.key === 'city') {
        this.getCity();
      }
      this.broadcastResume();
    },

    changeOptionValue(index, item) {
      if (item.key === 'type') {
        this.resume.education[index][item.key] = item.value;
      }
      if (item.key === 'status') {
        this.resume.status = item.value;

      }
      this.broadcastResume();
    },
    broadcastResume() {
      this.$emit('broadcast', this.resume);
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

<style scoped>


.card-education {
  border: 4px solid rgba(214, 214, 214, .6);
  border-radius: 10px;
  height: 400px;
}

</style>