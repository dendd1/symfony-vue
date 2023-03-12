<template>
  <router-link :to="{ name: 'resume' }" class="nav-link text-secondary fw-bolder p-5">
    <app-button
        label="Добавить резюме"
    >
    </app-button>
  </router-link>
  <div class="container" v-if="!loading">
    <div class="row">
      <div class="col-lg-3 col-6 mt-3">
        <h3>Новый ({{ newStatus.length }}):</h3>
      </div>
      <div class="col-lg-3 col-6 mt-3">
        <h3>Назначено собеседование ({{ interviewStatus.length }}):</h3>
      </div>
      <div class="col-lg-3 col-6 mt-3">
        <h3>Принят ({{ acceptedStatus.length }}):</h3>
      </div>
      <div class="col-lg-3 col-6 mt-3">
        <h3>Отказ ({{ refusedStatus.length }}):</h3>
      </div>
    </div>
    <div class="row" v-if="resumeList">
      <div class="col-lg-3 col-6 mt-3">
        <draggable
            class="list-group"
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
                  :b-date="item.bDate"
                  :id="item.id"
                  @click="clickCard(item)"
              ></resume-mini>
            </li>
              </template>
          </transition-group>
        </draggable>
      </div>
      <div class="col-lg-3 col-6 mt-3">
        <draggable
            class="list-group"
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
                    :b-date="item.bDate"
                    :id="item.id"
                    @click="clickCard(item)"
                ></resume-mini>
              </li>
            </template>

          </transition-group>
        </draggable>
      </div>
      <div class="col-lg-3 col-6 mt-3">
        <draggable
            class="list-group"
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
                  :b-date="item.bDate"
                  :id="item.id"
                  @click="clickCard(item)"
              ></resume-mini>
            </li>
            </template>
          </transition-group>
        </draggable>
      </div>
      <div class="col-lg-3 col-6 mt-3">
        <draggable
            class="list-group"
            tag="ul"
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
                  :b-date="item.bDate"
                  :id="item.id"
                  @click="clickCard(item)"
              ></resume-mini>
            </li>
            </template>
          </transition-group>
        </draggable>
      </div>
    </div>
  </div>

  <app-spinner v-else/>

</template>

<script>
import AppButton from "../../ui/appButton/AppButton.vue";
import ResumeMini from "../../ui/resumeMini/ResumeMini.vue";
import {ResumeApi} from "../../api/resumeApi/ResumeApi";

// import Draggable from 'vuedraggable';
import { VueDraggableNext } from 'vue-draggable-next';
import AppSpinner from "../../ui/appSpinner/AppSpinner.vue";
import {isTypedArray} from "core-js/internals/array-buffer-view-core";


export default {
  name: "MainPage",
  components: {AppSpinner, ResumeMini, AppButton, draggable: VueDraggableNext},
  created() {
    this.loadResume()
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
      if(list.length) return list;
      else return {element: {status: 'Новый'}}
      // return this.resumeMini.result?.filter(item => item.status === 'Новый');

    },
    interviewStatus() {
      let list = this.resumeMini.result?.filter(item => item.status === 'Назначено собеседование');
      if(list.length) return list;
      else return {element: {status: 'Назначено собеседование'}}
      // return this.resumeMini.result?.filter(item => item.status === 'Назначено собеседование');
    },
    acceptedStatus() {
      let list = this.resumeMini.result?.filter(item => item.status === 'Принят');
      if(list.length) return list;
      else return {element: {status: 'Принят'}}
      // console.log(this.resumeMini.result?.filter(item => item.status === 'Принят'));
      // return this.resumeMini.result?.filter(item => item.status === 'Принят');
    },
    refusedStatus() {
      let list = this.resumeMini.result?.filter(item => item.status === 'Отказ');
      if(list.length) return list;
      else return {element: {status: 'Отказ'}}
      // console.log(this.resumeMini.result?.filter(item => item.status === 'Отказ'));
      // return this.resumeMini.result?.filter(item => item.status === 'Отказ');
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
  methods: {
    isTypedArray,
    async loadResume() {
      this.loading = true;
      let result = await ResumeApi.getResumeList();
      if (!result) alert(`Произошла неизвестная ошибка`);


      this.resumeMini = result;
      this.loading = false;
    },
    clickCard(item) {
      item.fixed = !item.fixed;
      this.$router.push({ name: 'edit', params: { id: item.id } });
    },

    async onMove({relatedContext, draggedContext}) {

      if(relatedContext?.element){
        const relatedElement = relatedContext.element;
        console.log('relatedElement:', relatedContext);
        const draggedElement = draggedContext.element;
        console.log('draggedElement:', draggedElement);
        await ResumeApi.editResumeStatus(draggedElement.id, { status: relatedElement.status });
        await this.loadResume();
        return (!relatedElement || !relatedElement.fixed) && !draggedElement.fixed;
      } else{
        const draggedElement = draggedContext.element;
        await ResumeApi.editResumeStatus(draggedElement.id, { status: relatedContext.list.element.status });
        await this.loadResume();
        return  !draggedElement.fixed;
      }
      // const relatedElement = relatedContext.element;
      // console.log('relatedElement:', relatedContext);
      // const draggedElement = draggedContext.element;
      // console.log('draggedElement:', draggedElement);
      // await ResumeApi.editResumeStatus(draggedElement.id, { status: relatedElement.status });
      // await this.loadResume();
      // return (!relatedElement || !relatedElement.fixed) && !draggedElement.fixed;
    },

  }
}
</script>

<style scoped>
.flip-list-move {
  transition: transform 0.5s;
}

.no-move {
  transition: transform 0s;
}

.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}

.list-group {
  min-height: 20px;
}

.list-group-item {
  cursor: move;
}

.list-group-item i {
  cursor: pointer;
}
</style>