import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

const state = {
    cities: sessionStorage.getItem('cities') ? JSON.parse(sessionStorage.getItem('cities')) : [],
    countries: sessionStorage.getItem('countries') ? JSON.parse(sessionStorage.getItem('countries')) : [],
};

const mutations = {
    setCities ( state, data ) {
        state.cities = data
    },
    setCountries ( state, data ) {
        console.log( data );
        state.countries = data
    }
};

const actions = {
    setCities ({ commit }, data ) {
        commit('setCities', data );
        sessionStorage.setItem('cities', JSON.stringify( data ))
    },
    setCountries ({ commit }, data ) {
        commit('setCountries', data);
        sessionStorage.setItem('countries', JSON.stringify( data ))
    }
};

export default new Vuex.Store({
    state,
    mutations,
    actions
})