<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head>
<base href="../../">
	@include('elements.metadata')
	<!--begin::Page Vendor Stylesheets(used by this page)-->
	<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendor Stylesheets-->
</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
        <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        @include('Retailer.elements.retailer_aside')
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
		@include('Retailer.elements.header')
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
        <!--begin::Toolbar-->
		@include('Retailer.elements.breadcrum')

        <!--end::Toolbar-->
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
		@if (session('success'))
        @include('utils.successMessage',['message'=> session('success')])
		@endif
		@if (session('error'))
			@include('utils.errorMessage',['message'=> session('error')])
		@endif
		<div id="dashboard_content">
       		@yield('content')
		</div>
		</div>
		<!--end::Container-->
		</div>
		<!--end::Post-->
        </div>
         <!--end::Content-->
         <!--begin::Footer-->
            @include('elements.bodyFooter')
            <!--end::Footer-->
        </div>
        
        </div>
        <!--end::Page-->
        </div>
        <!--end::Root-->
         <!--start::Model Box-->
        @include('elements.modelbox')
        <!--end::Model Box-->
        <!--end::Modal - Invite Friend-->
		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";
		var baseUrl = "{{__(env('APP_URL'))}}/";
		var apiUrl = "{{__(env('APP_URL'))}}/v1/api/";
		
		</script>


		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>

		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/apps/customers/list/export.js"></script>
		<script src="assets/js/custom/apps/customers/list/list.js"></script>
		<script src="assets/js/custom/apps/customers/add.js"></script>
		<script src="assets/js/custom/web-utils.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script>
            $(document).ready(function() {
            $(document).on('click', '.kt_drawer_example_basic_button', function() {
                //alert('dasd');
                var idStr = $(this).attr('id');
                var urlText = $(this).attr('data-url');
                var enltid = $(this).attr('data-tid');  // It will return me the data
                KTDrawer.createInstances();
                var drawerElement = document.querySelector("#kt_drawer_example_basic");
                var drawer = KTDrawer.getInstance(drawerElement);
                drawer.show();
                // Example usage:
                const apiUrl = urlText;
                // Make a POST request with data
                const requestData = { ltid: enltid };
                makeAjaxRequest(apiUrl, 'POST', requestData)
                    .then(responseData => {
                        // Handle successful response
                        console.log('Response:', responseData);
                        $("#kt_drawer_example_basic").html(responseData);
                    })
                    .catch(error => {
                        // Handle error
                        console.error('Error:', error);
                    });
             });
        });

        function makeAjaxRequest(url, method, data) {
                return new Promise((resolve, reject) => {
                    fetch(url, {
                        method: method,
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        // Check if response is successful
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.indexOf('text/html') !== -1) {
                                return response.text(); // Parse response body as text
                        }
                        return response.json(); // Parse response body as JSON
                    })
                    .then(data => {
                        // Resolve promise with response data
                        resolve(data);
                    })
                    .catch(error => {
                        // Reject promise with error
                        reject(error);
                    });
                });
        }
        </script>
		<script>
			"use strict";
				var KTChartsWidget3 = {
					init: function () {
						!(function () {
							var e = document.getElementById("kt_charts_widget_100");
							if (e) {
								var a = parseInt(KTUtil.css(e, "height")),
									t = KTUtil.getCssVariableValue("--bs-gray-500"),
									l = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
									o = KTUtil.getCssVariableValue("--bs-danger"),
									r = KTUtil.getCssVariableValue("--bs-danger"),
									i = new ApexCharts(e, {
										series: [{ name: "Transactions", data: <?php echo $dashboardItem['chartItem']['sales']; ?> }],
										chart: { fontFamily: "inherit", type: "area", height: a, toolbar: { show: !1 } },
										plotOptions: {},
										legend: { show: !1 },
										dataLabels: { enabled: !1 },
										fill: { type: "gradient", gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0, stops: [0, 10, 1000] } },
										stroke: { curve: "smooth", show: !0, width: 3, colors: [o] },
										xaxis: {
											categories: <?php echo $dashboardItem['chartItem']['days']; ?>,
											axisBorder: { show: !1 },
											axisTicks: { show: !1 },
											tickAmount: 5,
											labels: { rotate: 0, rotateAlways: !0, style: { colors: t, fontSize: "12px" } },
											crosshairs: { position: "front", stroke: { color: o, width: 1, dashArray: 5 } },
											tooltip: { enabled: !0, formatter: void 0, offsetY: 0, style: { fontSize: "12px" } },
										},
										yaxis: {
											tickAmount: 4,
											max: 12000,
											min: 100,
											labels: {
												style: { colors: t, fontSize: "12px" },
												formatter: function (e) {
													return "Rs. " + e;
												},
											},
										},
										states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
										tooltip: {
											style: { fontSize: "12px" },
											y: {
												formatter: function (e) {
													return "Rs. " + e;
												},
											},
										},
										colors: [r],
										grid: { borderColor: l, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
										markers: { strokeColor: o, strokeWidth: 5 },
									});
								setTimeout(function () {
									i.render();
								}, 200);
							}
						})();
					},
				};
				"undefined" != typeof module && (module.exports = KTChartsWidget3),
					KTUtil.onDOMContentLoaded(function () {
						KTChartsWidget3.init();
				});
				var KTChartsWidget23 = {
			init: function () {
			!(function () {
				
				if ("undefined" != typeof am5) {
					var e = document.getElementById("kt_charts_widget_23");
					e &&
						am5.ready(function () {
							var a = am5.Root.new(e);
							a.setThemes([am5themes_Animated.new(a)]);
							var t = a.container.children.push(am5xy.XYChart.new(a, { panX: !1, panY: !1, layout: a.verticalLayout })),
								l = [
									{ day: "16 APR", income: 235000, expenses: 210000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "17 APR", income: 262000, expenses: 300000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "18 APR", income: 300000, expenses: 540000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "19 APR", income: 990000, expenses: 400000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "20 APR", income: 300000, expenses: 282222, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "21 APR", income: 40000, expenses: 28000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "22 APR", income: 340000, expenses: 32000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
								],
								o = t.xAxes.push(am5xy.CategoryAxis.new(a, { categoryField: "day", renderer: am5xy.AxisRendererX.new(a, {}) }));
								o.data.setAll(l),
									o.get("renderer").labels.template.setAll({ paddingTop: 20, fontWeight: "400", fontSize: 11, fill: am5.color(KTUtil.getCssVariableValue("--bs-gray-500")) }),
									o.get("renderer").grid.template.setAll({ disabled: !0, strokeOpacity: 0 });
								var r = t.yAxes.push(am5xy.ValueAxis.new(a, { min: 0, extraMax: 0.1, renderer: am5xy.AxisRendererY.new(a, {}) }));
								r.get("renderer").labels.template.setAll({ paddingTop: 0, fontWeight: "400", fontSize: 11, fill: am5.color(KTUtil.getCssVariableValue("--bs-gray-500")) }),
									r.get("renderer").grid.template.setAll({ stroke: am5.color(KTUtil.getCssVariableValue("--bs-gray-300")), strokeWidth: 1, strokeOpacity: 1, strokeDasharray: [3] });
								var i = t.series.push(
								am5xy.ColumnSeries.new(a, {
									name: "Income",
									xAxis: o,
									yAxis: r,
									valueYField: "income",
									categoryXField: "day",
									tooltip: am5.Tooltip.new(a, { pointerOrientation: "horizontal", labelText: "{name} in {categoryX}: {valueY} {info}" }),
								})
							);
							i.columns.template.setAll({ tooltipY: am5.percent(10), templateField: "columnSettings" }), i.data.setAll(l);
							var s = t.series.push(
								am5xy.LineSeries.new(a, {
									name: "Payout",
									xAxis: o,
									yAxis: r,
									valueYField: "expenses",
									categoryXField: "day",
									fill: am5.color(KTUtil.getCssVariableValue("--bs-danger")),
									stroke: am5.color(KTUtil.getCssVariableValue("--bs-success")),
									tooltip: am5.Tooltip.new(a, { pointerOrientation: "horizontal", labelText: "{name} in {categoryX}: {valueY} {info}" }),
								})
							);
							s.strokes.template.setAll({ stroke: am5.color(KTUtil.getCssVariableValue("--bs-success")) }),
								s.strokes.template.setAll({ strokeWidth: 2, templateField: "strokeSettings" }),
								s.data.setAll(l),
								s.bullets.push(function () {
									return am5.Bullet.new(a, {
										sprite: am5.Circle.new(a, { strokeWidth: 3, stroke: am5.color(KTUtil.getCssVariableValue("--bs-success")), radius: 3, fill: am5.color(KTUtil.getCssVariableValue("--bs-light-success")) }),
									});
								}),
								i.columns.template.setAll({ strokeOpacity: 0, cornerRadiusBR: 0, cornerRadiusTR: 6, cornerRadiusBL: 0, cornerRadiusTL: 6 }),
								t.set("cursor", am5xy.XYCursor.new(a, {})),
								t.get("cursor").lineX.setAll({ visible: !1 }),
								t.get("cursor").lineY.setAll({ visible: !1 }),
								t.children.push(am5.Legend.new(a, { centerX: am5.p50, x: am5.p50 })).data.setAll(t.series.values),
								t.appear(1e3, 100),
								i.appear();
						});
				}
			})();
		},
	};
	"undefined" != typeof module && (module.exports = KTChartsWidget23),
		KTUtil.onDOMContentLoaded(function () {
			KTChartsWidget23.init();
		});
			
		</script>
		
	</body>
	<!--end::Body-->
</html>
