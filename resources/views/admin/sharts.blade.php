@extends('admin.layout')
@section('content')
    <canvas id="salesChart"></canvas>
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
         

