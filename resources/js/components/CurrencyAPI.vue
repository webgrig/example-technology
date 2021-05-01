<template>
    <div>
        <div class="modal-body">
            <div class="container" v-if="!is_refresh">
                <div class="row">
                    <div class="col-md-3 offset-md-4">
                        <datepicker placeholder="Select date" @opened="datepickerOpenedFunction"
                                    @selected="datepickerSelectedFunction" :disabledDates="state.disabledDates"
                                    :value="state.date" v-model="state.date" name="uniquename"
                                    :monday-first="true"></datepicker>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label for="from">Give</label>
                        <select v-model="selectedFrom" name="" id="from" class="form-control"
                                @change="onChangeCurrency($event)" :class="{'invalid': $v.selectedFrom.$dirty && !$v.selectedFrom.required}">
                            <option v-for="(rate, currency)  in this.currenciesOfDate" :value="rate">
                                {{ currency }}
                            </option>
                        </select>
                        <small class="helper-text invalid" v-if="$v.selectedFrom.$dirty && !$v.selectedFrom.required">
                            Select currency
                        </small>
                    </div>
                    <div class="col-sm-6">
                        <label for="to">Get</label>
                        <select v-model="selectedTo" name="" id="to" class="form-control"
                                @change="onChangeCurrency($event)" :class="{'invalid': $v.selectedTo.$dirty && !$v.selectedTo.required}">
                            <option v-for="(rate, currency)  in this.currenciesOfDate" :value="rate">
                                {{ currency }}
                            </option>
                        </select>
                        <small class="helper-text invalid" v-if="$v.selectedTo.$dirty && !$v.selectedTo.required">
                            Select currency
                        </small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <input v-model.trim="amount" type="text" class="form-control my-5" placeholder="Enter amount" @input="convertCurrency()" :class="{'invalid': ($v.amount.$dirty && !$v.amount.decimal) || ($v.amount.$dirty && !$v.amount.maxLength)}">
                        <small class="helper-text invalid" v-if="$v.amount.$dirty && !$v.amount.decimal">
                            Invalid data
                        </small>
                        <small  class="helper-text invalid" v-else-if="$v.amount.$dirty && !$v.amount.maxLength">
                            Maximum length 10 characters
                        </small>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-12 text-center">
                        <h3>{{ result }}</h3>
                    </div>
                </div>
            </div>
            <div class="container text-center" v-if="is_refresh">
                <span class="badge badge-primary md-1">Refreshing...</span>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import Datepicker from '@hokify/vuejs-datepicker'
import Vuelidate from 'vuelidate'
import {decimal, maxLength, required } from 'vuelidate/lib/validators'
Vue.use(Vuelidate);
export default {
    components: {
        Datepicker,
        Vuelidate,
    },
    data: function () {
        return {
            is_refresh: false,
            currencies: [],
            currenciesOfDate: [],
            selectedFrom: null,
            selectedTo: null,
            selectedTitleFrom: 'EUR',
            selectedTitleTo: 'USD',
            result: null,
            state: {},
            amount: '',
        }
    },
    validations: {
        amount: {decimal, maxLength: maxLength(10)},
        selectedFrom: {required},
        selectedTo: {required}
    },
    mounted () {
        const socket = io('http://127.0.0.1:3000', {
            withCredentials: false
        })

        this.getCurrencies()

        let connectionPromise = new Promise((resolve, reject) => {
            socket.on('connection', function (data) {
                resolve(this.currencies[data[0]] = data[1])
            }.bind(this))
        })

        connectionPromise.then((res) => {
            setTimeout(() => {
                this.initDatepicker()
            }, 3000)
        })

        socket.on('currency', function (data) {
            this.currencies[data[0]] = data[1]

        }.bind(this))
    },
    computed: {
        formatCurrencies () {
            return this.currenciesOfDate
        }
    },
    methods: {
        getCurrencies: function () {
            this.is_refresh = true;
            axios.get('/api/currency')
        },
        validateCurrency: function (event){
            if(this.$v.$invalid){
                this.$v.$touch()
                return false
            }
            return true
        },
        validateAmount: function (){
            if(this.$v.$invalid){
                this.$v.$touch()
                this.result = ''
                return false
            }
            if (!this.amount){
                this.result = ''
                return false
            }
            return true
        },
        convertCurrency: function () {
            if (!this.validateAmount()){
                return
            }
            let result = (this.selectedTo / this.selectedFrom) * this.amount
            this.result = parseFloat(this.amount).toFixed(2) + ' ' + this.selectedTitleFrom + ' => ' + parseFloat(result).toFixed(2) + ' ' + this.selectedTitleTo
        },
        capitalize: function (str) {
            return str.charAt(0).toUpperCase() + str.slice(1)
        },
        onChangeCurrency: function (event) {
            if (!this.validateCurrency(event)){
                return
            }
            let selectedTargetTitle = 'selectedTitle' + this.capitalize(event.target.id)
            this[selectedTargetTitle] = event.target.options[event.target.options.selectedIndex].innerText.trim()
            this.convertCurrency()
        },

        // Datepicker start

        initDatepicker: function () {
            this.state.disabledDates = {}
            this.state.disabledDates.dates = []
            this.createDatepickerDates()
            this.is_refresh = false;
        },
        createDatepickerDates: function () {
            this.state.date = new Date()
            this.state.disabledDates.customPredictor = this.disabledDatesFunc
            this.createListSelectedDate()
            this.createDisablesDates()
            this.createFirstDate()
        },
        datepickerOpenedFunction: function () {
            // this.state.date = new Date()
        },
        datepickerSelectedFunction: function () {
            this.createListSelectedDate()
            this.convertCurrency()
        },
        createFirstDate: function () {
            const dayMilliseconds = 24 * 60 * 60 * 1000
            let currentDate = this.state.date
            let curDateString
            for (var key in this.currencies) {
                curDateString = this.createDadeString(currentDate, '-')
                if (this.currencies[curDateString]) {
                    this.state.date = new Date(currentDate)
                    break
                }
                currentDate.setTime(currentDate.getTime() - dayMilliseconds)
            }
        },
        createListSelectedDate: function () {
            setTimeout(() => {
                let selectedDate = this.createDadeString(this.state.date, '-')
                this.currenciesOfDate = _.merge({ 'EUR': '1' }, JSON.parse(this.currencies[selectedDate]))
                this.selectedFrom = this.currenciesOfDate[this.selectedTitleFrom]
                this.selectedTo = this.currenciesOfDate[this.selectedTitleTo]
            })
        },
        disabledDatesFunc: function (date) {
            let currentDate = new Date()
            let firstDate = new Date(1999, 0, 4)
            if (date > currentDate || date < firstDate) {
                return true
            }
        },
        createDisablesDates: function () {
            const dayMilliseconds = 24 * 60 * 60 * 1000
            let currentDate = new Date()
            let curDateString
            for (var key in this.currencies) {
                curDateString = this.createDadeString(currentDate, '-')
                if (this.currencies[curDateString] == undefined) {
                    this.state.disabledDates.dates.push(new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate()))
                }
                currentDate.setTime(currentDate.getTime() - dayMilliseconds)
            }
        },
        createDadeString: function (date, delimiter) {
            let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(date)
            let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(date)
            let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(date)
            return `${ye}${delimiter}${mo}${delimiter}${da}`
        }

        // Datepicker finish
    }
}
</script>

<style lang="scss">
@import "~@hokify/vuejs-datepicker/dist/vuejs-datepicker.css";
.invalid{
    color: red;
}
</style>
