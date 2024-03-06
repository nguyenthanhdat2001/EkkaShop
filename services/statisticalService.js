try {
  fetch('admin/statistical/amountStatistical')
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.code == 200) {
        createChartAmount(data.data);
        createChartOrderTotal();
      }
    });
} catch (error) {
  console.log(error);
}

let dataAmount = [];
let dataTotalOrder = [];
function createChartAmount(dataQW) {
  const data = [
    {
      order_month: 1,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 2,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 3,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 4,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 5,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 6,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 7,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 8,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 9,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 10,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 11,
      total_orders: 0,
      total_amount: 0,
    },
    {
      order_month: 12,
      total_orders: 0,
      total_amount: 0,
    },
  ];
  data.forEach((item, index) => {
    const matchingItem = dataQW.find(
      (qwItem) => qwItem.order_month == item.order_month,
    );

    if (matchingItem) {
      // Update the values in the data array
      data[index].total_amount = +matchingItem.total_amount;
      data[index].total_orders = +matchingItem.total_orders;
    }
  });
  data.map((item) => {
    dataAmount.push(parseInt(item.total_amount, 10));
    dataTotalOrder.push(item.total_orders);
  });

  let options = {
    series: [
      {
        name: 'Doanh thu',
        data: dataAmount,
      },
    ],
    chart: {
      height: 320,
      type: 'area',
      dropShadow: {
        enabled: true,
        top: 10,
        left: 0,
        blur: 3,
        color: '#720f1e',
        opacity: 0.01,
      },
      toolbar: {
        show: true,
      },
      zoom: {
        enabled: true,
      },
    },
    markers: {
      strokeWidth: 4,
      strokeColors: '#ffffff',
      hover: {
        size: 9,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
      lineCap: 'butt',
      width: 4,
    },
    legend: {
      show: false,
    },
    colors: ['#0da487'],
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.6,
        stops: [0, 90, 100],
      },
    },
    grid: {
      xaxis: {
        lines: {
          borderColor: 'transparent',
          show: true,
        },
      },
      yaxis: {
        lines: {
          borderColor: 'transparent',
          show: false,
        },
      },
      padding: {
        right: -112,
        bottom: 0,
        left: 15,
      },
    },
    responsive: [
      {
        breakpoint: 1200,
        options: {
          grid: {
            padding: {
              right: -95,
            },
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          grid: {
            padding: {
              right: -69,
            },
          },
        },
      },
      {
        breakpoint: 767,
        options: {
          chart: {
            height: 200,
          },
        },
      },
      {
        breakpoint: 576,
        options: {
          yaxis: {
            labels: {
              show: false,
            },
          },
        },
      },
    ],
    yaxis: {
      labels: {
        formatter: function (value) {
          return formatCurrency(value);
        },
      },
      crosshairs: {
        show: true,
        position: 'back',
        stroke: {
          color: '#b6b6b6',
          width: 1,
          dashArray: 5,
        },
      },
      tooltip: {
        enabled: true,
      },
    },
    xaxis: {
      categories: [
        'Tháng 1',
        'Tháng 2',
        'Tháng 3',
        'Tháng 4',
        'Tháng 5',
        'Tháng 6',
        'Tháng 7',
        'Tháng 8',
        'Tháng 9',
        'Tháng 10',
        'Tháng 11',
        'Tháng 12',
      ],
      range: undefined,
      axisBorder: {
        low: 0,
        offsetX: 0,
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
  };

  const reportChart = document.querySelector('#report-chart');
  if (reportChart) {
    var chart = new ApexCharts(reportChart, options);
    chart.render();
  }
}

function createChartOrderTotal() {
  let options = {
    series: [
      {
        name: 'Lượt bán',
        data: dataTotalOrder,
      },
    ],

    chart: {
      height: 320,
      toolbar: {
        show: true,
      },
      zoom: {
        enabled: true,
      },
    },

    legend: {
      show: false,
    },

    colors: ['#0da487', '#2483e2'],

    markers: {
      size: 1,
    },

    // grid: {
    //   show: false,
    //   xaxis: {
    //     lines: {
    //       show: false,
    //     },
    //   },
    // },
    yaxis: {
      labels: {
        formatter: function (value) {
          return parseInt(value);
        },
      },
    },

    xaxis: {
      categories: [
        'T1',
        'T2',
        'T3',
        'T4',
        'T5',
        'T6',
        'T7',
        'T8',
        'T9',
        'T10',
        'T11',
        'T12',
      ],
      labels: {
        show: true,
      },
    },

    responsive: [
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 300,
          },
        },
      },

      {
        breakpoint: 992,
        options: {
          chart: {
            height: 210,
            width: '100%',
            offsetX: 0,
          },
        },
      },

      {
        breakpoint: 578,
        options: {
          chart: {
            height: 200,
            width: '105%',
            offsetX: -20,
            offsetY: 10,
          },
        },
      },

      {
        breakpoint: 430,
        options: {
          chart: {
            width: '108%',
          },
        },
      },

      {
        breakpoint: 330,
        options: {
          chart: {
            width: '112%',
          },
        },
      },
    ],
  };
  const earningChart = document.querySelector('#earning-chart');
  if (earningChart) {
    var chart2 = new ApexCharts(earningChart, options);
    chart2.render();
  }
}

//api
try {
  fetch('admin/statistical/getProdForCateChart')
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.code == 200) {
        createChartProductCate(data.data);
      }
    });
} catch (error) {
  console.log(error);
}

function createChartProductCate(data) {
  const series = [];
  const labels = [];
  
  data.map((dataProdCate) => {
    labels.push(dataProdCate.name);
    series.push(parseInt(dataProdCate.product_count, 0));
  });

  let options = {
    chart: {
      height: 400,
      type: 'donut',
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: 'top',
      horizontalAlign: 'center',
      show: true,
    },
    colors: [
      'var(--chart-color1)',
      'var(--chart-color2)',
      'var(--chart-color3)',
      'var(--chart-color4)',
    ],
    series,
    labels,
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
          legend: {
            position: 'bottom',
          },
        },
      },
    ],
  };

  const productCate = document.querySelector('#productCate');
  if (productCate) {
    var chart3 = new ApexCharts(productCate, options);
    chart3.render();
  }
}

$(document).ready(function () {
  var options = {
    chart: {
      height: 380,
      type: 'radar',
    },
    series: [
      {
        name: 'Series 1',
        data: [20, 100, 40, 30, 50, 80, 33],
      },
    ],
    labels: [
      'Sunday',
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
    ],
    plotOptions: {
      radar: {
        size: 140,
        polygons: {
          strokeColor: '#e9e9e9',
          fill: {
            colors: ['#f8f8f8', '#fff'],
          },
        },
      },
    },
    colors: ['#f7c56b'],
    markers: {
      size: 4,
      colors: ['#fff'],
      strokeColor: '#f7c56b',
      strokeWidth: 2,
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val;
        },
      },
    },
    yaxis: {
      tickAmount: 7,
      labels: {
        formatter: function (val, i) {
          if (i % 2 === 0) {
            return val;
          } else {
            return '';
          }
        },
      },
    },
  };

  const chart6 = document.querySelector('#apex-radar-polygon-fill');

  if (chart6) {
    var chart3 = new ApexCharts(chart6, options);
    chart3.render();
  }
});

// Basic Bar
$(document).ready(function () {
  var options = {
    chart: {
      height: 350,
      type: 'bar',
      toolbar: {
        show: false,
      },
    },
    colors: ['var(--chart-color2)'],
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0,
      },
    },
    plotOptions: {
      bar: {
        horizontal: true,
      },
    },
    dataLabels: {
      enabled: false,
    },
    series: [
      {
        data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380],
      },
    ],
    xaxis: {
      categories: [
        'South Korea',
        'Canada',
        'United Kingdom',
        'Netherlands',
        'Italy',
        'France',
        'Japan',
        'United States',
        'China',
        'Germany',
      ],
    },
  };

  var chart = new ApexCharts(
    document.querySelector('#apex-basic-bar'),
    options,
  );

  chart.render();
});
