<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

	'name' => env('APP_NAME', 'Omah Laravel'),


	'public' => [
		'favicon' => 'admin/media/img/logo/favicon.ico',
		'fonts' => [
			'google' => [
				'families' => [
					'Poppins:300,400,500,600,700'
				]
			]
		],
		'global' => [
			'css' => [
				'admin/css/style.css',
			],
			'js' => [
				'admin/vendor/global/global.min.js',
			],
		],
		'pagelevel' => [
			'css' => [
				'saakin_dashborad' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
					'https://cdn.lineicons.com/2.0/LineIcons.css',
					'admin/vendor/owl-carousel/owl.carousel.css',

				],

				'saakin_create' => [

					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/summernote/summernote.css',
					'admin/vendor/select2/css/select2.min.css',
				],

				'saakin_edit' => [

					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/summernote/summernote.css',
					'admin/vendor/select2/css/select2.min.css',
				],

				'saakin_index' => [

					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/nestable2/css/jquery.nestable.min.css',
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/datatables/css/jquery.dataTables.min.css',


				],

				'dashboard_1' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
					'https://cdn.lineicons.com/2.0/LineIcons.css',
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/owl-carousel/owl.carousel.css',
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
				],
				'analytics' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
					'https://cdn.lineicons.com/2.0/LineIcons.css',
				],
				'customer_list' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
					'https://cdn.lineicons.com/2.0/LineIcons.css',
					'admin/vendor/owl-carousel/owl.carousel.css',
				],
				'property_details' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
					'admin/vendor/owl-carousel/owl.carousel.css',
					'https://cdn.lineicons.com/2.0/LineIcons.css',
				],
				'order_list' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
					'admin/vendor/datatables/css/jquery.dataTables.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
					'https://cdn.lineicons.com/2.0/LineIcons.css',
				],
				'review' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
					'https://cdn.lineicons.com/2.0/LineIcons.css',
				],
				'app_calender' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/fullcalendar/css/fullcalendar.min.css',
				],
				'app_profile' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/lightgallery/css/lightgallery.min.css',
				],
				'post_details' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/lightgallery/css/lightgallery.min.css',
				],
				'chart_chartist' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
				],
				'chart_chartjs' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'chart_flot' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'chart_morris' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'chart_peity' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'chart_sparkline' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ecom_checkout' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ecom_customers' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ecom_invoice' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ecom_product_detail' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ecom_product_grid' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ecom_product_list' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ecom_product_order' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'email_compose' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/dropzone/dist/dropzone.css',
				],
				'email_inbox' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'email_read' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'form_editor_summernote' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/summernote/summernote.css',
				],
				'form_element' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'form_pickers' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/bootstrap-daterangepicker/daterangepicker.css',
					'admin/vendor/clockpicker/css/bootstrap-clockpicker.min.css',
					'admin/vendor/jquery-asColorPicker/css/asColorPicker.min.css',
					'admin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'admin/vendor/pickadate/themes/default.css',
					'admin/vendor/pickadate/themes/default.date.css',
				],
				'form_validation_jquery' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'form_wizard' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css',
				],
				'map_jqvmap' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/jqvmap/css/jqvmap.min.css',
				],
				'table_bootstrap_basic' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'table_datatable_basic' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/datatables/css/jquery.dataTables.min.css',
				],
				'uc_lightgallery' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/lightgallery/css/lightgallery.min.css',
				],
				'uc_nestable' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/nestable2/css/jquery.nestable.min.css',
				],
				'uc_noui_slider' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/nouislider/nouislider.min.css',
				],
				'uc_select2' => [
					'admin/vendor/select2/css/select2.min.css',
				],
				'uc_sweetalert' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'uc_toastr' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/toastr/css/toastr.min.css',
				],
				'ui_accordion' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_alert' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_badge' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_button' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_button_group' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_card' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_carousel' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_dropdown' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_grid' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_list_group' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_media_object' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_modal' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_pagination' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_popover' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_progressbar' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_tab' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'ui_typography' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'widget_basic' => [
					'admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
					'admin/vendor/chartist/css/chartist.min.css',
				],
			],
			'js' => [

				'saakin_dashborad' => [

					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/vendor/apexchart/apexchart.js',
					'admin/vendor/owl-carousel/owl.carousel.js',
					'admin/vendor/jqvmap/js/jquery.vmap.min.js',
					'admin/vendor/jqvmap/js/jquery.vmap.world.js',
					'admin/vendor/peity/jquery.peity.min.js',
					'admin/js/dashboard/dashboard-1.js',
					'admin/vendor/chartist/js/chartist.min.js',
					'admin/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'admin/js/plugins-init/chartjs-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
					'admin/vendor/flot/jquery.flot.js',
					'admin/vendor/flot/jquery.flot.pie.js',
					'admin/vendor/flot/jquery.flot.resize.js',
					'admin/vendor/flot-spline/jquery.flot.spline.min.js',
					'admin/js/plugins-init/flot-init.js',
					'admin/vendor/morris/raphael-min.js',
					'admin/vendor/morris/morris.min.js',
				],

				'saakin_create' => [

					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/summernote/js/summernote.min.js',
					'admin/js/plugins-init/summernote-init.js',
					'admin/vendor/select2/js/select2.full.min.js',
					'admin/js/plugins-init/select2-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',

				],

				'saakin_edit' => [

					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/summernote/js/summernote.min.js',
					'admin/js/plugins-init/summernote-init.js',
					'admin/vendor/select2/js/select2.full.min.js',
					'admin/js/plugins-init/select2-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',

				],

				'saakin_index' => [

					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/datatables/js/jquery.dataTables.min.js',
					'admin/js/plugins-init/datatables.init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
					'admin/vendor/nestable2/js/jquery.nestable.min.js',
					'admin/js/plugins-init/nestable-init.js',

				],

				'dashboard_1' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/vendor/apexchart/apexchart.js',
					'admin/vendor/owl-carousel/owl.carousel.js',
					'admin/vendor/jqvmap/js/jquery.vmap.min.js',
					'admin/vendor/jqvmap/js/jquery.vmap.world.js',
					'admin/vendor/peity/jquery.peity.min.js',
					'admin/js/dashboard/dashboard-1.js',
					'admin/vendor/chartist/js/chartist.min.js',
					'admin/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'admin/js/plugins-init/chartist-init.js',
					'admin/js/plugins-init/chartjs-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
					'admin/vendor/flot/jquery.flot.js',
					'admin/vendor/flot/jquery.flot.pie.js',
					'admin/vendor/flot/jquery.flot.resize.js',
					'admin/vendor/flot-spline/jquery.flot.spline.min.js',
					'admin/js/plugins-init/flot-init.js',
					'admin/vendor/morris/raphael-min.js',
					'admin/vendor/morris/morris.min.js',
					'admin/js/plugins-init/morris-init.js',
				],
				'analytics' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/vendor/apexchart/apexchart.js',
					'admin/vendor/peity/jquery.peity.min.js',
					'admin/vendor/jqvmap/js/jquery.vmap.min.js',
					'admin/vendor/jqvmap/js/jquery.vmap.world.js',
					'admin/js/dashboard/analytics.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'customer_list' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'property_details' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/vendor/owl-carousel/owl.carousel.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'order_list' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/vendor/datatables/js/jquery.dataTables.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'review' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'app_calender' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/vendor/apexchart/apexchart.js',
					'admin/vendor/jqueryui/js/jquery-ui.min.js',
					'admin/vendor/moment/moment.min.js',
					'admin/vendor/fullcalendar/js/fullcalendar.min.js',
					'admin/js/plugins-init/fullcalendar-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'app_profile' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/lightgallery/js/lightgallery-all.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'post_details' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/lightgallery/js/lightgallery-all.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'chart_chartist' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chartist/js/chartist.min.js',
					'admin/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'admin/js/plugins-init/chartist-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'chart_chartjs' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/js/plugins-init/chartjs-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'chart_flot' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/flot/jquery.flot.js',
					'admin/vendor/flot/jquery.flot.pie.js',
					'admin/vendor/flot/jquery.flot.resize.js',
					'admin/vendor/flot-spline/jquery.flot.spline.min.js',
					'admin/js/plugins-init/flot-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'chart_morris' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/morris/raphael-min.js',
					'admin/vendor/morris/morris.min.js',
					'admin/js/plugins-init/morris-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'chart_peity' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/peity/jquery.peity.min.js',
					'admin/js/plugins-init/piety-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',

				],
				'chart_sparkline' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/jquery-sparkline/jquery.sparkline.min.js',
					'admin/js/plugins-init/sparkline-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ecom_checkout' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/highlightjs/highlight.pack.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ecom_customers' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/highlightjs/highlight.pack.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ecom_invoice' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/highlightjs/highlight.pack.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ecom_product_detail' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/highlightjs/highlight.pack.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ecom_product_grid' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/highlightjs/highlight.pack.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ecom_product_list' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/highlightjs/highlight.pack.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ecom_product_order' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/highlightjs/highlight.pack.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'email_compose' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/dropzone/dist/dropzone.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'email_inbox' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'email_read' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'form_editor_summernote' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/summernote/js/summernote.min.js',
					'admin/js/plugins-init/summernote-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'form_element' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'form_pickers' => [

					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/moment/moment.min.js',
					'admin/vendor/bootstrap-daterangepicker/daterangepicker.js',
					'admin/vendor/clockpicker/js/bootstrap-clockpicker.min.js',
					'admin/vendor/jquery-asColor/jquery-asColor.min.js',
					'admin/vendor/jquery-asGradient/jquery-asGradient.min.js',
					'admin/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
					'admin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'admin/vendor/pickadate/picker.js',
					'admin/vendor/pickadate/picker.time.js',
					'admin/vendor/pickadate/picker.date.js',
					'admin/js/plugins-init/bs-daterange-picker-init.js',
					'admin/js/plugins-init/clock-picker-init.js',
					'admin/js/plugins-init/jquery-asColorPicker.init.js',
					'admin/js/plugins-init/material-date-picker-init.js',
					'admin/js/plugins-init/pickadate-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'form_validation_jquery' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/jquery-validation/jquery.validate.min.js',
					'admin/js/plugins-init/jquery.validate-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'form_wizard' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js',
					'admin/vendor/jquery-validation/jquery.validate.min.js',
					'admin/js/plugins-init/jquery.validate-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'map_jqvmap' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/jqvmap/js/jquery.vmap.min.js',
					'admin/vendor/jqvmap/js/jquery.vmap.world.js',
					'admin/vendor/jqvmap/js/jquery.vmap.usa.js',
					'admin/js/plugins-init/jqvmap-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_error_400' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_error_403' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_error_404' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_error_500' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_error_503' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_forgot_password' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_lock_screen' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/deznav/deznav.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_login' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'page_register' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'table_bootstrap_basic' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'table_datatable_basic' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/datatables/js/jquery.dataTables.min.js',
					'admin/js/plugins-init/datatables.init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'uc_lightgallery' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/lightgallery/js/lightgallery-all.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'uc_nestable' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/nestable2/js/jquery.nestable.min.js',
					'admin/js/plugins-init/nestable-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'uc_noui_slider' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/nouislider/nouislider.min.js',
					'admin/vendor/wnumb/wNumb.js',
					'admin/js/plugins-init/nouislider-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'uc_select2' => [
					'admin/vendor/select2/js/select2.full.min.js',
					'admin/js/plugins-init/select2-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'uc_sweetalert' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'admin/js/plugins-init/sweetalert.init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'uc_toastr' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/toastr/js/toastr.min.js',
					'admin/js/plugins-init/toastr-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_accordion' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_alert' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_badge' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_button' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_button_group' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_card' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_carousel' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_dropdown' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_grid' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_list_group' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_media_object' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_modal' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_pagination' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_popover' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_progressbar' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_tab' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'ui_typography' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				],
				'widget_basic' => [
					'admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'admin/vendor/chart.js/Chart.bundle.min.js',
					'admin/vendor/chartist/js/chartist.min.js',
					'admin/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'admin/vendor/flot/jquery.flot.js',
					'admin/vendor/flot/jquery.flot.pie.js',
					'admin/vendor/flot/jquery.flot.resize.js',
					'admin/vendor/flot-spline/jquery.flot.spline.min.js',
					'admin/vendor/jquery-sparkline/jquery.sparkline.min.js',
					'admin/js/plugins-init/sparkline-init.js',
					'admin/vendor/peity/jquery.peity.min.js',
					'admin/js/plugins-init/piety-init.js',
					'admin/js/plugins-init/widgets-script-init.js',
					'admin/js/custom.min.js',
					'admin/js/deznav-init.js',
				]

			]
		],
	]
];
