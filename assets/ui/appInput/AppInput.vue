<!--Инпут
принмиает тип, значение и заголовок
передает данные в родительский компонент при изменении
-->
<template>
  <p
      v-if="errorMessage.length"
      class="fs-5 text-danger">{{ errorMessage }}</p>
  <div
      :style="[itemKey==='city'|| itemKey==='institution' ? {'position': 'relative'} : {}]"
      class="d-flex form-row justify-content-center align-items-center">
    <p class="fs-5 form-label">{{ label }}</p>
    <input
        v-model="value"
        :type="type"
        @input="changeInput()"
        class="form-input  fs-5" type="text" >

    <template v-if="itemKey==='city' && apiCities.length">
      <div
          style="position: absolute; z-index: 1200; display: block;
          left: 75px;
          top: 0;"
          class="input-border-message   mt-5 p-3">

        <div
            v-for="city in apiCities"
            :key="city.id"
            @click.stop="
            value = city.title;
            apiCities = [];
           broadcastValue();"
            style="cursor: pointer"
            class="w-100 mb-1">
          <p class="fs-5">
            {{ city.title }}
          </p>

        </div>

      </div>
    </template>

    <template v-if="itemKey==='institution' && apiUniversity.length">


      <div
          style="position: absolute; z-index: 1200; display: block;
            left: 50px;
            top: 0;"
          class="input-border-message   mt-5 p-3">

        <div
            v-for="university in apiUniversity"
            :key="university.id"
            @click="
                  value = university.title;
                  apiUniversity = [];
                  broadcastValue();"
            style="cursor: pointer"
            class="w-100 mb-1">
          <p class="fs-5">
            {{ university.title }}
          </p>

        </div>

      </div>
    </template>
  </div>


</template>

<script>
import {CityApi} from '@/api/cityApi/CityApi';
import {UniversityApi} from '@/api/universityApi/UniversityApi';


export default {
  name: "AppInput",
  emits: ['changeInput'],
  props: {
    itemKey: {
      type: String,
      required: false,
    },
    valueFrom: {
      type: String,
      required: false,
      default: '',
    },
    type: {
      type: String,
      required: false,
      default: 'text',
    },
    label: {
      type: String,
      required: false,
    }
  },
  watch: {
    valueFrom(){

        this.value = this.valueFrom;


    }
  },


  data() {
    return {
      value: this.valueFrom,
      apiCities: [],
      apiUniversity: [],
      errorMessage: '',
    }
  },

  methods: {
    changeInput() {
      let validate = true;
      if (this.itemKey === 'phone' && this.value.length) {
        validate = this.validatePhone();
      }
      if (this.itemKey === 'mail' && this.value.length) {
        validate = this.validateMail();
      }

      if (this.itemKey === 'city') {
        this.getCity();
      }
      if (this.itemKey === 'institution') {
        this.getUniversity();
      }
      if(validate){
        this.broadcastValue();
      }

    },

    validatePhone() {
      this.errorMessage = '';
      let flag = true;
      if (this.value.length < 6 || this.value.length > 10) {
        this.errorMessage = 'Длина номера должна быть от 6 до 10 символов.';
        flag=false;
      }
      if (/\D/.test(this.value)) {
        this.errorMessage += ' Номер должен сожержать только цифры.';
        flag=false;
      }
      return flag;
    },
    validateMail() {
      this.errorMessage = '';
      let flag = true;
      if (!(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(this.value))) {
        this.errorMessage += 'Введите почту корректно. example@mail.ru';
        flag=false;
      }
      return flag;
    },
    broadcastValue() {
      this.$emit('changeInput', {
        key: this.itemKey,
        value: this.value,
      })
    },
    async getCity() {
      this.apiCities = await CityApi.getCities(this.value);
    },
    async getUniversity() {
      this.apiUniversity = await UniversityApi.getUniversities(this.value);

    },
  },
}
</script>

<style scoped>
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


.input-border-message {
  background: #FFFFFF;
  position: relative;
  border-radius: 10px;
  box-shadow: 3px 1px 50px rgb(122 122 122 / 25%);
  max-height: 220px;
  overflow-y: auto;
}


</style>