<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }

        body {
            margin: 8px;
        }

        .logo-title{
            float: left;
        }

        .logo{
          height: 60px;
          margin-right: 4px;
        }

        .title-row{
            height: 10px;
        }

        .invoice-number{
            float: right;
            margin: 20px 20px;
            color: #515365;

        }

        .second-row{
            margin-top: 100px;
        }

        .org-details{
        }

        .date{
            text-align: right; 
        }
        .invoice-to{
            margin-left: 15px;
        }

        .payment-info{
            margin-right: 15px;
        }

        .table-row{
        }

        .table{
            width: 100%;
            border-collapse: collapse;
        }

        .table{
            border: 1px solid grey;
        }
        .table td{
            border: 1px solid grey;
        }
        .table th{
            border: 1px solid grey;
        }

    </style>
</head>
<body>
    @php
        $singlePayment = null;
        $singleOrg = null;

        foreach ($payments as $payment){
            $singlePayment = $payment;
        }
        foreach ($organisation as $org){
            $singleOrg = $org;
        }
    @endphp
    
    <section class="title-row">
        <table class="logo-title">
            <tr>
                <td>
                    <img 
                    class="logo"
                    src="{{public_path("/storage/profile/".$singleOrg->logo)}}"
                    alt="Logo"
                    >
                </td>
                <td>
                    <h2 class="title">{{$singleOrg->name}}</h2>
                </td>
            </tr>
        </table>
        <div class="invoice-number">
            <h3>Invoice : {{$singlePayment->id}}</h3>
        </div>
    </section>

    <div style="clear"></div>

    <section class="second-row">
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td>
                        <div class="org-details">
                            <div>{{$singleOrg->address}}</div>
                            <div>{{$singleOrg->email}}</div>
                            <div style="margin-top: 5px;margin-bottom: 20px">{{$singleOrg->telephone}}</div>
                        </div>

                    </td>
                    <td>
                        <div class="date" >
                            <div style=" color: #515365;"> <strong>Start Date :</strong>  {{$singlePayment->start_date}}</div>
                            <div style=" color: #515365; margin-bottom: 20px"><strong>Due Date :</strong>  {{$singlePayment->end_date}}</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <hr style="margin-bottom: 15px; color: #515365;">

    <section class="third-row">
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td>
                        <div class="invoice-to">
                            <h4 style="margin-bottom: 10px; color:#007bff">Invoice To : </h4>
                            <div style="color: #515365;">{{$singlePayment->customer_name}}</div>
                            <div style="color: #515365;">{{$singlePayment->customer_address}}</div>
                            <div style="color: #515365;">{{$singlePayment->customer_email}}</div>
                            <div style="color: #515365; margin-bottom: 20px">{{$singlePayment->customer_phone}}</div>
                        </div>

                    </td>
                    <td align="right">
                        <div class="payment-info">
                            <h4 style="margin-bottom: 10px; color:#007bff">Payment Info : </h4>
                            <div style=" color: #515365;">Bank Name: {{$singleOrg->bank_name}}</div>
                            <div style=" color: #515365;">Account Number : {{$singleOrg->account_no}}</div>
                            <div style=" color: #515365;">Swift Code : {{$singleOrg->swift_code}}</div>
                            <div style=" color: #515365; margin-bottom: 20px">Country : {{$singleOrg->country}}</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="table-row">
        <table class="table">
            <thead>
              <tr>
                <th style="text-align: center; padding:10px 3px; color:#007bff">Description</th>
                <th style="text-align: center; padding:10px 3px; color:#007bff">Additional Details</th>
                <th style="text-align: center; padding:10px 3px; color:#007bff">Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: center; padding:15px 3px">{{$singlePayment->description}}</td>
                <td style="text-align: center; padding:15px 3px" >{{$singlePayment->additional_details}}</td>
                <td style="text-align: center; padding:15px 3px" >{{$singlePayment->currency}} - {{$singlePayment->amount}}</td>
              </tr> 
            </tbody>
          </table>   
    </section>

    <section style="margin-top: 20px">
        <table style="width:100%">
            <tbody>
                <tr>
                   <td style="text-align: right; padding-right: 10px;"><strong>Total : </strong>{{$singlePayment->currency}} {{$singlePayment->amount}}</td>
                 </tr>
            </tbody>
          </table>
    </section>

    <section style="margin: 20px 10px">
        <div >
            <div >
              <p><strong>Note : </strong>{{$singlePayment->note}}</p>
            </div>
          </div>
    </section>
</body>
</html>