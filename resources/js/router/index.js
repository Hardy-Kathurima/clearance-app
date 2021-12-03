import Vue from "vue"
import VueRouter from "vue-router"



import Dashboard from "../components/dashboard/container.vue"
import Profile from "../components/profile/container.vue"
import Messages from "../components/messages/container.vue"
import Clearance from "../components/clearance/container.vue"
import editProfile from "../components/profile/editProfile.vue"

// admin components
import ClearStudent from "../components/admin/clearStudent.vue"
import AdminDashboard from "../components/admin/dashboard.vue"
import Verify from "../components/admin/verify.vue"
import ManageUsers from "../components/admin/manageUsers.vue"

Vue.use(VueRouter)

const routes = [
    {
        name: 'dashboard',
        path: '/',
        component: {
            render: (h) => {
                switch (Vue.prototype.$role) {
                    case "1":
                        return h(AdminDashboard);
                    case "0":
                        return h(Dashboard);
                    default:
                        return h(Dashboard);
                }
            }
        }

    },
    {
        component: Profile,
        name: 'profile',
        path: '/profile',
        children: [{
            name: 'edit',
            path: '/profile/:id',
            props: true,
            component: editProfile
        }]
    },

    {
        component: Messages,
        name: 'messages',
        path: '/messages'
    },
    {
        component: Clearance,
        name: 'clearance',
        path: '/store'
    },

    // admin routes

    {
        component: ManageUsers,
        name: 'manageUsers',
        path: '/manageUsers'
    },
    {
        component: ClearStudent,
        name: 'clearStudent',
        path: '/clearStudent'
    },


    {
        component: Verify,
        name: 'verify',
        path: '/verify'
    },
]
export default new VueRouter({
    // mode: "history",
    routes
})

