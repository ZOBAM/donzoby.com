<template>
    <div>
        <!-- button for toggling data plans -->
        <b-button variant="outline-primary" @click="showDataPlans = !showDataPlans" id="show-plans-button">View Data Plan</b-button>
        <b-alert
            :show="dismissCountDown"
            dismissible
            variant="info"
            @dismissed="dismissCountDown=0"
            @dismiss-count-down="countDownChanged"
            >
            {{info}} {{ dismissCountDown }}
        </b-alert>
        <div v-if="showDataPlans">
            <b-table :fields = "fields" responsive small hover :items="dP"
            :per-page="perPage"
            :current-page="currentPage"
            >
                <template v-slot:cell(s_no)="data">
                    {{ data.index + 1 }}
                </template>
                <template v-slot:cell(title)="data">
                    <a :href="`/mobile-usage/service-providers/data-plans/${data.item.id}/${data.item.title}`">{{data.value}}</a>
                </template>
                <template v-slot:cell(volume)="data">
                    {{ formatValues(data.value, 'volume') }}
                </template>
                <template v-slot:cell(validity)="data">
                    {{ formatValues(data.value, 'validity') }}
                </template>
                <template v-slot:cell(action)="data">
                    <button class="action-button btn-danger" @click="deleteDP(data.item.id,data.index)"> Del <b-icon icon="trash"></b-icon> </button>
                    <button class="action-button btn-primary" @click="edit(data.item.id,data.index)"> Edit <b-icon icon="pencil"></b-icon></button>
                </template>
            </b-table>
            <b-container fluid class="page-nav-container">
                <b-row>
                    <b-col>
                        <b-pagination
                        v-model="currentPage"
                        :total-rows="rows"
                        :per-page="perPage"
                        aria-controls="my-table"
                        ></b-pagination>
                    </b-col>
                </b-row>
            </b-container>
        </div>
        <b-container fluid>
            <h3 class = "text-center" >{{formHeading}}</h3>
            <b-form @submit.prevent = "onSubmit($event)" v-if="showForm" method = "POST" action = "/member/data-plan/create">
            <b-row>
                <b-col>
                    <b-form-group id="input-group-1" label="Network Provider:" label-for="provider" >
                        <b-form-select
                        id="provider" name ="provider"
                        v-model="form.provider"
                        :options="provider"
                        required size="sm"
                        @change="dataPlanTitle()"
                        ></b-form-select>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-2" label="Data Plan Title:" label-for="plan_title">
                        <b-form-input
                        id="plan_title" name ="title"
                        v-model="form.title"
                        required size="sm"
                        placeholder="Enter Data Plan Title"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-3" label="Data Volume (eg. 500MB,2GB etc):" label-for="volume" >
                        <b-form-input
                        id="volume" name ="volume"
                        v-model="form.volume"
                        type="text"
                        required size="sm"
                        :options="volume"
                        placeholder = "Enter Data Volume"
                        list="volume-list"
                        @change="dataPlanTitle()"
                        ></b-form-input>
                        <b-form-datalist id="volume-list" :options="volume"></b-form-datalist>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-4" label="Data Price (₦):" label-for="data_price">
                        <b-form-input
                        id="data_price" name ="price"
                        v-model="form.price"
                        required size="sm"
                        placeholder="Enter Data Plan Price"
                        @change="dataPlanTitle()"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-5" label="Bonus For All (eg. 500MB,2GB etc):" label-for="bonus_all" >
                        <b-form-input
                        id="bonus_all" name ="bonus_all"
                        v-model="form.bonus_all" size="sm"
                        placeholder="Enter Data Plan Bonus"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-6" label="Bonus For New Users (eg. 500MB,2GB etc):" label-for="bonus_new_sim">
                        <b-form-input
                        id="bonus_new_sim" name ="bonus_new_sim" size="sm"
                        v-model="form.bonus_new_sim"
                        placeholder="Enter Bonus for new users"
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-5" label="Data Validity Period:" label-for="validity" >
                        <b-form-input
                        id="validity" name ="validity"
                        v-model="form.validity"
                        required size="sm"
                        placeholder="Enter Validity Period"
                        list="validity-list"
                        ></b-form-input>
                        <b-form-datalist id="validity-list" :options="validity"></b-form-datalist>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-6" label="Data Use Period:" label-for="use_period">
                        <b-form-select
                        id="use_period" name ="use_period"
                        v-model="form.use_period"
                        :options = "use_period"
                        required size="sm"
                        placeholder="Enter Bonus for new users"
                        ></b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-7" label="How To Subscribe:" label-for="how_to_sub" >
                        <b-form-textarea
                        id="how_to_sub" name ="how_to_sub"
                        v-model="form.how_to_sub"
                        required size="sm"
                        placeholder="How to subscribe to plan"
                        ></b-form-textarea>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-8" label="Data Plan Description (Extra Details):" label-for="description">
                        <b-form-textarea
                        id="description" name ="description" size="sm"
                        v-model="form.description"
                        placeholder="Give more helpful details if any"
                        ></b-form-textarea>
                    </b-form-group>
                </b-col>
            </b-row>
                <b-button type="submit" variant="primary">Submit</b-button>
            </b-form>
        </b-container>
    </div>
</template>
<script>
export default {
    data () {
        return{
            showForm: true,
            showDataPlans: false,
            info: '',
            // formHeading: 'Add New Data Plan',
            dismissSecs: 5,
            dismissCountDown: 0,
            url: '/member/data-plan',
            submitURL: "/member/data-plan/create",
            submitEditURL: null,
            isEditing: false,
            editedPlan: null,
            editedPlanIndex: null,
            dataPlans: null,
            perPage: 10,
            currentPage: 1,
            rows: 0,
            dP: null,
            fields: [
                's_no',
                {key: 'provider', sortable: true},
                'title',
                {
                    key: 'volume',
                    label: 'Volume',
                    sortable: true
                },
                {key: 'price', sortable: true},
                {
                    key: 'validity',
                    label: 'Validity',
                },
                'use_period',
                'Action'
            ],
            form: {
                provider: null,
                title: '',
                volume: '',
                price: '',
                bonus_all: 0,
                bonus_new_sim: 0,
                validity: '',
                use_period: null,
                how_to_sub: '',
                description: ''
            },
            provider: [{ text: 'Select Network', value: null}, '9mobile', 'airtel', 'glo', 'mtn'],
            volume: [{text: 'Select Volume', value: null}, '25mb', '27mb', '75mb', '90mb', '100mb', '200mb', '250mb', '340mb', '350mb', '500mb', '750mb', '1gb', '2GB', '2.3GB', '2.5GB', '3.5GB', '3.75GB', '4.5GB','5gb','5.25GB','6GB','7GB', '8GB', '9GB', '12GB', '16.5GB', '25GB', '42GB', '78GB', '100GB', '115GB'],
            validity: ['24hrs', '2days', '5days', '7days', '14days', '30days', '60days', '90days', '365days' ],
            use_period: [{ text: 'Select Use Period', value: null }, { text: 'Anytime', value: 'anytime' }, { text: 'Weekend (Sat & Sun)', value: 'weekend' }, { text: 'Evening (9pm upwards)', value: 'evening' }, { text: 'Night (12midnight till dawn)', value: 'night' }]
        }
    },
    methods: {
        countDownChanged(dismissCountDown) {
            this.dismissCountDown = dismissCountDown
        },
        getDataPlans: function(plans){
            this.dP = []
            for(let data of plans){
                //alert(data.provider)
                this.dP.push(new Object({
                    'id': data.id,
                    'provider': data.provider,
                    'title': data.title,
                    'volume': data.volume,
                    'price': data.price,
                    'validity': data.validity,
                    'use_period':data.use_period
                }))
            }
            //console.log(this.dP)
        },
        edit (id,index) {
            this.submitEditURL = "/member/data-plan/edit/"+id
            this.isEditing = true
            let dataPlan = this.dataPlans.filter(plan => {
                return plan.id == id
            })
            this.editedPlan = dataPlan[0]
            this.editedPlanIndex = this.perPage * (this.currentPage - 1) + index
            console.log('Edited index: ' + this.editedPlanIndex)
            for(let field in this.form){
                this.form[field] = this.editedPlan[field]
                if(field == "validity"){
                    this.form[field] = this.formatValues(this.editedPlan[field],'validity');
                }
                if(field == "volume" || field == "bonus_all" || field == "bonus_new_sim"){
                    this.form[field] = this.formatValues(this.editedPlan[field],'volume');
                }
                //alert(dataPlan[field])
            }
        },
        deleteDP: function(id,index){
            let response = confirm("Are you sure you want to delete this data plan?\n Click OK to delete or cancel to go back");
            if(response){
                let _this = this
                axios.get("/member/data-plan/" + id)
                .then(function (response) {
                    //console.log(response.data)
                    _this.dP.splice(index,1)
                    _this.rows--
                    _this.info = response.data.msg
                    _this.dismissCountDown = 5;
                    //alert("about to delete dp of id: "+ id + " and index of " + index)
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        formatValues: function formatValues(inputValue = false,dataType = false){
            if(dataType == "validity"){
                let validity = inputValue;
                if(validity>24){
                    return (validity/24)+' days'
                }else return validity+' hrs';
            }
            else if(dataType == 'volume'){
                //alert(elemResource);
                let volume = inputValue;
                if(volume>1000){
                    return (volume/1024).toFixed(2)+" GB";
                }
                else{
                    //alert(isNaN(volume*1));
                    return (volume == null)? '':volume+' MB';
                }
            }
            else{
                //alert(typeof(elemResource));
                var value = (inputValue)? inputValue.toUpperCase().trim() : '';
                if(value.lastIndexOf('GB') != -1){
                    value = value.trim().replace('GB','')* 1 * 1024;
                }
                else if(value.lastIndexOf('MB') != -1){
                    value = value.replace('MB','').trim() * 1;
                }
                else if(value.lastIndexOf('DAYS') != -1){
                    value = value.trim().replace('DAYS','') * 1 * 24;
                }
                else if(value.lastIndexOf('HRS') != -1){
                    value = value.trim().replace('HRS','') * 1;
                }
                return value;
            }
        },//end formatValues
        onSubmit: function(e){
            //format volume and validity before posting to the server
            this.form.volume = this.formatValues(this.form.volume)
            this.form.bonus_all = this.formatValues(this.form.bonus_all)
            this.form.bonus_new_sim = this.formatValues(this.form.bonus_new_sim)
            this.form.validity = this.formatValues(this.form.validity)
            //handle form submission
            var _this = this;
            let postURL = _this.isEditing? _this.submitEditURL : _this.submitURL
            axios.post(postURL, this.form)
            .then(function (response) {
                _this.info = response.data.info;
                _this.dismissCountDown = 5;
                if(_this.isEditing){
                    _this.dataPlans.splice(_this.editedPlanIndex,1,response.data.data_plan)
                }
                else{
                    _this.dataPlans.unshift(response.data.data_plan)
                    _this.rows++
                }
                _this.getDataPlans(_this.dataPlans)
                document.getElementById('show-plans-button').scrollIntoView()
                _this.isEditing = false
                for(let field in _this.form){
                    _this.form[field] = null
                }
                //alert(_this.isEditing)
            })
            .catch(function (error) {
                console.log(error);
            });
        },
    dataPlanTitle(){
            let tempTitle
        if(this.form.title.lastIndexOf(' ') != -1){
            this.form.title = ''
        }
        else{ tempTitle = this.form.title
        }
        let newTitle = this.form.provider == 'mtn'? `${this.form.provider.toUpperCase()}`: `${this.form.provider.charAt(0).toUpperCase()}${this.form.provider.slice(1)}`
        newTitle += tempTitle? ` ${tempTitle}` : ''
        newTitle += ` ${this.form.volume.toUpperCase()} for ₦`
        newTitle += `${(this.form.price*1).toLocaleString('en-US', {style: 'currency', currency: 'NGN'}).slice(4)} Data Plan`
        this.form.title = newTitle

    }
    },
    mounted () {
        var _this = this;
        axios.get(this.url)
        .then(function (response) {
            _this.dataPlans = response.data
            _this.getDataPlans(response.data)
            _this.rows = _this.dataPlans.length
           // _this.updateCustomer(response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    computed: {
        formHeading(){
            return this.isEditing? 'Editing: '+this.editedPlan.title : 'Add New Data Plan'
        }
    }
}
</script>
<style scoped lang="scss">
.page-nav-container{
    width: 100%; overflow:auto;
}
.action-button{
    white-space: nowrap;
}
</style>
