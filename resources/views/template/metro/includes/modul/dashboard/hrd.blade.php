<style>
#chartdiv, #chartdiv2, #chartdiv3, #chartdiv4, #chartdiv5, #chartdiv6, #chartdiv7,#chartdiv8 {
  width: 100%;
  height: 400px;
}

</style>


<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat dashboard-stat-v2 blue" href="#">
			<div class="visual">
				<i class="fa fa-users"></i>
			</div>
			<div class="details">
				<div class="number">
					<span data-counter="counterup" data-value="1349">{{$karyaktif[0]->jmlhaktf}}</span>
				</div>
				<div class="desc"> Total Karyawan Aktif </div>
			</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat dashboard-stat-v2 red" href="#">
			<div class="visual">
				<i class="fa fa-user-times"></i>
			</div>
			<div class="details">
				<div class="number">
					<span data-counter="counterup" data-value="12,5">{{$abisbulanini[0]->absblnini}}</div>
					<div class="desc"> Karyawan Habis Kontrak Bulan Ini </div>
				</div>
			</a>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat dashboard-stat-v2 green" href="#">
			<div class="visual">
				<i class="fa fa-user-plus"></i>
			</div>
			<div class="details">
				<div class="number">
					<span data-counter="counterup" data-value="549">{{$newemp[0]->newemp}}</span>
				</div>
				<div class="desc"> Karyawan Baru Bulan Ini </div>
			</div>
		</a>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a class="dashboard-stat dashboard-stat-v2 purple" href="#">
			<div class="visual">
				<i class="fa fa-money"></i>
			</div>
			<div class="details">
				<div class="number">
					<span data-counter="counterup" data-value="89"></span>{{number_format($totalgaji[0]->totalgaji,2)}}</div>
					<div class="desc"> Total Sallary </div>
				</div>
			</a>
		</div>	
	</div>

	<div class="row">
		<div class="col-md-6">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-bar-chart font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">Jumlah Karyawan Per Tahun</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv"></div>
						</div>
				</div>
			</div>
		</div>
			<div class="col-md-6">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-pie-chart font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">Karyawan Berdasarkan Pendidikan</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv2"></div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-intersex font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">Karyawan Berdasarkan Gender</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv3"></div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-users font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">TOP 5 Karyawan Terbaru</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv4"></div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-users font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">Status Karyawan</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv5"></div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-users font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">Jumlah Karyawan Berdasarkan Departemen</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv6"></div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-users font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">Jumlah Karyawan Berdasarkan Umur</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv7"></div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<!-- BEGIN CHART PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-users font-green-haze"></i>
						<span class="caption-subject bold uppercase font-green-haze">Grafik --</span>
						<span class="caption-helper">Jumlah Karyawan Keluar Masuk 1 Tahun Terakhir</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="#portlet-config" data-toggle="modal" class="config"> </a>
						<a href="javascript:;" class="reload"> </a>
						<a href="javascript:;" class="fullscreen"> </a>
						<a href="javascript:;" class="remove"> </a>
					</div>
				</div>
				<div class="portlet-body">
						<div class="row">
							<div id="chartdiv8"></div>
						</div>
				</div>
			</div>
		</div>
	<div class="col-lg-6 col-xs-12 col-sm-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bubble font-dark hide"></i>
					<span class="caption-subject font-hide bold uppercase">Jadwal Pembaca Doa Pagi Selanjutnya</span>
				</div>

			</div>
			<div class="portlet-body">
				<div class="row">
					@foreach($pembacadoa as $baca)
					<div class="col-md-6">
						<!--begin: widget 1-1 -->
						<div class="mt-widget-1">
							
							<div class="mt-img">
								@if(isset($baca->photo))
									<img src="data:image/png;base64,{{ chunk_split(base64_encode($baca->photo)) }}" width="100%"> 
								@else
									<img src="https://image.shutterstock.com/z/stock-vector-no-image-available-vector-hand-drawn-illustration-with-camera-icon-on-white-background-745639717.jpg" width="100%">
								@endif	
							</div>

								<div class="mt-body">
									<h3 class="mt-username">{{$baca->nama}}</h3>
									<p class="mt-user-title">{{$baca->keterangan}}</p>
									<div class="mt-stats">
									</div>
								</div>
						</div>
										<!--end: widget 1-1 -->
					</div>
					@endforeach

													

	</div>


<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart3D);

// Add data
chart.dataSource.url = "{{route('grafiktotalperyear')}}";

// Create axes
let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "tahun";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.renderer.labels.template.hideOversized = false;
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.tooltip.label.rotation = 270;
categoryAxis.tooltip.label.horizontalCenter = "right";
categoryAxis.tooltip.label.verticalCenter = "middle";

let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Jumlah Karyawan";
valueAxis.title.fontWeight = "bold";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "jumlah";
series.dataFields.categoryX = "tahun";
series.name = "Jumlah";
series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;
columnTemplate.stroke = am4core.color("#FFFFFF");

columnTemplate.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

columnTemplate.adapter.add("stroke", function(stroke, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

chart.cursor = new am4charts.XYCursor();
chart.cursor.lineX.strokeOpacity = 0;
chart.cursor.lineY.strokeOpacity = 0;
chart.exporting.menu = new am4core.ExportMenu();





// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv2", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.legend = new am4charts.Legend();

chart.dataSource.url = "{{route('grafikpendidikan')}}";

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "jumlah";
series.dataFields.category = "kode";
series.colors.step = 17;
chart.exporting.menu = new am4core.ExportMenu();



// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var iconPath = "M53.5,476c0,14,6.833,21,20.5,21s20.5-7,20.5-21V287h21v189c0,14,6.834,21,20.5,21 c13.667,0,20.5-7,20.5-21V154h10v116c0,7.334,2.5,12.667,7.5,16s10.167,3.333,15.5,0s8-8.667,8-16V145c0-13.334-4.5-23.667-13.5-31 s-21.5-11-37.5-11h-82c-15.333,0-27.833,3.333-37.5,10s-14.5,17-14.5,31v133c0,6,2.667,10.333,8,13s10.5,2.667,15.5,0s7.5-7,7.5-13 V154h10V476 M61.5,42.5c0,11.667,4.167,21.667,12.5,30S92.333,85,104,85s21.667-4.167,30-12.5S146.5,54,146.5,42 c0-11.335-4.167-21.168-12.5-29.5C125.667,4.167,115.667,0,104,0S82.333,4.167,74,12.5S61.5,30.833,61.5,42.5z"



var chart = am4core.create("chartdiv3", am4charts.SlicedChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

chart.dataSource.url = "{{route('grafikjk')}}";

var series = chart.series.push(new am4charts.PictorialStackedSeries());
series.dataFields.value = "jumlah";
series.dataFields.category = "JenisKelamin";
series.alignLabels = true;

series.maskSprite.path = iconPath;
series.ticks.template.locationX = 1;
series.ticks.template.locationY = 0.5;
series.colors.step = 16;

series.labelsContainer.width = 200;

chart.legend = new am4charts.Legend();
chart.legend.position = "left";
chart.legend.valign = "top";

chart.exporting.menu = new am4core.ExportMenu();





var chart = am4core.create("chartdiv4", am4charts.XYChart);
chart.hiddenState.properties.opacity = 10; // this creates initial fade-in

chart.paddingRight = 20;
chart.paddingLeft = 30;

chart.dataSource.url = "{{route('grafikterlama')}}";

var categoryAxis2 = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis2.dataFields.category = "nama";
categoryAxis2.renderer.grid.template.strokeOpacity = 0;
categoryAxis2.renderer.minGridDistance = 10;
categoryAxis2.renderer.labels.template.dx = -40;
categoryAxis2.renderer.minWidth = 120;
categoryAxis2.renderer.tooltip.dx = -40;

var valueAxis2 = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis2.renderer.inside = true;
valueAxis2.renderer.labels.template.fillOpacity = 0.3;
valueAxis2.renderer.grid.template.strokeOpacity = 0;
valueAxis2.min = 0;
valueAxis2.cursorTooltipEnabled = false;
valueAxis2.renderer.baseGrid.strokeOpacity = 0;
valueAxis2.renderer.labels.template.dy = 20;

var series = chart.series.push(new am4charts.ColumnSeries);
series.dataFields.valueX = "jumlah";
series.dataFields.categoryY = "nama";
series.tooltipText = "{valueX.value}";
series.tooltip.pointerOrientation = "vertical";
series.tooltip.dy = - 30;
series.columnsContainer.zIndex = 100;

var columnTemplate = series.columns.template;
columnTemplate.height = am4core.percent(50);
columnTemplate.maxHeight = 50;
columnTemplate.column.cornerRadius(60, 10, 60, 10);
columnTemplate.strokeOpacity = 0;

series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueX", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
series.mainContainer.mask = undefined;

var cursor = new am4charts.XYCursor();
chart.cursor = cursor;
cursor.lineX.disabled = true;
cursor.lineY.disabled = true;
cursor.behavior = "none";

var bullet = columnTemplate.createChild(am4charts.CircleBullet);
bullet.circle.radius = 30;
bullet.valign = "middle";
bullet.align = "left";
bullet.isMeasured = true;
bullet.interactionsEnabled = false;
bullet.horizontalCenter = "right";
bullet.interactionsEnabled = false;

var hoverState = bullet.states.create("hover");
var outlineCircle = bullet.createChild(am4core.Circle);
outlineCircle.adapter.add("radius", function (radius, target) {
    var circleBullet = target.parent;
    return circleBullet.circle.pixelRadius + 10;
})

var image = bullet.createChild(am4core.Image);
image.width = 60;
image.height = 60;
image.horizontalCenter = "middle";
image.verticalCenter = "middle";
image.propertyFields.href = "href";

image.adapter.add("mask", function (mask, target) {
    var circleBullet = target.parent;
    return circleBullet.circle;
})

var previousBullet;
chart.cursor.events.on("cursorpositionchanged", function (event) {
    var dataItem = series.tooltipDataItem;

    if (dataItem.column) {
        var bullet = dataItem.column.children.getIndex(1);

        if (previousBullet && previousBullet != bullet) {
            previousBullet.isHover = false;
        }

        if (previousBullet != bullet) {

            var hs = bullet.states.getKey("hover");
            hs.properties.dx = dataItem.column.pixelWidth;
            bullet.isHover = true;

            previousBullet = bullet;
        }
    }
})



var chart = am4core.create("chartdiv5", am4charts.PieChart);

// Add data
chart.dataSource.url = "{{route('grafikstkaryawan')}}";

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "jumlah";
pieSeries.dataFields.category = "status";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.colors.step = 4;
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

var rgm = new am4core.RadialGradientModifier();
rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
pieSeries.slices.template.fillModifier = rgm;
pieSeries.slices.template.strokeModifier = rgm;
pieSeries.slices.template.strokeOpacity = 0.4;
pieSeries.slices.template.strokeWidth = 0;

chart.legend = new am4charts.Legend();
chart.legend.position = "right";

chart.exporting.menu = new am4core.ExportMenu();





// Create chart
var chart = am4core.create("chartdiv6", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 5; // this creates initial fade-in

chart.dataSource.url = "{{route('grafikbydept')}}";

chart.innerRadius = am4core.percent(50);
chart.depth = 200;

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "jumlah";
series.dataFields.depthValue = "jumlah";
series.dataFields.category = "Departemen";
series.ticks.template.disabled = true;
series.labels.template.disabled = true;
series.slices.template.cornerRadius = 5;
series.colors.step = 4;
series.zIndex= 100000;

chart.legend = new am4charts.Legend();
chart.legend.position = "right";
chart.legend.maxHeight = 500;
chart.legend.maxWidth = 500;
chart.legend.scrollable = true;

chart.exporting.menu = new am4core.ExportMenu();




var chart = am4core.create("chartdiv7", am4charts.SlicedChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect
chart.dataSource.url = "{{route('grafikbyumur')}}";

var series = chart.series.push(new am4charts.FunnelSeries());
series.colors.step = 2;
series.dataFields.value = "jumlah";
series.dataFields.category = "rangeumur";
series.alignLabels = true;

series.labelsContainer.paddingLeft = 15;
series.labelsContainer.width = 100;

//series.orientation = "horizontal";
//series.bottomRatio = 1;

chart.legend = new am4charts.Legend();
chart.legend.position = "left";
chart.legend.valign = "bottom";
chart.legend.margin(5,5,20,5);




var chart = am4core.create("chartdiv8", am4charts.XYChart3D);

chart.dataSource.url = "{{route('grafikkeluarmasuk')}}";

// Create axes
var categoryAxis8 = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis8.dataFields.category = "periode";
categoryAxis8.renderer.grid.template.location = 0;
categoryAxis8.renderer.minGridDistance = 30;

var valueAxis8 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis8.title.text = "Jumlah Karyawan";
valueAxis8.renderer.labels.template.adapter.add("text", function(text) {
  return text + "";
});

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "jumlahkeluar";
series.dataFields.categoryX = "periode";
series.name = "Jumlah Keluar";
series.clustered = false;
series.columns.template.tooltipText = "Jumlah Keluar : [bold]{valueY}[/]";
series.columns.template.fillOpacity = 0.9;

var series2 = chart.series.push(new am4charts.ColumnSeries3D());
series2.dataFields.valueY = "jumlahmasuk";
series2.dataFields.categoryX = "periode";
series2.name = "Jumlah Masuk";
series2.clustered = false;
series2.columns.template.tooltipText = "Jumlah Masuk: [bold]{valueY}[/]";











}); // end am4core.ready()
</script>