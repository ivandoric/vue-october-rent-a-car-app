import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        vehicles: [],
        locations: [],
        filteredVehicles: [],
        currentVehicle: {},
        location: null,
        pickup: '',
        dropoff: ''
    },
    getters: {
        allVehicles: state => state.vehicles,
        allLocations: state => state.locations,
        filterdVehicles: state => state.filteredVehicles,
        currentVehicle: state => state.currentVehicle,
        pickupDate: state => state.pickup,
        dropOffDate: state => state.dropoff
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
        },

        SET_VEHICLE: (state, vehicle) => {
            state.currentVehicle = vehicle
        },
        SET_LOCATION: (state, location) => {
            state.location = location
        },
        SET_PICKUP: (state, date) => {
            state.pickup = date
        },
        SET_DROPOFF: (state, date) => {
            state.dropoff = date
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
        getVehicle({commit, state}, slug) {
            const vehicle = this.state.vehicles.find(vehicle => vehicle.slug === slug)
            commit('SET_VEHICLE', vehicle)
        },
        filterVehicles({commit, state}) {
            const filtered = state.vehicles.filter( vehicle => {
                let foundLocations = vehicle.locations.findIndex( location => {
                    return location.id === this.state.location
                })

                return foundLocations !== -1
            })

            const filteredVehicles = []

            filtered.forEach(vehicle => {
                if(vehicle.dates.length > 0) {
                    const overlaps = []

                    vehicle.dates.forEach(date => {
                        const startDate1 = new Date(date.pickup)
                        const endDate1 = new Date(date.drop_off)
                        const startDate2 = new Date(this.state.pickup)
                        const endDate2 = new Date(this.state.dropoff)

                        overlaps.push((startDate1 < endDate2) && (startDate2 < endDate1))
                    })

                    if(!overlaps.includes(true)) {
                        filteredVehicles.push(vehicle)
                    }

                    return
                }

                filteredVehicles.push(vehicle)
            })

            commit('SET_FILTERED', filteredVehicles)
        },
        setLocation({ commit, state }, value) {
            commit('SET_LOCATION', value)
        },
        filterOnApi({ commit }, value) {
            axios.get('http://api.vue-rentacar.localhost/vehicles/filter/' + value).then(response => {
                commit('SET_FILTERED', response.data)
            })
        },
        setDates({commit, state}, date) {
            if(date.type === 'pickup') {
                commit('SET_PICKUP', date.value)
                return
            }

            commit('SET_DROPOFF', date.value)
        }
    }
})
