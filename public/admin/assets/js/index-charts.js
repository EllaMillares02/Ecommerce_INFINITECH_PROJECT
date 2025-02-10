'use strict';

/* Chart.js docs: https://www.chartjs.org/ */

window.chartColors = {
	green: '#75c181',
	gray: '#a9b5c9',
	text: '#252930',
	border: '#e7e9ed'
};

 // Prepare labels (e.g., dates) and data (e.g., sales amounts)
 const labels = salesData.map(item => item.date);  // Dates from database
 const sales = salesData.map(item => item.sales);  // Sales values from database

 // Prepare the previous week data (if available)
 const previousSales = previousWeekData.map(item => item.sales);  // Sales values for the previous week

 var lineChartConfig = {
	 type: 'line',
	 data: {
		 labels: labels, // Dates from the current week
		 datasets: [{
			 label: 'Current week',
			 fill: false,
			 backgroundColor: window.chartColors.green,
			 borderColor: window.chartColors.green,
			 data: sales, // Sales data from the current week
		 }, {
			 label: 'Previous week',
			 borderDash: [3, 5],
			 backgroundColor: window.chartColors.gray,
			 borderColor: window.chartColors.gray,
			 data: previousSales, // Sales data from the previous week
			 fill: false,
		 }]
	 },
	 options: {
		 responsive: true,
		 aspectRatio: 1.5,
		 legend: {
			 display: true,
			 position: 'bottom',
			 align: 'end',
		 },
		 title: {
			 display: true,
			 text: 'Weekly Sales Comparison',
		 },
		 tooltips: {
			 mode: 'index',
			 intersect: false,
			 titleMarginBottom: 10,
			 bodySpacing: 10,
			 xPadding: 16,
			 yPadding: 16,
			 borderColor: window.chartColors.border,
			 borderWidth: 1,
			 backgroundColor: '#fff',
			 bodyFontColor: window.chartColors.text,
			 titleFontColor: window.chartColors.text,
			 callbacks: {
				 label: function(tooltipItem, data) {
					 if (parseInt(tooltipItem.value) >= 1000) {
						 return "$" + tooltipItem.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
					 } else {
						 return '$' + tooltipItem.value;
					 }
				 }
			 },
		 },
		 hover: {
			 mode: 'nearest',
			 intersect: true
		 },
		 scales: {
			 xAxes: [{
				 display: true,
				 gridLines: {
					 drawBorder: false,
					 color: window.chartColors.border,
				 },
				 scaleLabel: {
					 display: false,
				 }
			 }],
			 yAxes: [{
				 display: true,
				 gridLines: {
					 drawBorder: false,
					 color: window.chartColors.border,
				 },
				 scaleLabel: {
					 display: false,
				 },
				 ticks: {
					 beginAtZero: true,
					 userCallback: function(value, index, values) {
						 return '$' + value.toLocaleString();   // Formatting for currency
					 }
				 },
			 }]
		 }
	 }
 };

// Order count data from PHP

// Bar chart configuration
var barChartConfig = {
 type: 'bar',
 data: {
	 labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  // Days of the week
	 datasets: [{
		 label: 'Orders',
		 backgroundColor: window.chartColors.green,
		 borderColor: window.chartColors.green,
		 borderWidth: 1,
		 maxBarThickness: 16,
		 data: orderCounts, // Order count data from the database
	 }]
 },
 options: {
	 responsive: true,
	 aspectRatio: 1.5,
	 legend: {
		 position: 'bottom',
		 align: 'end',
	 },
	 title: {
		 display: true,
		 text: 'Weekly Order Counts'
	 },
	 tooltips: {
		 mode: 'index',
		 intersect: false,
		 titleMarginBottom: 10,
		 bodySpacing: 10,
		 xPadding: 16,
		 yPadding: 16,
		 borderColor: window.chartColors.border,
		 borderWidth: 1,
		 backgroundColor: '#fff',
		 bodyFontColor: window.chartColors.text,
		 titleFontColor: window.chartColors.text,
	 },
	 scales: {
		 xAxes: [{
			 display: true,
			 gridLines: {
				 drawBorder: false,
				 color: window.chartColors.border,
			 },
		 }],
		 yAxes: [{
			 display: true,
			 gridLines: {
				 drawBorder: false,
				 color: window.chartColors.border,
			 },
			 ticks: {
				 beginAtZero: true,
			 }
		 }]
	 }
 }
};

// Generate charts on load
window.addEventListener('load', function(){
	
	var lineChart = document.getElementById('canvas-linechart').getContext('2d');
	window.myLine = new Chart(lineChart, lineChartConfig);
	
	var barChart = document.getElementById('canvas-barchart').getContext('2d');
	window.myBar = new Chart(barChart, barChartConfig);
	

});	
	
