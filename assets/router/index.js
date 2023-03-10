import { createRouter, createWebHashHistory } from 'vue-router';
import ResumeView from "../views/ResumeView.vue";
import MainPage from "../components/main/MainPage.vue";
// import EmployeeView from '../views/EmployeeView';
// import TurnoverView from '../views/TurnoverView';
// import LayoffsView from '../views/LayoffsView';
// import StaffingView from "../views/StaffingView.vue";
const routes = [
    {
        path: '/',
        name: 'main',
        component: MainPage,
    },
    {
        path: '/resume',
        name: 'resume',
        component: ResumeView,
    },
    // {
    //     path: '/analytics/layoffs',
    //     name: 'analytics_layoffs',
    //     component: LayoffsView,
    // },
    // {
    //     path: '/forecasting/staffing',
    //     name: 'forecasting_staffing',
    //     component: StaffingView,
    // },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;