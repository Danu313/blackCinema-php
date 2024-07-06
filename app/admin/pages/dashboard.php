<?php
include '../../config/conn.php';
$currentYear = date('Y');

$sql = "SELECT MONTH(createdAt) AS month, SUM(totalPrice) AS total FROM payment WHERE YEAR(createdAt) = $currentYear GROUP BY MONTH(createdAt)";
$result = $conn->query($sql);

$incomeData = array_fill(0, 12, 0);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = intval($row['month']) - 1;
        $incomeData[$month] = intval($row['total']);
    }
}

$conn->close();
?>

<div class="w-full h-auto px-5">
    <div class="flex flex-col w-full h-auto">
        <div class="border-b-[3px]">
            <div class="container flex flex-wrap items-center justify-between gap-6 py-8">
                <span class="text-3xl font-bold">Hello, <?php echo $_SESSION['user_username']; ?>!👋🏼</span>
                <a href="logout" class="bg-red-700 text-sm py-3 px-5 rounded-md text-white hover:bg-red-900 duration-200">Logout</a>
            </div>
        </div>
        <div class="w-full h-auto">
            <div class="w-full flex flex-row items-center justify-between py-5">
                <h1 class="text-3xl font-bold">Grafik Pemasukan tahun <?php echo $currentYear; ?></h1>
            </div>
            <canvas id="myChart" style="width:100%; max-height:400px;"></canvas>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var monthlyData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Pemasukkan',
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderColor: 'rgba(16, 185, 129, 1)',
                borderWidth: 1,
                data: <?php echo json_encode($incomeData); ?>
            }]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawTicks: false,
                    },
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawTicks: false,
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                mode: 'index',
                intersect: false
            }
        };

        var ctx = document.getElementById('myChart').getContext('2d');

        var incomeGradient = ctx.createLinearGradient(0, 0, 0, 300);
        incomeGradient.addColorStop(0, 'rgba(16, 185, 129, 1)');
        incomeGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        monthlyData.datasets[0].backgroundColor = incomeGradient;

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: monthlyData,
            options: options
        });
    });
</script>