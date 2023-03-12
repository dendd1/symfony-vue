<template>
  <router-link :to="{ name: 'resume' }" class="nav-link text-secondary fw-bolder p-5">
    <app-button
        label="Добавить резюме"
    >
    </app-button>
  </router-link>
  <div class="px-5 " v-if="!loading">

    <div class="row" v-if="resumeList">
      <div class="col-lg-3  col-6 mt-3">
        <div class="form-resume-mini">
          <p class="fs-2 text-center">Новое: {{ newStatus.length }}</p>
          <draggable
              :class="Array.isArray(newStatus) ? 'p-2' : 'p-0'"
              tag="ul"
              v-model="newStatus"
              v-bind="dragOptions"
              :move="onMove"
              @start="isDragging = true"
              @end="isDragging = false"
          >
            <transition-group type="transition" name="flip-list">

              <template
                  v-if="Array.isArray(newStatus)"
              >
                <li class="list-group-item" v-for="item in newStatus" :key="item.id">
                  <resume-mini
                      :profession="item.profession"
                      :photo="item.photo"
                      :surname="item.surname"
                      :name="item.name"
                      :patronymic="item.patronymic"
                      :b-date="get_current_age(item.bDate)"
                      :id="item.id"
                      @click="clickCard(item)"
                  ></resume-mini>
                </li>
              </template>

            </transition-group>
          </draggable>
          <template v-if="!Array.isArray(newStatus)">
            <div style="margin-top: 24px">


            <resume-mini
                profession="Для добавления"
                photo="https://sun9-62.userapi.com/impg/sU2awYOuWv9SfsIDiZFuDlPH2IJ7q4a2Mtv5oA/oVn--mBRGXE.jpg?size=1063x862&quality=96&sign=80ff61f69342813fab234d945c0febbc&type=album"
                surname="перенести"
                name=""
                patronymic=""
                b-date="сюда"
            ></resume-mini>
            </div>
          </template>
        </div>

      </div>
      <div class="col-lg-3  col-6 mt-3">
        <div class="form-resume-mini">
          <p class="fs-2 text-center">Собеседование: {{ interviewStatus.length }}</p>
          <draggable
              :class="Array.isArray(newStatus) ? 'p-2' : 'p-0'"
              tag="ul"
              @start="isDragging = true"
              @end="isDragging = false"
              v-model="interviewStatus" v-bind="dragOptions" :move="onMove">
            <transition-group type="transition" name="flip-list">
              <template
                  v-if="Array.isArray(interviewStatus)"
              >
                <li class="list-group-item" v-for="item in interviewStatus" :key="item.id">
                  <resume-mini
                      :profession="item.profession"
                      :photo="item.photo"
                      :surname="item.surname"
                      :name="item.name"
                      :patronymic="item.patronymic"
                      :b-date="get_current_age(item.bDate)"
                      :id="item.id"
                      @click="clickCard(item)"
                  ></resume-mini>
                </li>
              </template>

            </transition-group>
          </draggable>
          <template v-if="!Array.isArray(interviewStatus)">
            <div style="margin-top: 24px">


              <resume-mini
                  profession="Для добавления"
                  photo="https://sun9-62.userapi.com/impg/sU2awYOuWv9SfsIDiZFuDlPH2IJ7q4a2Mtv5oA/oVn--mBRGXE.jpg?size=1063x862&quality=96&sign=80ff61f69342813fab234d945c0febbc&type=album"
                  surname="перенести"
                  name=""
                  patronymic=""
                  b-date="сюда"
              ></resume-mini>
            </div>
          </template>
        </div>

      </div>
      <div class="col-lg-3  col-6 mt-3">
        <div class="form-resume-mini">
          <p class="fs-2 text-center">Принято: {{ acceptedStatus.length }}</p>
          <draggable
              :class="Array.isArray(acceptedStatus) ? 'p-2' : 'p-0'"
              tag="ul"
              @start="isDragging = true"
              @end="isDragging = false"
              v-model="acceptedStatus" v-bind="dragOptions" :move="onMove">
            <transition-group type="transition" name="flip-list">
              <template
                  v-if="Array.isArray(acceptedStatus)"
              >
                <li class="list-group-item" v-for="item in acceptedStatus" :key="item.id">
                  <resume-mini
                      :profession="item.profession"
                      :photo="item.photo"
                      :surname="item.surname"
                      :name="item.name"
                      :patronymic="item.patronymic"
                      :b-date="get_current_age(item.bDate)"
                      :id="item.id"
                      @click="clickCard(item)"
                  ></resume-mini>
                </li>
              </template>
            </transition-group>
          </draggable>
          <template v-if="!Array.isArray(acceptedStatus)">
            <div style="margin-top: 24px">


              <resume-mini
                  profession="Для добавления"
                  photo="https://sun9-62.userapi.com/impg/sU2awYOuWv9SfsIDiZFuDlPH2IJ7q4a2Mtv5oA/oVn--mBRGXE.jpg?size=1063x862&quality=96&sign=80ff61f69342813fab234d945c0febbc&type=album"
                  surname="перенести"
                  name=""
                  patronymic=""
                  b-date="сюда"
              ></resume-mini>
            </div>
          </template>
        </div>

      </div>
      <div class="col-lg-3  col-6 mt-3">
        <div class="form-resume-mini">
          <p class="fs-2 text-center">Отказано: {{ refusedStatus.length }}</p>
          <draggable
              tag="ul"
              :class="Array.isArray(refusedStatus) ? 'p-2' : 'p-0'"
              @start="isDragging = true"
              @end="isDragging = false"
              v-model="refusedStatus" v-bind="dragOptions" :move="onMove">
            <transition-group type="transition" name="flip-list">
              <template
                  v-if="Array.isArray(refusedStatus)"
              >
                <li class="list-group-item" v-for="item in refusedStatus" :key="item.id">
                  <resume-mini
                      :profession="item.profession"
                      :photo="item.photo"
                      :surname="item.surname"
                      :name="item.name"
                      :patronymic="item.patronymic"
                      :b-date="get_current_age(item.bDate)"
                      :id="item.id"
                      @click="clickCard(item)"
                  ></resume-mini>
                </li>
              </template>
            </transition-group>
          </draggable>
          <template v-if="!Array.isArray(refusedStatus)">
            <div style="margin-top: 24px">


              <resume-mini
                  profession="Для добавления"
                  photo="https://sun9-62.userapi.com/impg/sU2awYOuWv9SfsIDiZFuDlPH2IJ7q4a2Mtv5oA/oVn--mBRGXE.jpg?size=1063x862&quality=96&sign=80ff61f69342813fab234d945c0febbc&type=album"
                  surname="перенести"
                  name=""
                  patronymic=""
                  b-date="сюда"
              ></resume-mini>
            </div>
          </template>
        </div>

      </div>
    </div>
  </div>

  <app-spinner v-else/>

</template>

<script>
import AppButton from "../../ui/appButton/AppButton.vue";
import ResumeMini from "../../ui/resumeMini/ResumeMini.vue";
import {ResumeApi} from "../../api/resumeApi/ResumeApi";
import {VueDraggableNext} from 'vue-draggable-next';
import AppSpinner from "../../ui/appSpinner/AppSpinner.vue";
import {isTypedArray} from "core-js/internals/array-buffer-view-core";


export default {
  name: "MainPage",
  components: {AppSpinner, ResumeMini, AppButton, draggable: VueDraggableNext},
  created() {
    this.loadAllResume()
  },
  data() {
    return {
      loading: true,
      isDragging: false,
      delayedDragging: false,
      editable: true,
      resumeMini: [
        // {id: 1, status: 'Новое', profession: '', photo: '', surname: '', name: '', patronymic: '', bDate: ''}
      ],
    }
  },
  methods: {
    isTypedArray,
    async loadAllResume() {
      this.loading = true;
      let result = await ResumeApi.getResumeList();
      if (!result) alert(`Произошла неизвестная ошибка`);
      this.resumeMini = result;
      this.loading = false;
    },
    clickCard(item) {
      item.fixed = !item.fixed;
      this.$router.push({name: 'edit', params: {id: item.id}});
    },
    async onMove({relatedContext, draggedContext}) {
      if (relatedContext?.element) {
        const relatedElement = relatedContext.element;

        const draggedElement = draggedContext.element;
        await ResumeApi.editResumeStatus(draggedElement.id, {status: relatedElement.status});
        await this.loadAllResume();
        return (!relatedElement || !relatedElement.fixed) && !draggedElement.fixed;
      } else {
        const draggedElement = draggedContext.element;
        await ResumeApi.editResumeStatus(draggedElement.id, {status: relatedContext.list.element.status});
        await this.loadAllResume();
        return !draggedElement.fixed;
      }
    },
    get_current_age(date) {
      return ((new Date().getTime() - new Date(date)) / (24 * 3600 * 365.25 * 1000)) | 0;
    }
  },
  watch: {
    isDragging(newValue) {
      if (newValue) {
        this.delayedDragging = true;
        return;
      }
      this.$nextTick(() => {
        this.delayedDragging = false;
      });
    },
  },
  computed: {
    resumeList() {
      return this.resumeMini;
    },
    newStatus() {
      let list = this.resumeMini.result?.filter(item => item.status === 'Новый');
      if (list.length) return list;
      else return {element: {status: 'Новый'}}
    },
    interviewStatus() {
      let list = this.resumeMini.result?.filter(item => item.status === 'Назначено собеседование');
      if (list.length) return list;
      else return {element: {status: 'Назначено собеседование'}}
    },
    acceptedStatus() {
      let list = this.resumeMini.result?.filter(item => item.status === 'Принят');
      if (list.length) return list;
      else return {element: {status: 'Принят'}}
    },
    refusedStatus() {
      let list = this.resumeMini.result?.filter(item => item.status === 'Отказ');
      if (list.length) return list;
      else return {element: {status: 'Отказ'}}
    },
    dragOptions() {
      return {
        animation: 0,
        group: 'description',
        disabled: !this.editable,
        ghostClass: 'ghost',
      };
    },
  },

}
</script>

<style scoped>



.list-group-item {
  cursor: move;
}

.list-group-item i {
  cursor: pointer;
}


.form-resume-mini {
  border: 4px solid rgba(214, 214, 214, .6);
  padding: 10px;
  border-radius: 6px;
  background: white;
}
</style>