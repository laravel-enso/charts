<template>
	<div :class="'box box-' + headerClass">
        <div class="box-header with-border" :class="{'draggable': draggable}">
	        <h3 class="box-title">
	        	<i :class="icons[type]"></i>
                <slot name="chart-title"></slot>
            </h3>
            <div class="box-tools pull-right">
                <button type="button"
                	class="btn btn-box-tool btn-sm"
                	@click="getData">
                    <i class="fa fa-refresh"></i>
                </button>
                <button class="btn btn-box-tool btn-sm" data-widget="collapse">
                    <i class="fa fa-minus">
                    </i>
                </button>
            </div>
        </div>
        <div class="box-body">
        	<canvas :id="'canvas-' + _uid"></canvas>
    	</div>
    	<div class="overlay" v-if="loading">
    		<i class="fa fa-spin fa-spinner spinner-custom"></i>
    	</div>
    </div>
</template>

<script>

	export default {
		props: {
			type: {
				type: String,
				required: true
			},
			source: {
				type: String,
				required: true
			},
			headerClass: {
				type: String,
				default: 'primary'
			},
            draggable: {
            	type: Boolean,
            	default: false
            },
		},
		data: function () {
			return {
				chart: null,
	            loading: false,
	            options: {},
	            icons: {
	            	bar: 'fa fa-bar-chart',
	            	pie: 'fa fa-pie-chart',
	            	line: 'fa fa-line-chart',
	            	radar: 'fa fa-area-chart',
	            	polarArea: 'fa fa-circle-o-notch',
	            	doughnut: 'fa fa-pie-chart',
	            	bubble: 'fa fa-circle-thin'
	            },
			};
		},
		methods: {
			getData: function() {
				this.loading = true;

				axios.get(this.source).then((response) => {
					this.data = response.data;

					if (response.data.hasOwnProperty('options')) {
						this.options = response.options;
					}

					if (this.chart) {
						this.chart.destroy();
					}
				}).then(() => {
					this.chart = new Chart($("#canvas-" + this._uid), {
			            type: this.type,
			            data: this.data,
			            options: this.options,
		        	});

		        	this.loading = false;
				}).catch((error) => {
					if (error.response.data.level) {
						toastr[error.response.data.level](error.response.data.code + ' Error: ' + error.response.data.message);
					}
				});
			},
			resize: function() {
				this.chart.resize();
			}
		},
		mounted: function() {
			this.getData();
		}
	};

</script>