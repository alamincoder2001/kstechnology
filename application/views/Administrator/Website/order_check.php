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
                            <td>{{ row.order_date }}</td>
                            <td>{{ row.invoice_no }}</td>
                            <td>{{ row.customer_name }}</td>
                            <td>{{ row.customer_mobile }}</td>
                            <td>{{ row.product_name }}</td>
                            <td style="color:red">{{ row.current_quantity }}</td>
							<td>{{ row.order_qty }}</td>
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
                { label: 'Order Date', field: 'order_date', align: 'center' },
                { label: 'Order Invoice No', field: 'invoice_no', align: 'center' },
                { label: 'Customer Name', field: 'customer_name', align: 'center' }, 
                { label: 'Customer Mobile', field: 'customer_mobile', align: 'center' }, 
                { label: 'Product Name', field: 'product_name', align: 'center' },             
                { label: 'In Stock', field: 'order_qty', align: 'center' },
                { label: 'In Order', field: 'order_qty', align: 'center' },
            ],
            page: 1,
            per_page: 10,
            filter: '',
        }
    },
    created() {
        this.getOrderStock();
    },
    methods: {
        getOrderStock() {
            axios.get('/get_orders_stock').then(res => {
                this.orders = res.data;
            })
        }
    }
})
</script>