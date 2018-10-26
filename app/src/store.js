import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        vehicles: []
    },
    getters: {
        allVehicles: state => state.vehicles
    },
    mutations: {
        GET_VEHICLES: (state, vehicles) => {
            state.vehicles = vehicles
        }
    },
    actions: {
        getVehicles({ commit }) {
            axios.get('http://api.vue-rentacar.localhost/vehicles').then(response => {
                commit('GET_VEHICLES', response.data)
            })
        }
    }
})
