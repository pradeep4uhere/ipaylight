<!DOCTYPE html>
<html lang="en">
@props(['title'])
<!--begin::Head-->
<head><base href="../../">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{config('global.THEME_PATH')}}/images/favicon.png" rel="icon" />
<link rel="apple-touch-icon" sizes="57x57" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="{{config('global.THEME_PATH')}}/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="{{config('global.THEME_PATH')}}/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="{{config('global.THEME_PATH')}}/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="{{config('global.THEME_PATH')}}/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{config('global.THEME_PATH')}}/favicon/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="https://payertrust.in/public/themes/siddiventures/favicon//ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<title>{{ isset($pageTitle) ? $pageTitle : 'PayerTrust: Simple Secure and Simple' }}</title>
<meta name="description" content="PayerTrust - Safe Smart Easy Way">
<meta name="author" content="Pradeep Kumar|go4shoponline@gmail.com|www.go4shop.online">
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />

		
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
        @include('Admin.elements.Admin.admin_aside')
        <!--end::Aside-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
		@if(!empty($userProfile))
			@if($userProfile->role == 'retailer')
				@include('Admin.elements.Retailer.header')
			@elseif($userProfile->role == 'user')
				@include('Admin.elements.user.header')
			@elseif($userProfile->role == 'distributor')
				@include('Admin.elements.Distributor.header')
			@else
			@include('Admin.elements.Admin.header')
			@endif
		@else
			@include('Admin.elements.Admin.header')
		@endif
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">    
        <!--begin::Toolbar-->
		@if(!empty($userProfile))
			@if($userProfile->role == 'retailer')
			@include('Admin.elements.Retailer.breadcrum')
			@elseif($userProfile->role == 'user')
			@include('Admin.elements.Admin.breadcrum')
			@elseif($userProfile->role == 'distributor')
			@include('Admin.elements.Admin.breadcrum')
			@else
			@include('Admin.elements.Admin.breadcrum')
			@endif
		@else
		@include('Admin.elements.Admin.breadcrum')
		@endif

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
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		
		<!--https://developers.google.com/chart/interactive/docs/gallery/piechart#donut-->
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['PG Type', 'Transactions'],
				['PG-1',     1001],
				['PG-2',      200],
				['PG-3',  432],
				['PG-4', 132],
				['PG-5',  379]
				]);

				var options = {
				title: '',
				is3D: true,
				};

				var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
				chart.draw(data, options);
			}
		</script>
		<script type="text/javascript">
			google.charts.load("current", {packages:["corechart"]});
			google.charts.setOnLoadCallback(drawChart);
			function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['Support Tickets', 'Resolve'],
				['New',     100],
				['Open',     1001],
				['InProgress', 200],
				['Closed',  800],
				]);
				var options = {
				title: '',
				is3D: true,
				};
				var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_support'));
				chart.draw(data, options);
			}
		</script>



<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'PG-1', 'PG-2', 'PG-2','PG-2', 'PG-2'],
          ['SUN',  1000, 400, 1200,1500,5300],
          ['MON',  1170, 460,4200,1100,1300],
          ['TUE',  660,  1120,5200,2100,6300],
          ['WED',  1030, 540,6200,4100,4300],
		  ['THU',  1030, 540,1200,8100,2300],
		  ['FRI',  1030, 540,2000,3100,2300],
		  ['SAT',  1030, 140,5200,4100,6300],
		]);

        var options = {
          title: '',
          curveType: 'function',
          legend: { position: 'top' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>


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
											max: 1500000,
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
									{ day: "23 APR", income: 235000, expenses: 210000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "24 APR", income: 262000, expenses: 300000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "25 APR", income: 300000, expenses: 540000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "26 APR", income: 990000, expenses: 400000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "27 APR", income: 300000, expenses: 282222, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "28 APR", income: 40000, expenses: 28000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "29 APR", income: 340000, expenses: 32000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "30 APR", income: 235000, expenses: 210000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "1 APR", income: 235000, expenses: 210000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "2 APR", income: 262000, expenses: 300000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "3 APR", income: 300000, expenses: 540000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "4 APR", income: 990000, expenses: 400000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "5 APR", income: 300000, expenses: 282222, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "6 APR", income: 40000, expenses: 28000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "7 APR", income: 340000, expenses: 32000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "8 APR", income: 235000, expenses: 210000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "9 APR", income: 262000, expenses: 300000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "10 APR", income: 300000, expenses: 540000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "11 APR", income: 990000, expenses: 400000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "12 APR", income: 300000, expenses: 282222, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "13 APR", income: 40000, expenses: 28000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "14 APR", income: 340000, expenses: 32000, strokeSettings: { strokeWidth: 3, strokeDasharray: [5, 5] }, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
									{ day: "15 APR", income: 235000, expenses: 210000, columnSettings: { fill: am5.color(KTUtil.getCssVariableValue("--bs-primary")) } },
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
									name: "PayIn",
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

	//chart4
		var KTChartsWidget4 = {
		init: function () {
			!(function () {
				var e = document.getElementById("kt_charts_widget_4");
				if (e) {
					var a = parseInt(KTUtil.css(e, "height")),
						t = KTUtil.getCssVariableValue("--bs-gray-500"),
						l = KTUtil.getCssVariableValue("--bs-border-dashed-color"),
						o = KTUtil.getCssVariableValue("--bs-primary"),
						r = KTUtil.getCssVariableValue("--bs-primary"),
						i = new ApexCharts(e, {
							series: [{ name: "Payout", data: [250000.5, 65000.5, 760000, 900000, 290000, 4500009, 3598765, 2344435, 900035, 3550000, 490000, 835098, 760009, 1345098, 3087655, 2350987, 3980005, 350000, 900335] }],
							chart: { fontFamily: "inherit", type: "area", height: a, toolbar: { show: !1 } },
							plotOptions: {},
							legend: { show: !1 },
							dataLabels: { enabled: !1 },
							fill: { type: "gradient", gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0, stops: [0, 80, 100] } },
							stroke: { curve: "smooth", show: !0, width: 3, colors: [o] },
							xaxis: {
								categories: ["", "Apr 02", "Apr 03", "Apr 04", "Apr 05", "Apr 06", "Apr 07", "Apr 08", "Apr 09", "Apr 10", "Apr 11", "Apr 12", "Apr 13", "Apr 14", "Apr 17", "Apr 18", "Apr 19", "Apr 21", ""],
								axisBorder: { show: !1 },
								axisTicks: { show: !1 },
								tickAmount: 7,
								labels: { rotate: 0, rotateAlways: !0, style: { colors: t, fontSize: "12px" } },
								crosshairs: { position: "front", stroke: { color: o, width: 1, dashArray: 3 } },
								tooltip: { enabled: !0, formatter: void 0, offsetY: 0, style: { fontSize: "12px" } },
							},
							yaxis: {
								max: 9000000,
								min: 1000,
								tickAmount: 6,
								labels: {
									style: { colors: t, fontSize: "12px" },
									formatter: function (e) {
										return "RS." + parseInt(10 * e);
									},
								},
							},
							states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
							tooltip: {
								style: { fontSize: "12px" },
								y: {
									formatter: function (e) {
										return "$" + parseInt(10 * e);
									},
								},
							},
							colors: [r],
							grid: { borderColor: l, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
							markers: { strokeColor: o, strokeWidth: 3 },
						});
					setTimeout(function () {
						i.render();
					}, 200);
				}
			})();
		},
	};
	"undefined" != typeof module && (module.exports = KTChartsWidget4),
		KTUtil.onDOMContentLoaded(function () {
			KTChartsWidget4.init();
	});



	//Chart-3
	(function () {
                var e = document.getElementById("kt_charts_widget_33_chart"),
                    t = (parseInt(KTUtil.css(e, "height")), KTUtil.getCssVariableValue("--bs-gray-500")),
                    a = KTUtil.getCssVariableValue("--bs-gray-200"),
                    o = KTUtil.getCssVariableValue("--bs-info"),
                    s = KTUtil.getCssVariableValue("--bs-light-info");
                e &&
                    new ApexCharts(e, {
                        series: [{ name: "Total Net Profit", data: [30, 40, 40, 90, 90, 70, 70] }],
                        chart: { fontFamily: "inherit", type: "area", height: 350, toolbar: { show: !1 } },
                        plotOptions: {},
                        legend: { show: !1 },
                        dataLabels: { enabled: !1 },
                        fill: { type: "solid", opacity: 1 },
                        stroke: { curve: "smooth", show: !0, width: 3, colors: [o] },
                        xaxis: {
                            categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
                            axisBorder: { show: !1 },
                            axisTicks: { show: !1 },
                            labels: { style: { colors: t, fontSize: "12px" } },
                            crosshairs: { position: "front", stroke: { color: o, width: 1, dashArray: 3 } },
                            tooltip: { enabled: !0, formatter: void 0, offsetY: 0, style: { fontSize: "12px" } },
                        },
                        yaxis: { labels: { style: { colors: t, fontSize: "12px" } } },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return "Rs." + e + " Thousands";
                                },
                            },
                        },
                        colors: [s],
                        grid: { borderColor: a, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                        markers: { strokeColor: o, strokeWidth: 3 },
                    }).render();
            })();

	(function () {
                var e = document.getElementById("kt_charts_widget_44_chart"),
                    t = (parseInt(KTUtil.css(e, "height")), KTUtil.getCssVariableValue("--bs-gray-500")),
                    a = KTUtil.getCssVariableValue("--bs-gray-200"),
                    o = KTUtil.getCssVariableValue("--bs-success"),
                    s = KTUtil.getCssVariableValue("--bs-light-success"),
                    r = KTUtil.getCssVariableValue("--bs-warning"),
                    i = KTUtil.getCssVariableValue("--bs-light-warning");
                e &&
                    new ApexCharts(e, {
                        series: [
                            { name: "Net Profit", data: [60, 50, 80, 40, 100, 60] },
                            { name: "Revenue", data: [70, 60, 110, 40, 50, 70] },
                        ],
                        chart: { fontFamily: "inherit", type: "area", height: 350, toolbar: { show: !1 } },
                        plotOptions: {},
                        legend: { show: !1 },
                        dataLabels: { enabled: !1 },
                        fill: { type: "solid", opacity: 1 },
                        stroke: { curve: "smooth" },
                        xaxis: {
                            categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                            axisBorder: { show: !1 },
                            axisTicks: { show: !1 },
                            labels: { style: { colors: t, fontSize: "12px" } },
                            crosshairs: { position: "front", stroke: { color: t, width: 1, dashArray: 3 } },
                            tooltip: { enabled: !0, formatter: void 0, offsetY: 0, style: { fontSize: "12px" } },
                        },
                        yaxis: { labels: { style: { colors: t, fontSize: "12px" } } },
                        states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return "Rs." + e + " thousands";
                                },
                            },
                        },
                        colors: [o, r],
                        grid: { borderColor: a, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                        markers: { colors: [s, i], strokeColor: [s, i], strokeWidth: 3 },
                    }).render();
            })();



			(function () {
                var e = document.getElementById("kt_charts_widget_77_chart"),
                    t = parseInt(KTUtil.css(e, "height")),
                    a = KTUtil.getCssVariableValue("--bs-gray-500"),
                    o = KTUtil.getCssVariableValue("--bs-gray-200"),
                    s = KTUtil.getCssVariableValue("--bs-gray-300"),
                    r = KTUtil.getCssVariableValue("--bs-warning"),
                    i = KTUtil.getCssVariableValue("--bs-light-warning"),
                    l = KTUtil.getCssVariableValue("--bs-success"),
                    n = KTUtil.getCssVariableValue("--bs-light-success"),
                    c = KTUtil.getCssVariableValue("--bs-primary"),
                    d = KTUtil.getCssVariableValue("--bs-light-primary");
                e &&
                    new ApexCharts(e, {
                        series: [
                            { name: "Net Profit", data: [300, 30, 50, 50, 35, 35] },
                            { name: "Revenue", data: [550, 20, 20, 500, 70, 70] },
                            { name: "Expenses", data: [600, 60, 40, 450, 30, 30] },
                        ],
                        chart: { fontFamily: "inherit", type: "area", height: t, toolbar: { show: !1 }, zoom: { enabled: !1 }, sparkline: { enabled: !0 } },
                        plotOptions: {},
                        legend: { show: !1 },
                        dataLabels: { enabled: !1 },
                        fill: { type: "solid", opacity: 1 },
                        stroke: { curve: "smooth", show: !0, width: 2, colors: [r, "transparent", "transparent"] },
                        xaxis: {
                            categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                            axisBorder: { show: !1 },
                            axisTicks: { show: !1 },
                            labels: { show: 1, style: { colors: a, fontSize: "12px" } },
                            crosshairs: { show: !1, position: "front", stroke: { color: s, width: 1, dashArray: 3 } },
                            tooltip: { enabled: !0, formatter: void 0, offsetY: 0, style: { fontSize: "12px" } },
                        },
                        yaxis: { labels: { show: !1, style: { colors: a, fontSize: "12px" } } },
                        states: { normal: { filter: { type: "none", value: 1 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: function (e) {
                                    return "Rs." + e + " Thousands";
                                },
                            },
                        },
                        colors: [r, l, c],
                        grid: { borderColor: o, strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                        markers: { colors: [i, n, d], strokeColor: [r, l, c], strokeWidth: 3 },
                    }).render();
            })();


		
	</script>
	</body>
	<!--end::Body-->
</html>
