// grafico barre visualizzazioni homepage

function createChart(par, periodo) {
	am4core.useTheme(am4themes_animated);
	switch (par) {
		case "home":
			var chart = am4core.create("XYchart", am4charts.XYChart);

			chart.language.locale = am4lang_it_IT;
			chart.numberFormatter.language = new am4core.Language();
			chart.numberFormatter.language.locale = am4lang_it_IT;
			chart.dateFormatter.language = new am4core.Language();
			chart.dateFormatter.language.locale = am4lang_it_IT;

			chart.dataSource.url = "dataCharts/results.json";

			if (periodo == "day") {
				var dateAxis = chart.xAxes.push(new am4charts.CategoryAxis());
				dateAxis.dataFields.category = "ora";
				dateAxis.title.text = "Ora";
			} else {
				var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
			}

			dateAxis.baseInterval = {
				"timeUnit": "day",
				"count": 1
			}

			var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

			// Create series
			var series = chart.series.push(new am4charts.LineSeries());
			series.dataFields.valueY = "numero";
			if (periodo == "day")
				series.dataFields.categoryX = "ora";
			else
				series.dataFields.dateX = "ora";
			series.strokeWidth = 2;

			chart.cursor = new am4charts.XYCursor();
			chart.cursor.behavior = "panXY";
			chart.cursor.xAxis = dateAxis;
			chart.cursor.snapToSeries = series;

			// Create a horizontal scrollbar with previe and place it underneath the date axis
			chart.scrollbarX = new am4charts.XYChartScrollbar();
			chart.scrollbarX.minHeight = 20;
			chart.scrollbarX.parent = chart.bottomAxesContainer;

			var bullet = series.bullets.push(new am4charts.CircleBullet());
			bullet.circle.strokeWidth = 2;
			bullet.circle.radius = 4;
			bullet.circle.fill = am4core.color("#fff");

			break;
		case "dispositivi":
			var chart = am4core.create(
				"grafico",
				am4charts.PieChart
			);

			chart.language.locale = am4lang_it_IT;
			chart.numberFormatter.language = new am4core.Language();
			chart.numberFormatter.language.locale = am4lang_it_IT;
			chart.dateFormatter.language = new am4core.Language();
			chart.dateFormatter.language.locale = am4lang_it_IT;

			chart.responsive.enabled = true;

			chart.dataSource.url = "dataCharts/resultDevice.json";

			var pieSeries = chart.series.push(new am4charts.PieSeries());
			pieSeries.dataFields.value = "numero";
			pieSeries.dataFields.category = "device";

			if (screen.width <= 500)
				pieSeries.labels.template.disabled = true;

			chart.legend = new am4charts.Legend();

			break;
		case "location":
			var chart = am4core.create(
				"XYchartLocation",
				am4charts.XYChart
			);

			chart.language.locale = am4lang_it_IT;
			chart.numberFormatter.language = new am4core.Language();
			chart.numberFormatter.language.locale = am4lang_it_IT;
			chart.dateFormatter.language = new am4core.Language();
			chart.dateFormatter.language.locale = am4lang_it_IT;

			chart.responsive.enabled = true;

			chart.dataSource.url = "dataCharts/resultLocation.json";

			var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
			categoryAxis.dataFields.category = "country";

			categoryAxis.renderer.minGridDistance = 1;

			var xAxis = chart.xAxes.push(new am4charts.ValueAxis());

			var series = chart.series.push(new am4charts.ColumnSeries());
			series.dataFields.valueX = "numero";
			series.dataFields.categoryY = "country";

			series.columns.template.fill = am4core.color("#2e90b1");
			series.columns.template.column.cornerRadiusTopRight = 5;
			series.columns.template.column.cornerRadiusBottomRight = 5;
			series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";

			break;
	}

}


/*grafico homepage con AJAX*/


function reloadGraph(par) {
	var periodo = document.getElementById("periodo").value;
	var pagina = document.getElementById("pagina").value;

	var xhttp = new XMLHttpRequest(); //creazione oggetto per chiamata
	xhttp.onreadystatechange = function () {  //quando l'elemento è stato caricato chiamo la funzione
		if (this.readyState == 4 && this.status == 200) { //se la richesta è andata a buon fine posso chiamare la funzione
			createChart(par, periodo);
		}

	}

	var urlCall = "grafico.php?periodo=" + periodo + "&pagina=" + pagina + "&filtro=" + par;

	xhttp.open("GET", urlCall, true);	//metodo che specifica il tipo di richiesta
	xhttp.send();	//metodo per inviare la richiesta
}