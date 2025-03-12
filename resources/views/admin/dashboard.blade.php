@extends('admin.layout')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Dashboard
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    {{-- <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4  class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-end"></i>
            </h4>
            <h2 id="sales-amount" class="mb-5">0</h2>
            <h6 id="sales-change" class="card-text">Change...</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
            </h4>
            <h2 id="orders-count" class="mb-5">0</h2>
            <h6 id="orders-change" class="card-text">Change...</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-end"></i>
            </h4>
            <h2 class="mb-5">95,5741</h2>
            <h6 class="card-text">Increased by 5%</h6>
          </div>
        </div>
      </div>
    </div> --}}
    {{-- this --}}
    <canvas id="salesChart"></canvas>
    {{-- <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="clearfix">
              <h4 class="card-title float-start">Visit And Sales Statistics</h4>
              <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-end"></div>
            </div>
            <canvas id="visit-sale-chart" class="mt-4"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Traffic Sources</h4>
            <div class="doughnutjs-wrapper d-flex justify-content-center">
              <canvas id="traffic-chart"></canvas>
            </div>
            <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
          </div>
        </div>
      </div>
    </div> --}}
    {{-- this --}}
    {{-- <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Recent Tickets</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th> Assignee </th>
                    <th> Subject </th>
                    <th> Status </th>
                    <th> Last Update </th>
                    <th> Tracking ID </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <img src="assets/images/faces/face1.jpg" class="me-2" alt="image"> David Grey
                    </td>
                    <td> Fund is not recieved </td>
                    <td>
                      <label class="badge badge-gradient-success">DONE</label>
                    </td>
                    <td> Dec 5, 2017 </td>
                    <td> WD-12345 </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="assets/images/faces/face2.jpg" class="me-2" alt="image"> Stella Johnson
                    </td>
                    <td> High loading time </td>
                    <td>
                      <label class="badge badge-gradient-warning">PROGRESS</label>
                    </td>
                    <td> Dec 12, 2017 </td>
                    <td> WD-12346 </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="assets/images/faces/face3.jpg" class="me-2" alt="image"> Marina Michel
                    </td>
                    <td> Website down for one week </td>
                    <td>
                      <label class="badge badge-gradient-info">ON HOLD</label>
                    </td>
                    <td> Dec 16, 2017 </td>
                    <td> WD-12347 </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="assets/images/faces/face4.jpg" class="me-2" alt="image"> John Doe
                    </td>
                    <td> Loosing control on server </td>
                    <td>
                      <label class="badge badge-gradient-danger">REJECTED</label>
                    </td>
                    <td> Dec 3, 2017 </td>
                    <td> WD-12348 </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <br><br>
    <canvas id="topProductsChart"></canvas>
    <br><br>
    <canvas id="categorySalesChart"></canvas>
    <br><br>
    <canvas id="monthlySalesChart"></canvas>
    <br><br>
    <canvas id="topCustomersChart"></canvas>
    <br><br>
    <canvas id="dailyOrdersChart"></canvas>
    <br><br>
    </div>
  </div>
  <!-- content-wrapper ends -->

@endsection
<script>
  fetch('/sales-data')
      .then(response => response.json())
      .then(data => {
          let labels = data.map(sale => sale.date);
          let values = data.map(sale => sale.total);
  
          new Chart(document.getElementById('salesChart'), {
              type: 'line',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'المبيعات اليومية',
                      data: values,
                      borderColor: 'blue',
                      fill: false
                  }]
              }
          });
      });
  </script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      fetch('/top-selling-products')
          .then(response => response.json())
          .then(data => {
              let productNames = data.map(item => item.productName);
              let sales = data.map(item => item.total_sales);
  
              const ctx = document.getElementById('topProductsChart').getContext('2d');
              new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: productNames,
                      datasets: [{
                          label: 'المنتجات الأكثر مبيعًا',
                          data: sales,
                          backgroundColor: 'rgba(255, 99, 132, 0.6)',
                          borderColor: 'rgba(255, 99, 132, 1)',
                          borderWidth: 1
                      }]
                  },
                  options: {
                      responsive: true,
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                  }
              });
          });
  });
  </script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      fetch('/sales-by-category')
          .then(response => response.json())
          .then(data => {
              let categories = data.map(item => item.categorieName);
              let sales = data.map(item => item.total_sales);
  
              const ctx = document.getElementById('categorySalesChart').getContext('2d');
              new Chart(ctx, {
                  type: 'pie',
                  data: {
                      labels: categories,
                      datasets: [{
                          label: 'توزيع المبيعات حسب الفئات',
                          data: sales,
                          backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(255, 159, 64, 0.6)', 'rgba(153, 102, 255, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                          borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 159, 64, 1)', 'rgba(153, 102, 255, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                          borderWidth: 1
                      }]
                  }
              });
          });
  });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/monthly-sales')
            .then(response => response.json())
            .then(data => {
                let months = data.map(item => item.month);
                let sales = data.map(item => item.total_sales);
    
                const ctx = document.getElementById('monthlySalesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'إجمالي المبيعات الشهرية',
                            data: sales,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          fetch('/top-customers')
              .then(response => response.json())
              .then(data => {
                  let customers = data.map(item => item.name);
                  let totalSpent = data.map(item => item.total_spent);
      
                  const ctx = document.getElementById('topCustomersChart').getContext('2d');
                  new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: customers,
                          datasets: [{
                              label: 'إجمالي المبلغ المنفق ($)',
                              data: totalSpent,
                              backgroundColor: 'rgba(255, 99, 132, 0.6)',
                              borderColor: 'rgba(255, 99, 132, 1)',
                              borderWidth: 1
                          }]
                      },
                      options: {
                          responsive: true,
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          }
                      }
                  });
              });
      });
      </script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      fetch('/daily-orders')
          .then(response => response.json())
          .then(data => {
              let dates = data.map(item => item.order_date);
              let orderCounts = data.map(item => item.total_orders);
  
              const ctx = document.getElementById('dailyOrdersChart').getContext('2d');
              new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: dates,
                      datasets: [{
                          label: 'عدد الطلبات اليومية',
                          data: orderCounts,
                          backgroundColor: 'rgba(75, 192, 192, 0.2)',
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                          fill: true
                      }]
                  },
                  options: {
                      responsive: true,
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                  }
              });
          });
  });
  </script>


       