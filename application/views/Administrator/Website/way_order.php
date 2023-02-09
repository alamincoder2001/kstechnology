
<div id="orders">
    <div class="row">
        <div class="col-sm-12 form-inline">
        <br>
        <div class="form-group">
            <label for="filter" class="sr-only">Filter</label>
            <input type="text" class="form-control" v-model="filter" placeholder="Filter">
        </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <datatable :columns="columns" :data="orders" :filter-by="filter">
                    <template scope="{ row }">
                        <tr>
                            <td>{{ row.id }}</td>
                            <td>{{ row.created_at }}</td>
                            <td>{{ row.customer_id }}</td>
							<td>{{ row.cus_message }}</td>
							<td>{{ row.customer_name }}</td>
							<td>{{ row.total_amount }}</td>
							<td><button type="button" class="button" @click="updateStatus(row.id)">
								Delivered 
                                 </button></td>
							<td>
								<?php if($this->session->userdata('accountType') != 'u'){?>
						
								<?php }?>
                                <a href="" title="Order Invoice" v-bind:href="`/order_invoice_print/${row.id}`" target="_blank"><i class="fa fa-file"></i></a>
							</td>
                        </tr>
                    </template>
                </datatable>
                <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/vue/vue.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vue/axios.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vue/vuejs-datatable.js"></script>
<script>
new Vue({
    el: '#orders',
    data() {
        return {
            product: {
                Product_SlNo: '',
            },
            orders: [],
            columns: [
                { label: 'SL', field: 'id', align: 'center' },
                { label: 'Date', field: 'created_at', align: 'center' },
                { label: 'Customer Id', field: 'customer_id', align: 'center' },
                { label: 'Message', field: 'cus_message', align: 'center' },
                { label: 'Customer Name', field: 'customer_name', align: 'center' },
                { label: 'Price', field: 'total_amount', align: 'center' },
                { label: 'Status', field: 'status', align: 'center',filterable: false },
                { label: 'Action', align: 'center', filterable: false }
            ],
            page: 1,
            per_page: 10,
            filter: '',
        }
    },
    created() {
        this.getOrders();
    },
    methods: {
        getOrders() {
            axios.post('/get_orders',{status: 'way'}).then(res => {
                this.orders = res.data;
            })
        },
        fetchOrder() {
            let url = '/fetch_order';
            axios.post(url, this.order).then(res => {
                let r = res.data;
                alert(r.message);
                if (r.success) {
                    this.clearForm();
                    this.getOrders();
                }
            })

        },

        updateStatus(orderId) {
            let deleteConfirm = confirm('Are you sure?');
            if (deleteConfirm == false) {
                return;
            }
            axios.post('/update_order', {
                orderId: orderId, status: 'd'
            }).then(res => {
                let r = res.data;
                alert(r.message);
                if (r.success) {
                    this.getOrders();
                }
            })
        },
        clearForm() {
          
        }
    }
})
</script>