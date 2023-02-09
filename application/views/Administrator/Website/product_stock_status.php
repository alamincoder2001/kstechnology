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
                            <td>{{ row.Product_Code }}</td>
                            <td>{{ row.Product_Name }}</td>
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
                { label: 'Product Code', field: 'order_date', align: 'center' },
                { label: 'Product Name', field: 'invoice_no', align: 'center' },         
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
            axios.get('/get_product_stock_status').then(res => {
                this.orders = res.data.filter((order) => order.order_qty > 0);
            })
        }
    }
})
</script>