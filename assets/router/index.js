import { createRouter, createWebHashHistory } from 'vue-router';
import ResumeView from "../views/ResumeView.vue";
// import EmployeeView from '../views/EmployeeView';
// import TurnoverView from '../views/TurnoverView';
// import LayoffsView from '../views/LayoffsView';
// import StaffingView from "../views/StaffingView.vue";
const routes = [
    {
        path: '/',
        name: 'home',
        component: ResumeView,
    },
    // {
    //     path: '/turnover/rates',
    //     name: 'turnover_rates',
    //     component: TurnoverView,
    // },
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