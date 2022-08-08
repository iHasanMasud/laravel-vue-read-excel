import { createWebHistory, createRouter } from 'vue-router'

const DashboardLayout = () => import('@/components/layouts/Default.vue')
const Dashboard = () => import('@/components/Dashboard.vue')
const AttendanceReport = () => import('@/components/attendance/Index.vue')

const routes = [
    {
        path: "/",
        component: DashboardLayout,
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            },
            {
                name: "AttendanceReport",
                path: '/attendance-report',
                component: AttendanceReport,
                meta: {
                    title: `Attendance Report`
                }
            }
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

export default router
