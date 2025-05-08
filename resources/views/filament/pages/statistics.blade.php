@extends('filament::page')

@section('title', '智能分析平台')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">智能分析平台</h2>

        <!-- 数据卡片展示 -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h4 class="font-semibold">总报名人数</h4>
                <p class="text-2xl">{{ $totalSignups }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h4 class="font-semibold">已签到人数</h4>
                <p class="text-2xl">{{ $totalCheckedIn }}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h4 class="font-semibold">未签到人数</h4>
                <p class="text-2xl">{{ $totalNotCheckedIn }}</p>
            </div>
        </div>

        <!-- 活动参与人数 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h4 class="font-semibold">活动参与人数</h4>
                <canvas id="activityChart"></canvas>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h4 class="font-semibold">性别分布</h4>
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <!-- 活跃用户 -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h4 class="font-semibold">活跃用户（参与多个活动的用户）</h4>
            <table class="table-auto w-full mt-2">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left">用户ID</th>
                    <th class="px-4 py-2 text-left">参与活动数量</th>
                </tr>
                </thead>
                <tbody>
                @foreach($activeUsers as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->user_id }}</td>
                        <td class="px-4 py-2">{{ $user->activity_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- 引入 Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // 活动参与人数图表
        var activityData = @json($activityParticipation);
        var activityLabels = activityData.map(function (item) {
            return '活动 ' + item.activity_id;
        });
        var activityCounts = activityData.map(function (item) {
            return item.total;
        });

        var activityCtx = document.getElementById('activityChart').getContext('2d');
        var activityChart = new Chart(activityCtx, {
            type: 'bar',
            data: {
                labels: activityLabels,
                datasets: [{
                    label: '参与人数',
                    data: activityCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // 性别分布图表
        var genderData = @json($genderDistribution);
        var genderLabels = genderData.map(function (item) {
            return item.gender == 1 ? '男' : '女';
        });
        var genderCounts = genderData.map(function (item) {
            return item.total;
        });

        var genderCtx = document.getElementById('genderChart').getContext('2d');
        var genderChart = new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: '性别分布',
                    data: genderCounts,
                    backgroundColor: ['#36a2eb', '#ff6384'],
                    hoverOffset: 4
                }]
            }
        });
    </script>
@endsection
