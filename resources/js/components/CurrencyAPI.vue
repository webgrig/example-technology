<template>
    <div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3 offset-md-4">
                    <datepicker :disabledDates="disabledDates"></datepicker>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="current"></label>
                    <select v-model="from" name="" id="current" class="form-control">
                        <option value="currency.id" v-for="currency in formatCurrencies">
<!--                            {{currency.currencyName}}-->
                        </option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="final"></label>
                    <select model="to" name="" id="final" class="form-control">
                        <option value="currency.id" for="currency in formatCurrencies">
<!--                            {{currency.currencyName}}-->
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <input v-model="amount" type="text" class="form-control my-5" placeholder="Enter amount">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button click="convertCurrency()" class="btn btn-primary">Convert</button>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12 text-center">
                    <h1>48.23</h1>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
export default {
    data: function () {
        return {
            currencies: [],
            amount: null,
            from: 'USD',
            to: 'PHP',
            result: null,
            disabledDates: {
                customPredictor: function(date){
                    let day = date.getDate();
                    day = day <= 9 ? '0' + day : day;
                    let month = date.getMonth();
                    month = month <= 9 ? '0' + month : month;
                    let curDate = date.getFullYear() + '-' + month + '-' + day;
                    return curDate in this.currencies ? false : true;
                }.bind(this)
            }
        }
    },
    components: {
        Datepicker
    },
    mounted() {
        const socket = io("http://127.0.0.1:3000", {
            withCredentials: false
        });

        socket.on("connection", function (data) {
            this.currencies[data[0]] = JSON.parse(data[1]);

        }.bind(this));


        socket.on("currency", function (data){
            this.currencies[data[0]] = JSON.parse(data[1]);

        }.bind(this));
        this.getCurrencies();
    },
    computed: {
        formatCurrencies(){
            // return Object.values(this.currencies)
        }
    },
    methods: {
        getCurrencies: function () {
            axios.get('/api/currency');
        },
        convertCurrency(){
            const search = `${this.from}_${this.to}`;
            const string = `https://free.currconv.com/api/v7/convert?q=${search}&compact=y&apiKey=44c8ee9eb2df03610d1e&callback=sampleCallback`;
            axios.get(string)
            .then((response) => {
                this.result = response.data.results[search].val;

                console.log(string)
            });

        }
    }
}
</script>
