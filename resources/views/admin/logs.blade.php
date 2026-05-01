<!DOCTYPE html>
<html>

<head>
    <title>API Logs Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f9fafb;
            margin: 0;
        }

        .container {
            width: 90%;
            margin: 40px auto;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #111827;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:hover {
            background: #f3f4f6;
        }

        .badge {
            padding: 5px 10px;
            background: #3b82f6;
            color: white;
            border-radius: 6px;
        }

        .ip {
            color: #ef4444;
            font-weight: bold;
        }

        /* Pagination Style */
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            margin: 3px;
            border-radius: 6px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: black;
        }

        .pagination a.active {
            background: #3b82f6;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>📊 API Request Logs</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>IP Address</th>
                <th>Endpoint</th>
                <th>Status</th>
            </tr>

            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>
                        <span class="badge">
                            {{ $log->user_id ?? 'Guest' }}
                        </span>
                    </td>
                    <td class="ip">{{ $log->ip }}</td>
                    <td>{{ $log->endpoint }}</td>
                    <td>✔ Logged</td>
                </tr>
            @endforeach
        </table>

        <!-- SIMPLE PAGINATION (ONLY 1 2) -->
        <div class="pagination">
            @for ($i = 1; $i <= $logs->lastPage(); $i++)
                <a href="{{ $logs->url($i) }}" class="{{ $logs->currentPage() == $i ? 'active' : '' }}">
                    {{ $i }}
                </a>
            @endfor
        </div>

    </div>

</body>

</html>