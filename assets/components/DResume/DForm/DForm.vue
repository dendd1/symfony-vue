<template>
  <form>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Статус</p>

      <!--Поле для выбора степени образования-->

      <select v-model="resume.status" @change="broadcastResume" class="form-input  fs-5">
        <option>Новый</option>
        <option>Назначено собеседование</option>
        <option>Принят</option>
        <option>Отказ</option>
      </select>


    </div>
    <div class="d-flex form-row justify-content-center align-items-center">
      <p class="fs-5 form-label">Профессия</p>
      <!--Поле для ввода профессии-->
      <input v-model="resume.profession" @input="broadcastResume" class="form-input  fs-5" type="text" maxlength="35">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">
      <p class="fs-5 form-label">Фалимия</p>
      <!--Поле для ввода фамилии-->
      <input v-model="resume.surname" @input="broadcastResume" class="form-input  fs-5" type="text" maxlength="35">
    </div>


    <div class="d-flex form-row justify-content-center align-items-center">

      <!--Поле для ввода имени-->
      <p class="fs-5 form-label">Имя</p>


      <input v-model="resume.name" @input="broadcastResume" class="form-input  fs-5" type="text" maxlength="35">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Отчество</p>


      <!--Поле для ввода Отчества-->
      <input v-model="resume.patronymic" @input="broadcastResume" class="form-input  fs-5" type="text" maxlength="35">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Город</p>


      <!--Поле для ввода города-->
      <input v-model="resume.city" @input="broadcastResume" class="form-input  fs-5" type="text" maxlength="20">

    </div>


    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Фото</p>


      <!--Поле для загрузки ссылки на фото-->
      <input v-model="resume.photo" @input="broadcastResume" class="form-input  fs-5" type="text">

    </div>

    <p class="fs-5 text-danger">{{ resume.erPhone }}</p>
    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Телефон(+7)</p>


      <!--Поле для ввода телефона-->
      <input v-model="resume.phone" @input="validatePhone" class="form-input  fs-5" type="text">


    </div>

    <p class="fs-5 text-danger">{{ resume.erMail }}</p>
    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Почта</p>


      <!--Поле для ввода почты-->
      <input v-model="resume.mail" @input="validateMail" class="form-input  fs-5" type="text" maxlength="35">

    </div>


    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Дата рождения</p>


      <!--Поле для указания даты рождения-->
      <input v-model="resume.bDate" @input="broadcastResume" class="form-input  fs-5" type="date">

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">О себе</p>


      <!--Поле для ввода информации о личных качествах-->
      <textarea v-model="resume.about" @input="broadcastResume" class="form-input  fs-5" maxlength="350"
                rows="7"></textarea>

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Образование</p>

      <!--Поле для выбора степени образования-->

      <select v-model="resume.education" @change="broadcastResume" class="form-input  fs-5">
        <option>Среднее</option>
        <option>Среднее специальное</option>
        <option>Неоконченное высшее</option>
        <option>Высшее</option>
      </select>


    </div>

    <div v-if="resume.education != 'Среднее'">
      <div class="d-flex form-row justify-content-center align-items-center">

        <p class="fs-5 form-label">Учеб. заведение</p>


        <!--Поле для ввода названия учебного заведения-->
        <input v-model="resume.institution" @input="broadcastResume" class="form-input  fs-5" type="text"
               maxlength="35">


      </div>

      <div class="d-flex form-row justify-content-center align-items-center">

        <p class="fs-5 form-label">Факультет</p>


        <!--Поле для ввода названия факультета-->
        <input v-model="resume.faculty" @input="broadcastResume" class="form-input  fs-5" type="text" maxlength="35">


      </div>

      <div class="d-flex form-row justify-content-center align-items-center">

        <p class="fs-5 form-label">Специализация</p>


        <!--Поле для ввода названия специализации-->
        <input v-model="resume.specialization" @input="broadcastResume" class="form-input  fs-5" type="text"
               maxlength="35">


      </div>

      <div class="d-flex form-row justify-content-center align-items-center">

        <p class="fs-5 form-label">Год окончания</p>


        <!--Поле для ввода года окончания-->
        <input v-model="resume.Year_ending" @input="broadcastResume" type="number" class="form-input  fs-5"
               maxlength="4" min="1900" max="2023"
               step="1"/>


      </div>


    </div>
    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Ключевые навыки</p>


      <!--Поле для ввода информации о ключевых навыков-->
      <textarea v-model="resume.skills" @input="broadcastResume" class="form-input  fs-5" maxlength="150"
                rows="7"></textarea>

    </div>

    <div class="d-flex form-row justify-content-center align-items-center">

      <p class="fs-5 form-label">Желаемая ЗП (Рубли)</p>

      <!--Поле для ввода информации о желаемой зп-->
      <input v-model="resume.money" @input="broadcastResume" class="form-input  fs-5" type="text" maxlength="20">

    </div>


  </form>
</template>

<script>
export default {
  name: "DForm",
  data() {
    return {
      resume: {
        institution: '',
        faculty: '',
        specialization: '',
        Year_ending: '',
        erPhone: '',
        erMail: '',
        profession: '',
        city: '',
        photo: 'https://s00.yaplakal.com/pics/pics_original/5/9/2/14163295.jpg',
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
      this.broadcastResume();
    },
    validateMail() {
      this.resume.erMail = '';
      if (!(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(this.resume.mail))) {
        this.resume.erMail += 'Введите почту корректно. example@mail.ru';
      }
      this.broadcastResume();
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
</style>