import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        vehicles: [],
        locations: [],
        filteredVehicles: []
    },
    getters: {
        allVehicles: state => state.vehicles,
        allLocations: state => state.locations,
        filterdVehicles: state => state.filteredVehicles
    },
    mutations: {
        GET_VEHICLES: (state, vehicles) => {
            state.vehicles = vehicles
        },

        GET_LOCATIONS: (state, locations) => {
            state.locations = locations
        },

        SET_FILTERED: (state, vehicles) => {
            state.filteredVehicles = vehicles
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
        },
        filterVehicles({commit, state}, value) {
            const filtered = state.vehicles.filter( vehicle => {
                let foundLocations = vehicle.locations.findIndex( location => {
                    return location.id === value
                })

                return foundLocations !== -1
            })

            commit('SET_FILTERED', filtered)
        }
    }
})
