<div id="fsalesInvoice">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<fsales-invoice v-bind:sales_id="salesId"></fsales-invoice>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/vue/vue.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/components/fsalesInvoice.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script>
	new Vue({
		el: '#fsalesInvoice',
		components: {
			fsalesInvoice
		},
		data() {
			return {
				salesId: parseInt('<?php echo $salesId; ?>')
			}
		}
	})
</script>