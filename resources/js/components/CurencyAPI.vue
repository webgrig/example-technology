<template>
    <div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <label for="current"></label>
                    <select v-model="from" name="" id="current" class="form-control">
                        <option :value="currency.id" v-for="currency in formatCurrencies">
                            {{currency.currencyName}}
                        </option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="final"></label>
                    <select v-model="to" name="" id="final" class="form-control">
                        <option :value="currency.id" v-for="currency in formatCurrencies">
                            {{currency.currencyName}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <input v-model="amount" type="text" class="form-control my-5" placeholder="Enter amount">
                </div>
            </div>
            <div class="cow">
                <div class="col-md-12 text-center">
                    <button @click="convertCurrency()" class="btn btn-primary">Convert</button>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12 text-center">
                    <h1>48.23</h1>
                </div>
            </div>
            <form>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            currencies: {},
            amount: null,
            from: 'PR',
            to: 'ME',
            result: null,
        }
    },
    mounted() {
        this.getCurrencies()
    },
    computed: {
        formatCurrencies(){
            return Object.values(this.currencies)
        }
    },
    methods: {
        getCurrencies: function () {
            const currencies = localStorage.getItem('currencies')
            if (currencies && typeof currencies !== "undefined") {
                this.currencies = JSON.parse(currencies);
                return;
            }
            axios.get('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml')
                .then(response => {
                    this.currencies = response.data.results;
                    console.log(response)
                    localStorage.setItem('currencies', JSON.stringify(this.currencies));
                });
        },
        convertCurrency(){
            // const search = `${this.from}_${this.to}`;
            //
            // axios.get(`https://free.currconv.com/api/v7/convert?q=${search}&compact=ultra&callback=sampleCallback&apiKey=44c8ee9eb2df03610d1e`)
            // .then((response) => {
            //     // this.result = response.data.results[search].val;
            //
            //     console.log(response)
            // });

        }
    }
}
</script>
