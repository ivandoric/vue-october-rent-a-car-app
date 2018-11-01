import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        vehicles: [],
        locations: []
    },
    getters: {
        allVehicles: state => state.vehicles,
        allLocations: state => state.locations
    },
    mutations: {
        GET_VEHICLES: (state, vehicles) => {
            state.vehicles = vehicles
        },

        GET_LOCATIONS: (state, locations) => {
            state.locations = locations
        }
    },
    actions: {
        getVehicles({ commit }) {
            axios.get('http://api.vue-rentacar.localhost/vehicles').then(response => {
                commit('GET_VEHICLES', response.data)
            })
        },
        getLocations({ commit }) {
            axios.get('http://api.vue-rentacar.localhost/locations/list').then(response => {
                commit('GET_LOCATIONS', response.data)
            })
        }
    }
})
