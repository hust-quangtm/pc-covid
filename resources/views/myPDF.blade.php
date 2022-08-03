<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <title>Test</title>
    <style>
        .pdf {
            display: flex;
            flex-direction: column;
        }

        .title {
            text-align: center;
        }

        .cer-date {
            font-weight: bold;
        }
    </style>
</head>
<body class="pdf">
    <div class="title">
        <img src="{{ public_path('assets/img/theme/pc-logo.png') }}" style="width: 100px; height: 100px">
        <h3>POSITIVE COVID 19 CERTIFICATE</h3>
    </div>
    <div>
        <div class="cer-date">
            Date of issue: {{ $date }}
        </div>
        <div class="cer-infor">
            <h4>PATIENT DEMOGRAPHICS</h4>
            <p>Fullname: {{ $name }}</p>
            <p>Date of birth: {{ $birthday }}</p>
            <p>Gender: Male</p>
            <p>Nationality: VietNam</p>
            <p>ID card number (for Vietnames citizen): {{ $id_card }}</p>
            <p>Residential address in Vietnam: {{ $address }}</p>
        </div>

        <div class="cer-infor">
            <h4>SPECIMEN INFORMATION</h4>
            <p>Specimen type: Nasophary</p>
            <p>Collection date: {{ $infected_day }}</p>
        </div>

        <div class="cer-detail">
            <h4>TEST DETAILS</h4>
            <p>Reverse transcriptase polymerase chain reaction (RT-PCR)</p>
            <p>Test name: QIAstat-Dx SARS-CoV-2 Panel</p>
            <p>Testing Facility: Hospital Laboratory</p>
        </div>

        <div class="cer-detail">
            <h4>DECLARATION</h4>
            <p>This is to certify that the specimen collected on the stated date, from the above-mentioned persion was confirmed NEGATIVE for the SARS-CoV-2 ai FV Hospital</p>
        </div>
    </div>

    <div class="footer-img">
        <img src="{{ public_path('assets/img/theme/covid-logo.png') }}" style="width: 200px;">
    </div>

</body>
</html>

