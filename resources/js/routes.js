const DashboardLayout = () => import('./components/layouts/Default.vue')
const Dashboard = () => import('./components/Dashboard.vue')
const AttendanceReport = () => import('./components/attendance/Index.vue')

export const routes = [
    {
        name: 'Dashboard',
        path: '/',
        component: Dashboard
    },
    {
        name: 'AttendanceReport',
        path: '/attendance-report',
        component: AttendanceReport
    }
];
