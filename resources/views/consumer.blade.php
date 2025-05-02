<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$consumer['name']}}</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
<div class="container">
    <div class="text-center font-bold">
        Consumer Information for {{$consumer['name']}}
        <p>File Exported date: {{now()->toDayDateTimeString()}}</p>
    </div>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; vertical-align: top;" class="pt-8">
                <div class="">
                    <p>Name :  <span class="font-bold text-gray-900">{{$consumer['name']}}</span></p>
                    <p>Phone Number :  <span class="font-bold text-gray-900">{{$consumer['phone']}}</span></p>
                    <p>City :  <span class="font-bold text-gray-900">{{$consumer['city']}}</span></p>
                    <p>Country :  <span class="font-bold text-gray-900">{{$consumer['country']}}</span></p>
                    <p>{{$consumer['identification_type']}}  <span class="font-bold text-gray-900">{{$consumer['identification_number']}}</span></p>
                </div>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <div class="">
                    <h1 class="text-lg font-bold text-center">user Portrait</h1>

                    <img src="file://{{ public_path('storage/consumers/' . basename($consumer['portrait_url'])) }}" alt="User Portrait">

                </div>
            </td>
        </tr>
    </table>
    <div class="mt-4 mx-auto">
        <h1 class="text-lg font-bold text-center">Identification Photo</h1>

        <img src="file://{{ public_path('storage/id_photos/' . basename($consumer['id_url'])) }}"
             alt="ID image"
             class="w-full object-cover rounded shadow"
        >
    </div>

    <div style="page-break-before: always;"></div>
    <div>
        @foreach ($debts as $debt)
            <div class="h-full overflow-auto">
                <h1 class="font-bold text-center">User Transactions</h1>

                <h1 class="font-medium">Debt Currency : {{$debt['currency']}}</h1>
                <h1 class="font-medium">Active Loan: {{$debt['amount']}} {{$debt['currency']}}</h1>
                <h1 class="font-medium">Loan Limit: {{$debt['limit']}} {{$debt['currency']}}</h1>
                <h1 class="font-medium">Number of transactions: {{count($debt['transactions'])}}</h1>
                <h1 class="font-medium">Number of Loans: {{count(array_filter($debt['transactions']->toArray(), function ($k){
                        return $k['type'] == 'loan';
                    }
                    ))}}</h1>
                <h1 class="font-medium">Number of Returns: {{count(array_filter($debt['transactions']->toArray(), function ($k){
                        return $k['type'] == 'return';
                    }
                    ))}}</h1>
                @if(count($debt['transactions']))

                <table style="width: 100%" class="border-collapse border border-gray-400">
                    <tr class="border border-gray-300 text-center">
                       <th class="border border-gray-300 text-center">Amount</th>
                        <th class="border border-gray-300 text-center">Type</th>
                        <th class="border border-gray-300 text-center">Timestamp</th>
                    </tr>
                        @foreach ($debt['transactions'] as $index =>  $transaction)
                            <tr class=" odd:bg-gray-200 border border-gray-300 text-center">
                                <td class="border border-gray-300 text-center">
                                    {{$transaction['amount']}}
                                </td>
                                <td class="border border-gray-300 text-center">
                                    {{$transaction['type']}}
                                </td>
                                <td class="border border-gray-300 text-center">
        {{--                            {{$transaction['created_at']->format('d-m-Y')}}--}}
                                    {{$transaction['created_at']->toDayDateTimeString()}}
                                </td>
                            </tr>
                        @endforeach
                </table>
                @endif

            </div>
        @endforeach
    </div>

</div>
</body>
</html>

