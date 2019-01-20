<template>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h5 class="center">Welcome to my homework!</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="input-field col s3">
                    <select id="departure_city" v-model="searchForm.departureCity">
                        <option value="" disabled selected>Город вылета</option>
                        <option v-for="city in cities" :value="city.id">
                            {{ city.city_name_ru }}
                        </option>
                    </select>
                    <label for="departure_city">Выберите город вылета</label>
                </div>
                <div class="input-field col s3" id="country_select">
                    <select id="destination" v-model="searchForm.destination" :disabled="disabledCountries">
                        <option value="" disabled selected>Страна прилета</option>
                        <option v-for="country in countries" :key="country.id" :value="country.id">
                            {{ country.country_name_ru }}
                        </option>
                    </select>
                    <label for="destination">Куда летим?</label>
                </div>
                <div class="input-field col s3">
                    <input type="text" id="date" class="datepicker" @change="setDate" v-model="searchForm.departureDate" required>
                    <label for="date">Выберите дату вылета</label>
                </div>
                <div class="input-field col s3">
                    <select id="nights" v-model="searchForm.nights">
                        <option value="" disabled selected>Количество ночей</option>
                        <option :value="n" v-for="n in nightsRange">{{ n }}</option>
                    </select>
                    <label for="destination">Ночей</label>
                </div>
            </div>
            <button class="btn right" id="search_button" @click="searchTour">Искать</button>
        </div>

        <div class="row" v-if="toursReceived">
            <div class="col s12">
                <h5 class="center">Наши предложения (GET REQUEST)</h5>

                <table class="striped">
                    <thead>
                    <tr>
                        <th>Название отеля</th>
                        <th>Цена</th>
                        <th>Валюта</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr  v-for="(tourOne, key) in tours.get" :key="key">
                        <td>{{ tourOne.hotelName }}</td>
                        <td>{{ tourOne.price }}</td>
                        <td>{{ tourOne.currency }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" v-if="toursReceived">
            <div class="col s12">
                <h5 class="center">Наши предложения (POST REQUEST)</h5>

                <table class="striped">
                    <thead>
                    <tr>
                        <th>Название отеля</th>
                        <th>Цена</th>
                        <th>Валюта</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr  v-for="(tourTwo, key) in tours.post" :key="key">
                        <td>{{ tourTwo.hotel }}</td>
                        <td>{{ tourTwo.tourPrice }}</td>
                        <td>{{ tourTwo.currency }}</td>
                    </tr>
                    </tbody>
                </table>
                <h3 class="center">FIN!</h3>
            </div>
        </div>

    </div>
</template>
<script>
import M from 'materialize-css'
import axios from 'axios'
import { mapState, mapActions } from 'vuex'
export default {
    data () {
        return {
            cityId: '',
            searchForm: {
                departureCity: '',
                destination: '',
                departureDate: '',
                nights: ''
            },
            nightsRange: [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
            toursReceived: false,
            tours: {
                get: [],
                post: []
            }
        }
    },
    methods: {
        ...mapActions([ 'setCities', 'setCountries' ]),
        setDate () {
            this.searchForm.departureDate = event.currentTarget.value;
        },
        getCities () {
            axios.get ('/api/get-cities')
                .then( response => {
                    this.setCities( response.data.cities );
                }).catch( e => {
                    console.log( e )
                })
        },
        getCountriesByCityId ( cityId ) {
            axios.get('/api/get-countries-by-city-id',
                {
                    params: {
                        cityId: cityId
                    }
                })
                .then( response => {
                    this.setCountries( response.data )
                })
                .catch( error => {
                    console.log( error )
                })
        },
        searchTour () {
            let error = false;
            if ( this.searchForm.departureCity === '' ) {
                error = true;
                M.toast({
                    html: 'Пожалуйста, выберите город вылета.'
                })
            }

            if ( this.searchForm.destination === '' ) {
                error = true;
                M.toast({
                    html: 'Пожалуйста, выберите страну прилета.'
                })
            }

            if ( this.searchForm.departureDate === '' ) {
                error = true;
                M.toast({
                    html: 'Пожалуйста, выберите дату вылета.'
                })
            }

            if ( this.searchForm.nights === '' ) {
                error = true;
                M.toast({
                    html: 'Пожалуйста, выберите количество ночей.'
                })
            }

            if (error === false) {
                document.getElementById('search_button').disabled = true;
                axios.post('/api/search-tour',
                    {
                        searchForm: this.searchForm
                    }).then( response => {
                    if (response.data.status === 'error') {
                        M.toast({
                            html: response.data.message
                        })
                    }
                    document.getElementById('search_button').disabled = false;
                    this.toursReceived = true;
                    this.tours.get = response.data.getResponse;
                    this.tours.post = response.data.postResponse;
                }).catch( error => {
                    document.getElementById('search_button').disabled = false;
                    console.log( error )
                })
            }
        }
    },
    computed: {
        ...mapState({
            cities: state => state.cities,
            countries: state => state.countries
        }),
        date () {
            return document.querySelector('#date').value;
        },
        disabledCountries () {
            return this.cityId === ''
        },
        disabledCities () {
            return this.cities.length === 0
        }
    },
    beforeMount () {
        this.getCities();
//        sessionStorage.removeItem('countries');
    },
    mounted () {
        M.AutoInit();
        M.FormSelect.init(document.querySelectorAll('select'));
        M.Datepicker.init(document.querySelectorAll('.datepicker'), {
            autoClose: true,
            firstDay: 1,
            format: 'dd-mm-yyyy',
            cancel: 'Отменить',
            minDate: new Date(),
            i18n: {
                months: [
                    'Январь',
                    'Февраль',
                    'Март',
                    'Апрель',
                    'Май',
                    'Июнь',
                    'Июль',
                    'Август',
                    'Сентябрь',
                    'Октябрь',
                    'Ноябрь',
                    'Декабрь'
                ],
                monthsShort:
                    [
                        'Янв',
                        'Фев',
                        'Мар',
                        'Апр',
                        'Май',
                        'Июн',
                        'Июл',
                        'Авг',
                        'Сен',
                        'Окт',
                        'Ноя',
                        'Дек'
                    ],
                weekdaysShort: [
                    'Вс',
                    'Пн',
                    'Вт',
                    'Ср',
                    'Чт',
                    'Пт',
                    'Сб'
                ],
                weekdaysAbbrev: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб']
            }
        });
        if ( this.disabledCountries ) {
            document.getElementById('country_select').disabled;
        }
        if ( this.disabledCities ) {
            document.getElementById('departure_city').disabled;
        }
    },
    updated () {
        M.FormSelect.init(document.querySelectorAll('select'));
    },
    watch: {
        'searchForm.departureCity' ( cityId ) {
            if (cityId !== '') {
                this.cityId = cityId;
                console.log( 'get countries called ');
                this.getCountriesByCityId( cityId );
            }
        }
    }
}
</script>
<style scoped lang="scss"></style>